@extends('layouts.dashboard.app')
@section('content')
    
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.clients')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route("dashboard.index") }}"> <i class="fa fa-dashboard">@lang('site.dashboard')</i></a></li>
            <li><a href="{{ route("dashboard.client.index") }}">@lang('site.clients')</a></li>
            <li class="active"> @lang('site.add')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">@lang('site.add')</h3>
            </div>
            <div class="box-body">

                @include('partials._errors')
                <form action="{{ route("dashboard.client.update", $client->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                   <div class="form-group">
                       <label for="">@lang('site.name')</label>
                       <input type="text" class="form-control" name="name" value="{{ $client->name}}">
                   </div>  
                   <div class="form-group">
                       <label for="">@lang('site.phone')</label>
                       <input type="text" class="form-control" name="phone" value="{{ $client->phone }}">
                   </div>  
                   <div class="form-group">
                       <label for="">@lang('site.address')</label>
                       <input type="text" class="form-control" name="address" value="{{ $client->address}}">
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