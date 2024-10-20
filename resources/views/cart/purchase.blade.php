@extends('layouts.app')
@section('title', 'Purshase')
@section('content')
<div class="card">
<div class="card-header">
Purchase Completed
</div>
<div class="card-body">
<div class="alert alert-success" role="alert">
Congratulations, purchase completed. Order number is <b>#{{ $order->id }}</b>
</div>
</div>
</div>
@endsection
