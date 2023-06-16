<?php

namespace App\Http\Controllers;

use App\Models\SiteMap;
use App\Services\SitemapGenerator;
use Illuminate\Http\Request;

class SiteMapController extends Controller
{
    public function index()
    {
        $siteMaps = SiteMap::all();

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

        SiteMap::create($validatedData);

        return redirect()->route('site-maps.index')->with('success', 'Site Map created successfully.');
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

        $siteMap->update($validatedData);


        return redirect()->route('site-maps.index')->with('success', 'Site Map updated successfully.');
    }

    public function show($id)
    {
        $sitemap = SiteMap::findOrFail($id);
        return view('site-maps.details', compact('sitemap'));
    }

    public function destroy(SiteMap $siteMap)
    {
        $siteMap->delete();

        return redirect()->route('site-maps.index')->with('success', 'Site Map deleted successfully.');
    }
}
