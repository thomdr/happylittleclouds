<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exhibition;
use Illuminate\Validation\ValidationException;

class ExhibitionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(date('m'));
        // where('date', 'regexp', substr(request()->date, 0, 7) . '-\d{2}')
        return view('exhibitions.index', [
            'exhibitions' => Exhibition::orderBy('date', 'asc')->get()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        return view('exhibitions.admin', [
            'exhibitions' => Exhibition::orderBy('date', 'asc')->get()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Exhibition $exhibition
     * @return \Illuminate\Http\Response
     */
    public function show(Exhibition $exhibition)
    {
        return view('exhibitions.index', [
            'exhibitions' => Exhibition::orderBy('date', 'asc')->get(),
            'exhibition' => Exhibition::find($exhibition)[0]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('exhibitions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->monthInUse();
        Exhibition::create($this->validateExhibition());
        return redirect()->route('exhibitions.admin');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Exhibition $exhibitions
     * @return \Illuminate\Http\Response
     */
    public function edit(Exhibition $exhibition)
    {
        return view('exhibitions.edit', compact('exhibition'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Exhibition $exhibition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exhibition $exhibition)
    {
        $this->monthInUse($exhibition);
        $exhibition->update($this->validateExhibition());
        return redirect()->route('exhibitions.admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Exhibition $exhibition
     * @return \Illuminate\Http\Response
     */
    public function delete(Exhibition $exhibition)
    {
        $exhibition->delete();
        return redirect()->route('exhibitions.admin');
    }

    /**
     * Returns validation
     *
     * @return \Illuminate\Http\Request
     */
    protected function validateExhibition()
    {
        // Throw custom error because the date input cannot be validated for 'required'
        // This check if the user did fill it, same goes for the update function
        if (is_null(request()->date)) {
            throw ValidationException::withMessages(['date' => __('validation.required')]);
        }
        return request()->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:10000',
            'date' => 'max:255'
        ]);
    }

    /**
     * Check if a month is in use
     * optional parameter $exhibition to check if the month used is by the exhibition itself
     *
     * @param Exhibition|null $exhibition
     * @return void
     */
    protected function monthInUse(?Exhibition $exhibition = null):void
    {
        $dateInUse = Exhibition::where('date', request()->date)->first();
        if (
            $dateInUse &&
            (is_null($exhibition) || (!is_null($exhibition) && $dateInUse->id !== $exhibition->id))
        ) {
            throw ValidationException::withMessages(['date' => __('validation.month_in_use')]);
        }
    }
}
