@extends('layouts.dashboard')

@section('dashboard-content')

    <div class="container">
        <h1> Add User </h1>
        <form method="post" action="{{route('users.store')}}">
            @csrf
            @method('post')
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationServer01">Name</label>
                    <input name="name" type="text" class="form-control {{$errors->has('name') ? 'is-invalid': ''}} "
                           value="{{ old('name') }}">
                    <div class="invalid-feedback">
                        @if ($errors->has('name'))
                            <span id="branch_id-error" class="error text-danger" for="input-branch_id">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="validationServerUsername">Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend3">@</span>
                        </div>
                        <input name="email" type="text" class="form-control {{$errors->has('email') ? 'is-invalid': ''}}"
                             value="{{ old('email') }}" aria-describedby="inputGroupPrepend3">
                        <div class="invalid-feedback">
                            @if ($errors->has('email'))
                                <span id="branch_id-error" class="error text-danger" for="input-branch_id">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationServer02">password</label>
                    <input name="password" type="password" class="form-control  {{$errors->has('password') ? 'is-invalid': ''}}"
                           value="{{ old('password') }}">
                    <div class="invalid-feedback">
                        @if ($errors->has('password'))
                            <span id="branch_id-error" class="error text-danger" for="input-branch_id">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationServer02">Confirmation</label>
                    <input name="password_confirmation" type="password" class="form-control {{$errors->has('password_confirmation') ? 'is-invalid': ''}}" id="validationServer02">
                    <div class="invalid-feedback">
                        @if ($errors->has('password_confirmation'))
                            <span id="branch_id-error" class="error text-danger" for="input-branch_id">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input name="is_admin" class="form-check-input" type="checkbox" id="invalidCheck3">
                    <label class="form-check-label" for="invalidCheck3">
                        Is Admin
                    </label>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Submit form</button>
        </form>
    </div>
@endsection

