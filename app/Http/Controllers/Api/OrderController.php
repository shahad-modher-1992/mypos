<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::get();
        return response()->json([
          'status'   => Response::HTTP_OK,
          'message'  => "success",
          "data"     => $orders
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
    public function store(Request $request)
    {

        $order = Order::create($request->all());

        if($request->products) {
            $order->products()->attach($request->products);
        }

        $total_price = 0;
        foreach($request->products as $id=>$product) {

            $pro = Product::find($product['product_id']);
           
            $total_price += $pro->sale_price * $product['qty'] ;

            $pro->update([
                'stock' => $pro->stock - $product['qty']
            ]);
        }

        $order->update([
            'total_price'  => $total_price
        ]);

        return response()->json([
            'status'   => Response::HTTP_OK,
            'message'  => "success",
            "data"     => $order,
          ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order = Order::find($order->id);
        return response()->json([
            'status'   => Response::HTTP_OK,
            'message'  => "success",
            "data"     => $order
          ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {

        $client = Client::find($request->all()['client_id']);
        
         foreach($client->orders as $order) {
             $order->delete();
         }
         $order = Order::create($request->all());

         if($request->products) {
            $order->products()->attach($request->products);
         }
         $total_price = 0;
         foreach($request->products as $id=>$product) {
 
             $pro = Product::findOrFail($product['product_id']);
             
             $total_price += $pro->sale_price * $product['qty'];

             $pro->update([
                 'stock' => $pro->stock - $product['qty']
             ]);

         }
 
         $order->update([
            'total_price'  => $total_price
        ]);
         return response()->json([
             'status'   => Response::HTTP_OK,
             'message'  => "success",
             "data"     => $order,
           ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        foreach($order->products as $product) {
            $product->update([
                'stock' => $product->stock + $product->pivot->qty
            ]);
        }
        $order->delete();

        return response()->json([
            'status'   => Response::HTTP_OK,
            'message'  => "success",
            "data"     => true,
          ]);

    }


    /**
     * start search functon by order's name
     */

     public function search(Request $request) {
         $orders = Order::whereHas('client', function ($q) use($request) {
              return $q->where('name', 'like', '%' . $request->search . '%')
              ->where('id', '=', $request->client_id);
         })->get();

         return response()->json([
            'status'   => Response::HTTP_OK,
            'message'  => "success",
            "data"     => $orders,
          ]);

     }

    

}




