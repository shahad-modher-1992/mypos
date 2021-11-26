<?php

namespace App\Http\Controllers\Api;

use App\Models\Catigory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CatigoryRequest;

class CatigoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $catigories = Catigory::when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name' ,'%' . $request->search . '%');

        })->latest()->paginate(5);

        return response()->json([
          'status'   => 200,
          'message'  => 'search successful',
          'data'     => $catigories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    
      $cat_created =  Catigory::create($create_data);
        return response()->json([
            'status'   => 200,
            'message'  => 'created successful',
            'data'     => $cat_created
          ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cat = Catigory::findOrFail($id);
        return response()->json([
            'status'   => 200,
            'message'  => 'showed successful',
            'data'     => $cat
          ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CatigoryRequest $request, $id)
    {

        $cat = Catigory::findOrFail($id);
        $create_data = [
            'en' => [
                'name' => $request->input('en')['name']
            ],
            'ar' => [
                'name' => $request->input('ar')['name']
            ]
        ];
    
      $cat_update = $cat->update($create_data);
        return response()->json([
            'status'   => 200,
            'message'  => 'updated successful',
            'data'     => $cat_update
          ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat_deleted = Catigory::findOrFail($id);
        $cat_deleted->delete();
        return response()->json([
            'status'   => 200,
            'message'  => 'deleted successful',
            'data'     => $cat_deleted
          ]);

    }
}
