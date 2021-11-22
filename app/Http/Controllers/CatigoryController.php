<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatigoryRequest;
use App\Models\Catigory;
use Illuminate\Http\Request;

class CatigoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $catigories = Catigory::where('id', '>', 1)->when($request->search, function($q) use ($request) {
            return $q->where('name', 'like', '%' . $request->search . '%');
           })->latest()->paginate(5);
        return view('dashboard.catigory.index', compact('catigories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.catigory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CatigoryRequest $request)
    {
      $create_data = [
        'en' => [
            'name' => $request->input('en')['name']
        ],
        'ar' => [
            'name' => $request->input('ar')['name']
        ]
    ];

    Catigory::create($create_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.catigory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catigory  $catigory
     * @return \Illuminate\Http\Response
     */
    public function show(Catigory $catigory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catigory  $catigory
     * @return \Illuminate\Http\Response
     */
    public function edit(Catigory $catigory)
    {
        $cat = Catigory:: findOrFail($catigory->id);
        return view('dashboard.catigory.edit', compact('cat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catigory  $catigory
     * @return \Illuminate\Http\Response
     */
    public function update(CatigoryRequest $request, Catigory $catigory)
    {
        $cat = Catigory::findOrFail($catigory->id);
        $cat->update($request->all());
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.catigory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catigory  $catigory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catigory $catigory)
    {
        $cat = Catigory::findOrFail($catigory->id);
        $cat->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.catigory.index');
    }
}
