@extends('layouts.app')
@section('title', 'Cart')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Products in Cart
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Size</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>${{ $product->price }}</td>
                                <td>{{ session('products')[$product->id][1] }}</td>
                                <td>{{ session('products')[$product->id][0] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="text-end">
                        <a class="btn btn-outline-secondary mb-2"><b>Total to pay:</b> ${{ $total }}</a>
                        @if (count($products) > 0)
                            <a href="{{ route('cart.purchase') }}" class="btn bg-primary text-white mb-2">Purchase</a>
                            <a href="{{ route('cart.delete') }}">
                                <button class="btn btn-danger mb-2">
                                    Remove all products from Cart
                                </button>
                            </a>
                        @endif
                        {{-- <a href="{{ route('cart.delete') }}">
                    <button class="btn btn-danger mb-2">
                    Remove all products from Cart
                    </button>
                    </a> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
