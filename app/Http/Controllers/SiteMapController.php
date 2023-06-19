<?php

namespace App\Http\Controllers;

use App\Models\SiteMap;
use App\Services\DomainLookUp;
use App\Services\SitemapGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SiteMapController extends Controller
{
    public function index()
    {
        $siteMaps = SiteMap::with('createdByUser')->get();

        return view('site-maps.index', compact('siteMaps'));
    }

    public function create()
    {
        return view('site-maps.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'url' => 'required'
        ]);

        $validatedData['created_by'] =  Auth()->user()->id;
        $validatedData['xml_path'] =  SitemapGenerator::generate_sitemap($request->url);
        $validatedData['dns_data'] = DomainLookUp::get_dns_records($request->url);
        $validatedData['public_id'] = $this->generateRandomString(8);

        $validatedData['who_is_data'] = str_replace("\r\n", "</br>", DomainLookUp::get_who_is_data($request->url));
        // dd($validatedData['who_is_data']);

        $siteMap = SiteMap::create($validatedData);

        return redirect()->route('site-maps.show', ['id' => $siteMap->id])->with('success', 'Site Map created successfully.');
    }

    public function edit(SiteMap $siteMap)
    {
        return view('site-maps.edit', compact('siteMap'));
    }

    public function update(Request $request, SiteMap $siteMap)
    {
        $validatedData = $request->validate([
            'url' => 'required'
        ]);

        $validatedData['created_by'] =  Auth()->user()->id;
        $validatedData['xml_path'] =  SitemapGenerator::generate_sitemap($request->url);
        $validatedData['dns_data'] = DomainLookUp::get_dns_records($request->url);
        $validatedData['who_is_data'] = DomainLookUp::get_who_is_data($request->url);

        $siteMap->update($validatedData);

        return redirect()->route('site-maps.show', ['id' => $siteMap->id])->with('success', 'Site Map updated successfully.');
    }

    public function show($id)
    {
        $sitemap = SiteMap::with('createdByUser')->findOrFail($id);
        $customTree = SitemapGenerator::generateTreeHtml(SitemapGenerator::generateCustomTreeFromSitemapXML($sitemap->xml_path));
        $dnsInfo = json_decode($sitemap->dns_data, TRUE);
        return view('site-maps.details', compact('sitemap', 'dnsInfo', 'customTree'));
    }

    public function exportPDF($id)
    {
        $sitemap = SiteMap::with('createdByUser')->findOrFail($id);
        return $customTree = SitemapGenerator::exportToPDF($sitemap);
        return view('site-maps.pdf', compact('customTree'));
    }

    public function shareMap($publicId)
    {
        $sitemap = SiteMap::with('createdByUser')->where('public_id', $publicId)->first();
        if($sitemap){
            $customTree = SitemapGenerator::generateTreeHtml(SitemapGenerator::generateCustomTreeFromSitemapXML($sitemap->xml_path));
            $dnsInfo = json_decode($sitemap->dns_data, TRUE);
            return view('site-maps.share', compact('customTree', 'dnsInfo', 'sitemap'));
        }
        else{
            return redirect()->route('home');
        }
    }

    public function destroy(SiteMap $siteMap)
    {
        // Delete the associated XML file
        if (!empty($siteMap->xml_path)) {
            $filePath = public_path($siteMap->xml_path);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        $siteMap->delete();

        return redirect()->route('site-maps.index')->with('success', 'Site Map deleted successfully.');
    }

    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        $charLength = strlen($characters);

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charLength - 1)];
        }

        return $randomString;
    }
}
