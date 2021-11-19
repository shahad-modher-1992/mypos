@extends('layouts.dashboard.app')
@section('content')
    
<div class="content-wrapper">
    <section class="content-header">
        <h1 style="margin-bottom:5px"> @lang('site.users') 
        </h1>

        <ol class="breadcrumb">
            <li class=""> <a href="{{ route('dashboard.index') }}"> <i class="fa fa-dashboard">@lang('site.dashboard')</i></a></li>
            <li class="active"> @lang('site.users')
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with border">
                <h3 class="box-title" style="margin-bottom: 10px" >@lang('site.users')  <small>{{ $users->total() }}</small></h3>

                <form action="{{ route("dashboard.user.index") }}" method="GET">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> @lang('site.search')</button>
                            <a href="{{ route("dashboard.user.create") }}" class="btn btn-primary"><i class="fa fa-plus"style="margin-right:5px"></i>@lang('site.create')</a>
                        </div>
                    </div>
                </form>
            </div>


            <div class="box-body">
                <table class="table table-hover">
                    @if ($users->count() > 0)

                   <thead>
                       <tr>
                           <th>index</th>
                           <th>@lang('site.name')</th>
                           <th>@lang('site.image')</th>
                           <th>role</th>
                           <th>@lang('site.email')</th>
                           <th>@lang('site.action')</th>
                       </tr>
                   </thead>
                       
                   @foreach ($users as $user)
                       <tbody>
                           <tr>
                               <td>{{ $user->id }}</td>
                               <td>{{ $user->name }}</td>
                               <td><img width="50" height="50" src='{{ asset("user/$user->image") }}' alt=""></td>
                               <td>
                                   @foreach ($user->roles as $role)
                                   {{ $role->name }}
                                   @endforeach
                                </td>
                               <td>{{ $user->email }}</td>
                               <td>
                                   <a href="{{ route('dashboard.user.edit', $user->id) }}" class="btn btn-info btn-sm">@lang('site.edit')</a>

                                   <form action="{{ route("dashboard.user.destroy", $user->id) }}" style="display: inline-block; margin-right: 10px" method="post">
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

                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
    </section>
</div>
@endsection