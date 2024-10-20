@extends('layouts.admin')
@section('title', 'Home ')
@section('content')
    <div class="row p-1">
        <div class="col-2">
            <label for="sorting" class="col-form-label form-label">Filter By:</label>
        </div>
        <div class="col">
            <div class="filters">
                <form action="{{ route('products.type') }}" method="GET">
                    @csrf
                    <select id="sorting" class="form-select" name="type" onchange="this.form.submit()">
                        <option value="Men" {{ $type == 'Men' ? 'selected' : '' }}>Men</option>
                        <option value="Women" {{ $type == 'Women' ? 'selected' : '' }}>Women</option>
                        <option value="Accessory" {{ $type == 'Accessory' ? 'selected' : '' }}>Accessory</option>
                    </select>
                </form>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            New Product
        </div>
        <div class="card-body">
            @if ($errors->any())
                <ul class="alert alert-danger list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Name:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="name" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Price :</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="price" type="number" min="0" step="0.1" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Size :</label>
                            <div class="col-lg-9 col-md-6 col-sm-12">
                                <select name="size" id="size" class="form-select">
                                    <option value="XS">XS</option>
                                    <option value="S,XS">S,XS</option>
                                    <option value="S,XS,M">S,XS,M </option>
                                    <option value="S,XS,M,L">S,XS,M,L</option>
                                    <option value="S,XS,M,L,XL">S,XS,M,L,XL</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="mb-3 row">
                            <label class="col-lg-3 col-md-6 col-sm-12 col-form-label">Category :</label>
                            <div class="col-lg-9 col-md-6 col-sm-12">
                                <select name="category_id" id="category_id" class="form-select">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">

                    <div class="col">
                        <div class=" mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>



    {{--  --}}
    <div class="card">
        <div class="card-header">
            <h3>Manage Product</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price</th>
                        <th scope="col">Size</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->size }}</td>
                            <td>
                                <a href="{{ route('admin.product.show', ['id' => $product->id]) }}">
                                    <button class="btn btn-primary"><i class="bi-pencil"></i></button>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('admin.product.delete', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">
                                        <i class="bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <hr>
@endsection
