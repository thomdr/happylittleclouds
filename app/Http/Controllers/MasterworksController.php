<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Masterwork;
use Storage;

class MasterworksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('masterworks.index', [
            'masterworks' => Masterwork::all()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        return view('masterworks.admin', [
            'masterworks' => Masterwork::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masterworks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = request()->validate([
            'name' => 'required|max:255',
            'image' => 'required|file|image'
        ]);
        $validated['image'] = $request->file('image')->store('uploads/masterwork');
        Masterwork::create($validated);
        return redirect()->route('masterworks.admin');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Masterwork masterwork
     * @return \Illuminate\Http\Response
     */
    public function edit(Masterwork $masterwork)
    {
        return view('masterworks.edit', compact('masterwork'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Masterwork $masterwork
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Masterwork $masterwork)
    {
        $validated = request()->validate([
            'name' => 'required|max:255',
            'image' => 'file|image'
        ]);

        if (is_null($request->file('image'))) {
            $validated['image'] = $masterwork->image;
        } else {
            Storage::delete($masterwork->image);
            $validated['image'] = $request->file('image')->store('uploads/masterwork');
        }

        $masterwork->update($validated);
        return redirect()->route('masterworks.admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Masterwork $masterwork
     * @return \Illuminate\Http\Response
     */
    public function delete(Masterwork $masterwork)
    {
        Storage::delete($masterwork->image);
        $masterwork->delete();
        return redirect()->route('masterworks.admin');
    }
}
