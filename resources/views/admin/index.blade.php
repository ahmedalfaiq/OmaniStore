@extends('layouts.admin')
@section('title', 'Home ')
@section('content')

    @if (isset($category))
        <div class="card mb-4">
            <div class="card-header">
                Update Category
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <ul class="alert alert-danger list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <form method="POST" action="{{ route('admin.category.update', [$category->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Name:</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                    <input name="name" value="{{ $category->name }}" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Image :</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                    <input name="image" type="file" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 row">
                            <label class="col-lg-3 col-md-6 col-sm-12 col-form-label">For :</label>
                            <div class="col-lg-9 col-md-6 col-sm-12">
                                <select name="type" id="type" class="form-select">
                                    <option @selected($category->type == 'Men') value="Men">Men</option>
                                    <option @selected($category->type == 'Women') value="Women">Women</option>
                                    <option @selected($category->type == 'Accessory') value="Accessory">Accessory</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    @else
        <div class="card mb-4">
            <div class="card-header">
                New Category
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <ul class="alert alert-danger list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <form method="POST" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
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
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Image :</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                    <input name="image" type="file" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 row">
                            <label class="col-lg-3 col-md-6 col-sm-12 col-form-label">For :</label>
                            <div class="col-lg-9 col-md-6 col-sm-12">
                                <select name="type" id="type" class="form-select">
                                    <option value="Men">Men</option>
                                    <option value="Women">Women</option>
                                    <option value="Accessory">Accessory</option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    @endif


    {{--  --}}
    <div class="card">
        <div class="card-header">
            <h3> Categories</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Image </th>
                        <th scope="col">For </th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td><img src="{{ asset('/storage/product/' . $category['image']) }}" alt=""
                                    width="100px;" height="100px;" class="img-profile rounded-circle"></td>
                            <td>{{ $category->type }}</td>

                            <td>

                                <a href="{{ route('admin.category.show', ['id' => $category->id]) }}">
                                    <button class="btn btn-primary">
                                        <i class="bi-pencil"></i>
                                    </button>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('admin.category.delete', $category->id) }}" method="POST">
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
