@extends('layouts.dashboard.app')
@section('content')
    
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.products')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route("dashboard.index") }}"> <i class="fa fa-dashboard">@lang('site.dashboard')</i></a></li>
            <li><a href="{{ route("dashboard.product.index") }}">@lang('site.products')</a></li>
            <li class="active"> @lang('site.edit')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">@lang('site.edit')</h3>
            </div>
            <div class="box-body">

                @include('partials._errors')
                <form action="{{ route("dashboard.product.update", $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                   @foreach (config('translatable.locales') as $locale )
                       
                   <div class="form-group">
                       <label for="">@lang('site.'. $locale . '.name')</label>
                       <input type="text" class="form-control" name="{{ $locale }}[name]" value="{{ $product->translate($locale)->name }}">
                   </div>  
                 

                   <div class="form-group">
                    <label for="">@lang('site.'. $locale . '.description')</label>
                    <textarea  class="form-control" name="{{ $locale }}[desc]" > {{ $product->translate($locale)->desc  }} </textarea>
                   </div>        
                   @endforeach

                   <div class="form-group">
                       <label for="">@lang('site.categories')</label>
                       <select name="catigory_id" class="form-control" >
                           <option value="{{ $product->catigory->id }}">{{ $product->catigory->name }}</option>
                           @foreach ($cats as $cat)
                               <option value="{{ $cat->id }}" >{{ $cat->name }}</option>
                           @endforeach
                       </select>
                   </div>
                   <div class="form-group">
                    <label for="">@lang('site.image')</label>
                    <input type="file" class="form-control" name="image" value="">
                   </div>   

                   <div class="form-group">
                    <label for="">@lang('site.purchase_price')</label>
                    <input type="text" class="form-control" name="purchase_price" value="{{ $product->purchase_price }}">
                   </div>   
                   <div class="form-group">
                    <label for="">@lang('site.sale_price')</label>
                    <input type="text" class="form-control" name="sale_price" value="{{ $product->sale_price }}">
                   </div>   
                   <div class="form-group">
                    <label for="">@lang('site.stock')</label>
                    <input type="text" class="form-control" name="stock" value="{{ $product->stock }}">
                   </div>   
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa faplus"></i>@lang('site.edit') </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection