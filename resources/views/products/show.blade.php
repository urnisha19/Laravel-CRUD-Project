@extends('products.layout')
@section('content')
    
    <div class="row text-center">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <h2>{{ $product->product_name }}</h2>
            </div>
        </div>
        <div class="form-group">
            <img src="/image/{{ $product->product_image }}"class="rounded" width="300" height="300">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Weight:</strong>
                {{ $product->product_weight}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Price:</strong>
                {{ $product->product_price}}
            </div>
        </div>
        <div class="pull left">
            <a class="btn btn-primary" href="{{ route('products.index') }}">Go Back</a>
        </div>
    </div>
@endsection