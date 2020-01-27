@extends('layouts.dashboard')

@section('dashboard-content')

    <div class="container">
        <h1> Edit Item {{$item->code}} </h1>
        <form method="post" action="{{route('items.update', $item)}}">
            @csrf
            @method('put')
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationServer01">Code</label>
                    <input id="val" value="{{$item->code}}" name="code" type="text"
                           class="form-control {{$errors->has('code') ? 'is-invalid': ''}} ">
                    <div class="invalid-feedback">
                        @if ($errors->has('code'))
                            <span id="code-error" class="error text-danger" for="input-branch_id">{{ $errors->first('code') }}</span>
                        @endif
                    </div>
                </div>


                <div class="col-md-6 mb-3">
                    <label for="validationServer02">Size</label>
                    <input name="size" type="number" class="form-control  {{$errors->has('size') ? 'is-invalid': ''}}"
                           value="{{$item->size}}">
                    <div class="invalid-size">
                        @if ($errors->has('size'))
                            <span id="size_id-error" class="error text-danger" for="input-size">{{ $errors->first('size') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationServer02">Cost</label>
                    <input name="cost" type="number" class="form-control  {{$errors->has('cost') ? 'is-invalid': ''}}"
                           value="{{$item->cost}}">
                    <div class="invalid-feedback">
                        @if ($errors->has('cost'))
                            <span id="cost-error" class="error text-danger" for="input-branch_id">{{ $errors->first('cost') }}</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="validationServer02">Minimum quantity</label>
                    <input name="minimum_quantity" type="number" class="form-control  {{$errors->has('minimum_quantity') ? 'is-invalid': ''}}"
                           value="{{$item->minimum_quantity}}">
                    <div class="invalid-feedback">
                        @if ($errors->has('minimum_quantity'))
                            <span id="minimum_quantity-error" class="error text-danger" for="input-branch_id">{{ $errors->first('minimum_quantity') }}</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="validationServer02">Quantity</label>
                    <input name="quantity" type="number" class="form-control  {{$errors->has('quantity') ? 'is-invalid': ''}}"
                           value="{{$item->quantity}}">
                    <div class="invalid-feedback">
                        @if ($errors->has('quantity'))
                            <span id="quantity-error" class="error text-danger" for="input-branch_id">{{ $errors->first('quantity') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationServer02">Brand</label>
                    <input name="brand" type="text" value="{{$item->brand}}" class="form-control {{$errors->has('brand') ? 'is-invalid': ''}}" id="validationServer02">
                    <div class="invalid-feedback">
                        @if ($errors->has('brand'))
                            <span id="branch_id-error" class="error text-danger" for="input-branch_id">{{ $errors->first('brand') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <button class="btn btn-primary" type="submit">Submit form</button>
        </form>
    </div>
@endsection

