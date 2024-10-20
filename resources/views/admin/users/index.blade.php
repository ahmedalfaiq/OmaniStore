@extends('layouts.admin')
@section('title', 'Admin Users')
@section('content')
@if (isset($user))
    <div class="card mb-4">
        <div class="card-header">{{ __('Update User') }}</div>
        <div class="card-body">
            <form action="{{ route('admin.user.update',$user->id) }}" method="POST" >
                @csrf
                {{-- @method('PUT') --}}
                <div class="row ">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="row mb-3">
                    <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                    <div class="col-md-6">
                        <select name="role" id="role" class="form-select">
                            <option @selected( 'client' == $user->role) value="client">Client</option>
                            <option @selected( 'admin' == $user->role) value="admin">Admin</option>
                        </select>
                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="balance" class="col-md-4 col-form-label text-md-end">{{ __('Balance') }}</label>

                    <div class="col-md-6">
                        <input id="balance" type="number" class="form-control @error('balance') is-invalid @enderror" name="balance" value="{{$user->balance}}" >

                        @error('balance')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary bg-primary text-white">
                            {{ __('Update') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endif
    <div class="card mb-4">
        <div class="card-header">
            USERS
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Balance</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user  )
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->balance }}</td>
                        <td>
                            <a href="{{ route('admin.user.edit', ['id'=>$user->id]) }}">
                                <button class="btn btn-primary">
                                    <i class="bi-pencil"></i>
                                </button>
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('admin.user.delete', $user->id)}}" method="POST">
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
@endsection
