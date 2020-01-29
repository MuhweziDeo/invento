@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="container">
        <h1>Service Sale</h1>
        <a href="{{route('service-sales.create')}}" class="btn btn-sm btn-primary mb-5">Add Sale</a>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Service Name</th>
                <th scope="col">Item </th>
                <th scope="col">Customer</th>
                <th>Cost</th>
                <th scope="col" class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td>{{$sale->id}}</td>
                    <td>{{$sale->service->name}}</td>
                    <td>{{$sale->item->name}}</td>
                    <td>{{$sale->customer->email}}</td>
                    <td>{{$sale->service->labor + $sale->item->cost}}</td>

                    <td>
                        <div class="row">
                            <div class="col-4">
                                @if(auth()->user()->is_admin())
                                    <form class="col-md-8" action="{{ route('service-sales.destroy', $sale) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button
                                            data-original-title="" title=""
                                            onclick="confirm('{{ __("Are you sure you want to delete this item?") }}') ? this.parentElement.submit() : ''"
                                            type="button" rel="tooltip" class="btn btn-outline-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            </div>

                            <div class="col-4">
                                @if(auth()->user()->is_admin() || auth()->user()->isStaff())
                                    <a href="{{route('service-sales.edit', $sale)}}" class="btn btn-outline-primary btn-sm">Edit</a>
                                @endif
                            </div>
                            <div class="col-4">
                                <a href="{{route('service-sales.show', $sale)}}" class="btn btn-success btn-sm">View</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
