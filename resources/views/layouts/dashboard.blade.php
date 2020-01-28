@extends('layouts.app')

@section('content')
<div class="d-flex" >
    <div class="bg-light card shadow"  style="width: 10rem">
        <div class="list-group list-group-flush">
            <a href="/" class="list-group-item list-group-item-action {{Request::path() === '/' ? 'active': ''}}">Home</a>
            <a href="#" class="list-group-item list-group-item-action ">Profile</a>
            @if(auth()->user()->is_admin())
                <a href="{{route('users.index')}}" class="list-group-item list-group-item-action
                {{\Request::is('users/*') || \Request::is('users') ? 'active': ''}}">Users</a>
            @endif
            <a href="" class="list-group-item list-group-item-action ">Services</a>
            @if(auth()->user()->isStaff())

                <a href="{{route('items.index')}}" class="list-group-item list-group-item-action {{\Request::is('items/*') || \Request::is('items') ? 'active': ''}} ">Items</a>
                <a href="{{route('sales.index')}}" class="list-group-item list-group-item-action {{\Request::is('sales/*') || \Request::is('sales') ? 'active': ''}} ">Sales</a>
            @endif
            <a href="#" class="list-group-item list-group-item-action ">Customers</a>
        </div>
    </div>
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
                @if ($errors->has('permission_denied'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $errors->first('permission_denied') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            @yield('dashboard-content')
        </div>

</div>
@endsection
