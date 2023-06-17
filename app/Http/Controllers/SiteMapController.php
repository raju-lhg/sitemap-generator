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
        $sitemapData = SitemapGenerator::generateTreeFromSitemapXML($sitemap->xml_path);
        $dnsInfo = json_decode($sitemap->dns_data, TRUE);
        return view('site-maps.details', compact('sitemap', 'sitemapData', 'dnsInfo'));
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
}
