<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\catigory;
use Facade\FlareClient\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        return response()->json([
            'status'    => Response::HTTP_OK,
            'message'   => 'success',
            'data'      => $products

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
    public function store(ProductRequest $request)
    {
        $create_date = $request->except('image');

        if($request->hasFile('image')) {
            $imagereqest = $request->image;
            $path = time().'.'.$imagereqest->getClientOriginalExtension();
            $request->image->move('product/', $path);
            $create_date['image'] = $path;
        }

         $product =  Product::create($create_date);
         return response()->json([
             'status'   => Response::HTTP_CREATED,
             'message'  => "this data had been added",
             'data'     => $product
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
        $product = Product::findOrFail($id);
        return response()->json([
            'status'    => Response::HTTP_OK,
            'message'   => "success",
            'data'      => $product

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $create_date = $request->except('image');

        if($request->hasFile('image')) {
            $imagereqest = $request->image;
            $path = time().'.'.$imagereqest->getClientOriginalExtension();
            $request->image->move('product/', $path);
            $create_date['image'] = $path;
        }

        $product = $product->update($create_date);
        return response()->json([
            'status'    => Response::HTTP_OK,
            'message'   => "this data had been updated",
            'data'      => $product

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
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json([
            'status'   => Response::HTTP_OK,
            'message'  => 'this data had been deleted',
            'data'     => $product
        ]);
    }

    // get Product By CatigoryId function
    public function getProductByCatId($id) {
    $cat = catigory::findOrFail($id);
    $products = $cat->products;
    return response()->json([
     'status'  => Response::HTTP_OK,
     'message' => 'get Product By CatigoryId sussess',
     'data'    => $products
    ]);
    }
}
