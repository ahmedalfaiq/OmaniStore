@extends('layouts.admin')
@section('title', 'Home ')
@section('content')
    {{-- @if (isset($product))
        <div class="row p-1">
            <div class="col-2">
                <label for="sorting" class="col-form-label form-label">Filter By:</label>
            </div>
            <div class="col">
                <div class="filters">
                    <form action="{{ route('products.type') }}" method="GET">
                        @csrf
                        <select id="sorting" class="form-select" name="type" disabled onchange="this.form.submit()">
                            <option value="Men" {{ $type == 'Men' ? 'selected' : '' }}>Men</option>
                            <option value="Women" {{ $type == 'Women' ? 'selected' : '' }}>Women</option>
                            <option value="Accessory" {{ $type == 'Accessory' ? 'selected' : '' }}>Accessory</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    @else
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
    @endif --}}

    @if (isset($product))
        <div class="card mb-4">
            <div class="card-header">
                Update Product ({{ $product->name }})
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <ul class="alert alert-danger list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <form method="POST" action="{{ route('admin.product.update', [$product->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Name:</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                    <input name="name" value="{{ $product->name }}" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Price :</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                    <input name="price" type="number" min="0" step="0.1"
                                        value="{{ $product->price }}" class="form-control">
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
                                        <option @selected($product->size == 'XS') value="XS">XS</option>
                                        <option @selected($product->size == 'S,XS') value="S,XS">S,XS</option>
                                        <option @selected($product->size == 'S,XS,M') value="S,XS,M">S,XS,M </option>
                                        <option @selected($product->size == 'S,XS,M,L') value="S,XS,M,L">S,XS,M,L</option>
                                        <option @selected($product->size == 'S,XS,M,L,XL') value="S,XS,M,L,XL">S,XS,M,L,XL</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3 row">
                                <label class="col-lg-3 col-md-6 col-sm-12 col-form-label">Category :</label>
                                <div class="col-lg-9 col-md-6 col-sm-12">
                                    <select name="category_id" id="category_id" class="form-select">
                                        @foreach ($categories as $cat)
                                            <option @selected($product->category_id == $cat->id) value="{{ $cat->id }}">
                                                {{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">

                        <div class="col">

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="3">
                                {{ $product->description }} </textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary m-3 me-3">Update</button>
                    </div>
                </form>
            </div>
        </div>
    @else
    @endif


    {{--  --}}
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-4">
                    <h3>Manage Product</h3>
                </div>
                <form method="POST" action="{{ route('admin.product.image') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Image :</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                    <input name="image" type="file" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="product_id" value="{{ $product->id }}" type="text" class="form-control">
                                <button type="submit" class="btn btn-primary ">Add</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            @foreach ($product->images as $img)
                <div class="col-4 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="  w-100 " height="350px;" src="{{ asset('storage/product/' . $img['image']) }}"
                                alt="">
                        </div>
                        {{-- <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{ $img->product->name }}</h6>
                            <div class="d-flex justify-content-center">
                                <h6>$123.00</h6>
                                <h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                        </div> --}}
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            {{-- <a href="" class="btn btn-sm text-dark p-0"><i
                                    class="fas fa-eye text-primary mr-1"></i>View Detail</a> --}}
                            {{-- <a href="{{ route('admin.product.show', ['id' => $product->id]) }}">
                                <button class="btn btn-primary"><i class="bi-pencil"></i></button>
                            </a> --}}
                            {{-- <a href="" class="btn btn-sm text-dark p-0"><i
                                    class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a> --}}
                            <form action="{{ route('admin.product.image.delete', $img->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">
                                    <i class="bi-trash"></i>
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price</th>
                        <th scope="col">Size</th>
                        <th scope="col">Image </th>
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
                            <td><img src="{{ asset('storage/product/' . $product['image']) }}" alt=""
                                    width="50px;" height="50px;" class="img-profile rounded-circle"></td>

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
        </div> --}}
    </div>

    <hr>
@endsection
