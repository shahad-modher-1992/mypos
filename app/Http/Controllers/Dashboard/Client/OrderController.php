<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Models\catigory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Client $client)
    {
        // dd($client->id);
        $cats = Catigory::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('dashboard.clients.order.create', compact( 'client', 'cats','orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Client $client)
    {
        $order = $client->orders()->create([]);
        $order->products()->attach($request->products);

        $total_price = 0;
        foreach($request->products as $id=>$product) {

            $pro = Product::find($id);
            $total_price += $pro->sale_price * $product['qty'] ;

            $pro->update([
                'stock' => $pro->stock - $product['qty']
            ]);

        }

        $order->update([
            'total_price'  => $total_price
        ]);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.order.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client, Order $order)
    {
        $categories = catigory::paginate(4);
        $orders = Order::paginate(4);
        return view('dashboard.clients.order.edit', compact('orders', 'categories', 'order', 'client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client, Order $order)
    {

          foreach($client->orders as $order) {
             $order->delete();
          }

          $order = $client->orders()->create([]);
          $order->products()->attach($request->products);
  
          $total_price = 0;
          foreach($request->products as $id=>$product) {
  
              $pro = Product::find($id);
              $total_price += $pro->sale_price * $product['qty'] ;
  
              $pro->update([
                  'stock' => $pro->stock - $product['qty']
              ]);
          }
  
          $order->update([
              'total_price'  => $total_price
          ]);
          
          session()->flash('success', __('site.updated_successfully'));
          return redirect()->route('dashboard.order.index');
      
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
