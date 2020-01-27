@extends('layouts.dashboard')

@section('dashboard-content')
	<div class="container">
		<h1>Items</h1>
	<a href="{{route('items.index')}}" class="btn btn-sm btn-primary mb-5">Back To List</a>
        <div class="row">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Code</th>
                    <th scope="col">Size</th>
                    <th scope="col">Saleable</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Min Quantity</th>
                    <th scope="col">Created</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->code}}</td>
                        <td>{{$item->size}}</td>
                        <td>{{$item->saleable ? 'Yes' : 'No'}}</td>

                        <td>{{$item->brand}}</td>
                        <td>{{$item->minimum_quantity}}</td>
                        <td>{{$item->created_at->format('d/m/Y')}}</td>
                        <td>
                            <div class="row">
                                <div class="col-4">
                                   @if(auth()->user()->is_admin())
                                        <form class="col-md-8" action="{{ route('items.destroy', $item) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button
                                                data-original-title="" title=""
                                                onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''"
                                                type="button" rel="tooltip" class="btn btn-outline-danger btn-sm">
                                                                            Delete
                                            </button>
                                        </form>
                                   @endif
                                </div>

                                <div class="col-4">
                                   @if(auth()->user()->is_admin() || auth()->user()->isStaff())
                                        <a href="{{route('items.edit', $item)}}" class="btn btn-outline-primary btn-sm">Edit</a>
                                   @endif
                                </div>
                                <div class="col-4">
                                    <a href="{{route('items.show', $item)}}" class="btn btn-success btn-sm">View</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
	</div>


@endsection
