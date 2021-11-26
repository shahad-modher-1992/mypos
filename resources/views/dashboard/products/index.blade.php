@extends('layouts.dashboard.app')
@section('content')
    
<div class="content-wrapper">
    <section class="content-header">
        <h1 style="margin-bottom:5px"> @lang('site.products') 
        </h1>

        <ol class="breadcrumb">
            <li class=""> <a href="{{ route('dashboard.index') }}"> <i class="fa fa-dashboard">@lang('site.dashboard')</i></a></li>
            <li class="active"> @lang('site.products')
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with border">
                <h3 class="box-title" style="margin-bottom: 10px" >@lang('site.products')  <small>{{ $products->total() }}</small></h3>

                <form action="{{ route("dashboard.product.index") }}" method="GET">
                    @csrf
                    <div class="row">

                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                        </div>

                        <div class="col-md-4">
                            <select type="text" name="catigory_id" class="form-control"> 
                                <option value=""> @lang('site.all_categories')</option>
                                @foreach ($cats as $cat)
                                    <option value="{{ $cat->id }}" {{ request()->catigory_id == $cat->id ? "selected" : "" }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> @lang('site.search')</button>
                            <a href="{{ route("dashboard.product.create") }}" class="btn btn-primary"><i class="fa fa-plus"style="margin-right:5px"></i>@lang('site.create')</a>
                        </div>
                    </div>
                </form>
            </div>


            <div class="box-body">
                <table class="table table-hover">
                    @if ($products->count() > 0)

                   <thead>
                       <tr>
                           <th>index</th>
                           <th>@lang('site.name')</th>
                           <th>@lang('site.description')</th>
                           <th>@lang('site.image')</th>
                           <th>@lang('site.stock')</th>
                           <th>@lang('site.purchase_price')</th>
                           <th>@lang('site.sale_price')</th>
                           <th>@lang('site.profit_percent')</th>
                           <th>@lang('site.action')</th>
                       </tr>
                   </thead>
                       
                   @foreach ($products as $product)
                       <tbody>
                           <tr>
                               <td>{{ $product->id }}</td>
                               <td>{{ $product->name }}</td>
                               <td>{{ $product->desc }}</td>
                               <td> <img src="{{asset("product/$product->image")}}" width="50px", height="50px"></td>
                               <td>{{ $product->stock }}</td>
                               <td>{{ $product->purchase_price }}</td>
                               <td>{{ $product->sale_price }}</td>
                               <td>{{ $product->profit_percent }} %</td>
                       
                               <td>
                                   <a href="{{ route('dashboard.product.edit', $product->id) }}" class="btn btn-info btn-sm">@lang('site.edit')</a>
                                   <form action="{{ route("dashboard.product.destroy", $product->id) }}" style="display: inline-block; margin-right: 10px" method="post">
                                     @csrf
                                     @method('delete')
                                     <button type="submit" class="btn btn-danger delete btn-sm">@lang('site.delete')</button>
                                  </form>
                               </td>
                           </tr>
                       </tbody>
                   @endforeach

                   @else
                   <h3>@lang('site.no_data_found')</h3>
                   @endif
                </table>

                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </section>
</div>
@endsection