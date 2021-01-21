<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\CustomData;

class ContactController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('contact.index', [
            'contact' => CustomData::find(2),
            'email' => CustomData::find(3)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('contact.edit', [
            'contact' => CustomData::find(2),
            'email' => CustomData::find(3)
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
        $contact = CustomData::find(2);
        $contact->content = request()->validate([
            'content' => 'required|max:65000'
        ])['content'];
        $contact->save();

        $email = CustomData::find(3);
        $email->content = request()->validate([
            'email' => 'required|max:255'
        ])['email'];
        $email->save();
        return redirect()->route('contact.edit');
    }

    /**
     * Undocumented function
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function mail(Request $request)
    {
        request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'message' => 'required|max:1000',
        ]);
        Mail::to(CustomData::find(3)['content'])->send(new \App\Mail\Contact(request()->name, request()->email, request()->message));
        return redirect()->route('contact.index')->with('send', 'Email verzonden.');
    }
}
