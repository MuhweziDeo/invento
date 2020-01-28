@extends('layouts.dashboard')

@section('dashboard-content')

    <div class="container">
        <h1>{{Request::path()}}</h1>
        @if(auth()->user()->is_admin())
        <a href="{{route('users.create')}}" class="btn btn-primary btn-sm text-white mb-5">
            Add User
        </a>
        @endif

        <div class="row">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Staff</th>
                    <th scope="col">Created</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                   <tr>
                       <td>{{$user->id}}</td>
                       <td>{{$user->name}}</td>
                       <td>{{$user->email}}</td>
                       <td>{{$user->is_admin() || $user->isStaff() ? "true": "false"}}</td>

                       <td>{{$user->created_at->format('d/m/Y')}}</td>
                       <td>
                           <div class="row">

                               <div class="col-4">
                                   @if(auth()->user()->is_admin() && auth()->id() !== $user->id)
                                   <form class="col-md-8" action="{{ route('users.destroy', $user) }}" method="post">
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
                                   @if(auth()->user()->is_admin() || auth()->id() == $user->id)
                                   <a href="{{route('users.edit', $user)}}" class="btn btn-outline-primary btn-sm">Edit</a>
                                   @endif
                               </div>
                               <div class="col-4">
                                   <a href="{{route('users.show', $user)}}" class="btn btn-success btn-sm">View</a>
                               </div>
                           </div>
                       </td>
                   </tr>
                @endforeach
                </tbody>
            </table>
            {{$users->links()}}
        </div>

    </div>
@endsection

