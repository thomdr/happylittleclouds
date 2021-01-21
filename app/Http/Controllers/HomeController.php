<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomData;

class HomeController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('home.index', [
            'home' => CustomData::find(1)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('home.edit', [
            'home' => CustomData::find(1)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Regular updating does not work for some reason
        $home = CustomData::find(1);
        $home->content = request()->validate([
            'content' => 'required|max:65000'
        ])['content'];
        $home->save();
        return redirect()->route('home.edit');
    }
}
