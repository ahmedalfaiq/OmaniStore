@extends('layouts.app')
@section('title', 'Orders')
@section('content')
    <div class="container">
        @forelse ($orders as $order)
            <div class="card mb-4">
                <div class="card-header">
                    Order #{{ $order->id }}
                </div>
                <div class="card-body">
                    <b>Date:</b> {{ $order->created_at }}<br />
                    <b>Total:</b> ${{ $order->total }}<br />
                    <b>Delivered?</b> {{ $order->delivered }} <br>
                    @if (count($order->items) < 1)
                    @else
                        <table class="table table-bordered table-striped text-center mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">Item ID</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Size</th>
                                    {{-- <th scope="col">Delivered</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>
                                            {{--  href="{{ route('product.show', ['id' => $item->product->id]) }}" --}}
                                            <a class="link-success">
                                                {{ $item->product->name }}
                                            </a>
                                        </td>
                                        <td>${{ $item->price }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->size }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                </div>
            </div>
        @empty
            <div class="alert alert-danger" role="alert">
                Seems to be that you have not purchased anything in our store =(.
            </div>
        @endforelse

    </div>
@endsection
