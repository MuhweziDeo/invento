@extends('layouts.dashboard')

@section('dashboard-content')

    <div class="container">
        <h1 class="mb-4"> Add Sale </h1>
        <form method="post" action="{{route('sales.store')}}">
            @csrf
            @method('post')
            <div class="select__user row">
                <h2 class="col-md-2">
                    Customer
                </h2>
                <div class="col-md-6 row">
                    <select name="customer_id" class="custom-select mb-5  {{$errors->has('customer_id') ? 'is-invalid': ''}}">
                        <option value="{{$sale->customer->id}}">{{$sale->customer->name}}</option>
                        @foreach($customers as $customer)
                            @if($customer->id != $sale->customer_id)
                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    @if ($errors->has('customer_id'))
                        <span id="code-error" class="error text-danger" for="input-branch_id">{{ $errors->first('customer_id') }}</span>
                    @endif
                </div>

            </div>


            <div class="select__item row">
                <h2 class="col-md-2">
                    Item
                </h2>
                <div class="col-md-6 row">
                    <select name="item_id" class=" custom-select mb-2 {{$errors->has('item_id') ? 'is-invalid': ''}}">
                        <option selected value="{{$sale->item->id}}">{{$sale->item->code}}</option>
                        @foreach($items as $item)
                            @if($item->id != $sale->item_id)
                            <option value="{{$item->id}}">{{$item->code}}</option>
                            @endif
                        @endforeach
                    </select>
                    @if ($errors->has('item_id'))
                        <span id="code-error" class="error text-danger" for="input-branch_id">{{ $errors->first('item_id') }}</span>
                    @endif
                </div>

            </div>

            <div class="form-row">
                <div class="col-md-8 mb-3 row">
                    <input placeholder="quantity" name="quantity" type="number" value="{{$sale->quantity}}"
                           class="form-control {{$errors->has('quantity') ? 'is-invalid': ''}} ">
                    <div class="invalid-feedback">
                        @if ($errors->has('quantity'))
                            <span id="code-error" class="error text-danger" for="input-branch_id">{{ $errors->first('quantity') }}</span>
                        @endif
                    </div>
                </div>

            </div>

            <button class="btn btn-primary" type="submit">Submit form</button>

        </form>
        @if ($errors->has('saleable'))
            <span id="code-error" class="error text-danger" for="input-branch_id">{{ $errors->first('saleable') }}</span>
        @endif
    </div>
@endsection

