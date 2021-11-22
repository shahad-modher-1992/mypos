@extends('layouts.dashboard.app')
@section('content')
    
<div class="content-wrapper">
    <section class="content-header">
        <h1> Blank page
            <small>it all starts herer</small>
        </h1>

        <ol class="breadcrumb">
            <li class="active"> <i class="fa fa-dashboard">@lang('site.dashboard')</i></li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">@lang('site.add')</h3>
            </div>
            <div class="box-body">

                @include('partials._errors')
                <form action="{{ route("dashboard.catigory.update", $cat->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">@lang('site.name')</label>
                        <input type="text" class="form-control" name="name" value="{{ $cat->name }}">
                    </div>  
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa faplus"></i>@lang('site.add') </button>
                    </div>
                </form>
            </div>
        </div>  
     </section>
</div>

@endsection