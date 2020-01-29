@extends('layouts.dashboard')

@section('dashboard-content')

    <div class="container">
        <h1> Edit Service </h1>
        <form method="post" action="{{route('services.update', $service)}}">
            @csrf
            @method('put')
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationServer01">Name</label>
                    <input name="name" value="{{$service->name}}" type="text"
                           class="form-control {{$errors->has('name') ? 'is-invalid': ''}} ">
                    <div class="invalid-feedback">
                        @if ($errors->has('name'))
                            <span id="code-error" class="error text-danger" for="input-branch_id">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>


                <div class="col-md-6 mb-3">
                    <label for="validationServer02">Labor cost</label>
                    <input name="labor" value="{{$service->labor}}" type="number" class="form-control  {{$errors->has('labor') ? 'is-invalid': ''}}>
                    <div class="invalid-size">
                        @if ($errors->has('labor'))
                            <span id="size_id-error" class="error text-danger" for="input-size">{{ $errors->first('labor') }}</span>
                        @endif
                    </div>
                </div>

            <button class="btn btn-primary text-center" type="submit">Submit form</button>
            </form>

    </div>
@endsection

