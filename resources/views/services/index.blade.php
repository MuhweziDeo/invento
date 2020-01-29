@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="container">
        <h1>Service</h1>
        <a href="{{route('services.create')}}" class="btn btn-sm btn-primary mb-5">Add Service</a>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Cost</th>
                <th scope="col">Name</th>
                <th scope="col">Added</th>
                <th scope="col" class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($services as $service)
                <tr>
                    <td>{{$service->id}}</td>
                    <td>{{$service->labor}}</td>
                    <td>{{$service->name}}</td>
                    <td>{{$service->created_at}}</td>
                    <td>
                        <div class="row">
                            <div class="col-4">
                                @if(auth()->user()->is_admin())
                                    <form class="col-md-8" action="{{ route('services.destroy', $service) }}" method="post">
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
                                    <a href="{{route('services.edit', $service)}}" class="btn btn-outline-primary btn-sm">Edit</a>
                                @endif
                            </div>
                            <div class="col-4">
                                <a href="{{route('services.show', $service)}}" class="btn btn-success btn-sm">View</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
