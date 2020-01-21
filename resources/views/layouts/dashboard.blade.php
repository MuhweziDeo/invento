@extends('layouts.app')

@section('content')
<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light card shadow" id="sidebar-wrapper">
        <div class="list-group list-group-flush">
            <a href="#" class="list-group-item active list-group-item-action">Dashboard</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Users</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Services</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Items</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Profile</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Sales</a>
        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            @yield('dashboard-content')
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->
@endsection
