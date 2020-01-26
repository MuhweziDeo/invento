@extends('layouts.dashboard')

@section('dashboard-content')

    <div class="container">
        <h1> Edit {{$user->name}} </h1>
        <form method="post" action="{{route('users.update', $user)}}">
            @csrf
            @method('put')
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationServer01">Name</label>
                    <input name="name" type="text" class="form-control {{$errors->has('name') ? 'is-invalid': ''}} "
                           value="{{ $user->name }}">
                    <div class="invalid-feedback">
                        @if ($errors->has('name'))
                            <span id="branch_id-error" class="error text-danger" for="input-branch_id">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    @if ($errors->has('name_taken'))
                        <span id="branch_id-error" class="error text-danger" for="input-branch_id">{{ $errors->first('name_taken') }}</span>
                    @endif
                </div>

                <div class="col-md-6 mb-3">
                    <label for="validationServerUsername">Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend3">@</span>
                        </div>
                        <input name="email" type="text" class="form-control {{$errors->has('email') ? 'is-invalid': ''}}"
                               value="{{ $user->email }}" aria-describedby="inputGroupPrepend3">
                        <div class="invalid-feedback">
                            @if ($errors->has('email'))
                                <span id="branch_id-error" class="error text-danger" for="input-branch_id">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                    </div>
                    @if ($errors->has('email_taken'))
                        <span id="branch_id-error" class="error text-danger" for="input-branch_id">{{ $errors->first('email_taken') }}</span>
                    @endif
                </div>
            </div>
            @if($user->is_admin)
            <div class="form-group">
                <div class="form-check">
                    <input name="is_admin" class="form-check-input" type="checkbox"
                          checked id="invalidCheck3">
                    <label class="form-check-label" for="invalidCheck3">
                        Is Admin
                    </label>
                </div>
            </div>
            @else
                <div class="form-group">
                    <div class="form-check">
                        <input name="is_admin" class="form-check-input" type="checkbox"
                               id="invalidCheck3">
                        <label class="form-check-label" for="invalidCheck3">
                            Is Admin
                        </label>
                    </div>
                </div>
            @endif
            <button class="btn btn-primary" type="submit">Submit form</button>
        </form>
    </div>
@endsection

