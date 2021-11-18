@extends('layouts.dashboard.app')
@section('content')
    
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.users')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route("dashboard.index") }}"> <i class="fa fa-dashboard">@lang('site.dashboard')</i></a></li>
            <li><a href="{{ route("dashboard.user.index") }}">@lang('site.users')</a></li>
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
                <form action="{{ route("dashboard.user.store") }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">@lang('site.name')</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="">@lang('site.email')</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="">@lang('site.password')</label>
                        <input type="password"  class="form-control"name="password">
                    </div>

                    <div class="form-group">
                        <label for="">@lang('site.password_confirmation')</label>
                        <input type="password"class="form-control"  name="password_confirmation">
                    </div>

                    <div class="form-group">
                        <h3>@lang('site.permissions')</h3>
                        @foreach ($permissions as $permission)
                        <label for="" style="margin-right: 10px" >{{ $permission->name }}</label>
                        <input type="checkbox"   name="permissions[]" value="{{ $permission->id }}">
                        @endforeach
                  
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