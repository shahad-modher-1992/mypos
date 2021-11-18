@extends('layouts.dashboard.app')
@section('content')
    
<div class="content-wrapper">
    <section class="content-header">
        <h1> @lang('site.dashboard') </h1>

        <ol class="breadcrumb">
            <li class="active"> <i class="fa fa-dashboard">@lang('site.dashboard')</i></li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with border">
                <h3 class="box-title"></h3>
            </div>

            <div class="box-body">
              <h1>Testing</h1>
            </div>
        </div>
    </section>
</div>
@endsection