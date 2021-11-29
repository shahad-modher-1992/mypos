<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\catigory;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $products = Product::paginate(3);
        $cats = catigory::get();

        $products =  Product::when($request->search, function($q) use ($request) {
              return  $q->whereTranslationLike('name', '%'. $request->search . '%')
              ->where('catigory_id' ,  $request->catigory_id);
              })->paginate(3);
      
        return view('dashboard.products.index', compact('products', 'cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = catigory::get();
        return view('dashboard.products.create', compact('cats'));
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

        Product::create($create_date);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $cats = catigory::get();
        return view('dashboard.products.edit', compact('product', 'cats'));
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {

        $product = Product::findOrFail($product->id);
        $create_date = $request->except('image');

        if($request->hasFile('image')) {
            $imagereqest = $request->image;
            $path = time().'.'.$imagereqest->getClientOriginalExtension();
            $request->image->move('product/', $path);
            $create_date['image'] = $path;
        }

       $product->update($create_date);
       session()->flash('success', __('site.updated_successfully'));
       return redirect()->route('dashboard.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product = Product::findOrFail($product->id);
        $product->delete();
        session()->flash('success' ,__('site.deleted_successfully'));
        return back();
    }
}
