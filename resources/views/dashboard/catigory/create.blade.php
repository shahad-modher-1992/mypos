@extends('layouts.dashboard.app')
@section('content')
    
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.users')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route("dashboard.index") }}"> <i class="fa fa-dashboard">@lang('site.dashboard')</i></a></li>
            <li><a href="{{ route("dashboard.catigory.index") }}">@lang('site.catigories')</a></li>
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
                <form action="{{ route("dashboard.catigory.store") }}" method="post" enctype="multipart/form-data">
                    @csrf

                   @foreach (config('translatable.locales') as $locale )
                       
                   <div class="form-group">
                       <label for="">@lang('site.'. $locale . '.name')</label>
                       <input type="text" class="form-control" name="{{ $locale }}[name]" value="{{ old($locale . '[name]') }}">
                   </div>  
                   @endforeach

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa faplus"></i>@lang('site.add') </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection