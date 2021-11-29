@extends('layouts.dashboard.app')
@section('content')
    
<div class="content-wrapper">
    <section class="content-header">
        <h1 style="margin-bottom:5px"> @lang('site.clients') 
        </h1>

        <ol class="breadcrumb">
            <li class=""> <a href="{{ route('dashboard.index') }}"> <i class="fa fa-dashboard">@lang('site.dashboard')</i></a></li>
            <li class="active"> @lang('site.clients')
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with border">
                <h3 class="box-title" style="margin-bottom: 10px" >@lang('site.clients')  <small>{{ $clients->total() }}</small></h3>

                <form action="{{ route("dashboard.client.index") }}" method="GET">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> @lang('site.search')</button>
                            <a href="{{ route("dashboard.client.create") }}" class="btn btn-primary"><i class="fa fa-plus"style="margin-right:5px"></i>@lang('site.create')</a>
                        </div>
                    </div>
                </form>
            </div>


            <div class="box-body">
                <table class="table table-hover">
                    @if ($clients->count() > 0)

                   <thead>
                       <tr>
                           <th>index</th>
                           <th>@lang('site.name')</th>
                           <th>@lang('site.phone')</th>
                           <th>@lang('site.address')</th>
                           <th>@lang('site.add_order')</th>
                           <th>@lang('site.action')</th>
                       </tr>
                   </thead>
                       
                   @foreach ($clients as $client)
                       <tbody>
                           <tr>
                               <td>{{ $client->id }}</td>
                               <td>{{ $client->name }}</td>
                               <td>{{ $client->phone}}</td>
                               <td>{{ $client->address }}</td>            
                               <td><a href="{{ route('dashboard.client.order.create', $client->id) }}" class="btn btn-primary btn-sm">@lang('site.add_order')</a></td>      
                               <td>
                                   <a href="{{ route('dashboard.client.edit', $client->id) }}" class="btn btn-info btn-sm">@lang('site.edit')</a>
                                   <form action="{{ route("dashboard.client.destroy", $client->id) }}" style="display: inline-block; margin-right: 10px" method="post">
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

                {{ $clients->appends(request()->query())->links() }}
            </div>
        </div>
    </section>
</div>
@endsection