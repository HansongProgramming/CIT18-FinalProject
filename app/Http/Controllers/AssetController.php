<?php

namespace App\Http\Controllers;
use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assets = Asset::with('user')->latest()->get();
        return view('assets.index', compact('assets'));
        return view('dashboard', compact('assets'));

    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'required|url',
            'download_link' => 'required|url',
        ]);
    
        Asset::create([
            'title' => $request->title,
            'thumbnail' => $request->thumbnail,
            'download_link' => $request->download_link,
            'user_id' => auth()->id(),
        ]);
    
        return redirect()->route('assets.index')->with('success', 'Asset uploaded successfully!');
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $asset = Asset::findOrFail($id);
        if ($asset->user_id !== auth()->id()) {
            abort(403);
        }
    
        $asset->delete();
    
        return redirect()->route('assets.index')->with('success', 'Asset deleted successfully!');
    }
    
}
