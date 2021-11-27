<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::get();
        return response()->json([
          'status'   => Response::HTTP_OK,
          "mesaage"  => 'success',
          'data'     => $clients
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
    public function store(ClientRequest $request)
    {
        $client = Client::create($request->all());
        return response()->json([
            'status'   => Response::HTTP_OK,
            "mesaage"  => 'success',
            'data'     => $client
          ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $client = Client::findOrFail($client->id);
        return response()->json([
            'status'   => Response::HTTP_OK,
            "mesaage"  => 'success',
            'data'     => $client
          ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, Client $client)
    {
        $client = Client::findOrFail($client->id);
        $client->update($request->all());
        return response()->json([
            'status'   => Response::HTTP_OK,
            "mesaage"  => 'success',
            'data'     => $client
          ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client = Client::findOrFail($client->id);
        $client->delete();
        return response()->json([
            'status'   => Response::HTTP_OK,
            "mesaage"  => 'success',
            'data'     => $client
          ]);
    }

    /**
     *  search for clients by name or phone or address function
     */
    public function search(Request $request) {

        $clients = Client::when($request->search, function($q) use ($request) {

         return $q->where('name', 'like', '%' . $request->search . '%')
         ->orWhere('phone', 'like', '%' . $request->search . '%')
         ->orWhere('address', 'like', '%' . $request->search . '%');
        })->get();

        return response()->json([
          'status'    => Response::HTTP_OK,
          'message'   => 'success',
          'data'      => $clients
        ]);
    }

}
