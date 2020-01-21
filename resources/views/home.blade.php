@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="d-flex" id="wrapper">

<!-- Sidebar -->
<div class="bg-light border-right" id="sidebar-wrapper">
  <div class="list-group list-group-flush">
    <a href="#" class="list-group-item list-group-item-action bg-light">Dashboard</a>
    <a href="#" class="list-group-item list-group-item-action bg-light">Users</a>
    <a href="#" class="list-group-item list-group-item-action bg-light">Services</a>
    <a href="#" class="list-group-item list-group-item-action bg-light">Items</a>
    <a href="#" class="list-group-item list-group-item-action bg-light">Profile</a>
    <a href="#" class="list-group-item list-group-item-action bg-light">Status</a>
  </div>
</div>
<!-- /#sidebar-wrapper -->

<!-- Page Content -->
<div id="page-content-wrapper">
  <div class="container-fluid">
    <h1 class="mt-4">Simple Sidebar</h1>
    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
    <p>The starting state of the menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will change.</p>
    <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>. The top navbar is optional, and just for demonstration. Just create an element with the <code>#menu-toggle</code> ID which will toggle the menu when clicked.</p>
  </div>
</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->
@endsection
