<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
            crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link href="{{ asset('/css/admin.css') }}" rel="stylesheet" />
        <title>@yield('title', 'Admin Panel')</title>
    </head>

    <body>
        <div class="row g-0">
            <!-- sidebar -->
            <div class="px-3  col-3 fixed text-white bg-dark">
                <a href="{{ route('admin.category.index') }}" class="text-white text-decoration-none">
                    <span class="fs-4">Admin Panel</span>
                </a>
                <hr>
                <ul class="nav flex-column">
                    <li><a href="{{ route('admin.category.index') }}" class="nav-link text-white"> Category</a></li>
                    <li><a href="{{ route('admin.product.index', [($type = 'Men')]) }}"
                            class="nav-link text-white">Product</a></li>
                    <li><a href="{{ route('admin.orders') }}" class="nav-link text-white"> Order</a></li>
                    <li><a href="{{ route('admin.users') }}" class="nav-link text-white"> Users</a></li>
                    <li>
                        <a href="{{ route('home') }}" class="mt-2 btn bg-primary text-white">Go back to the home
                            page</a>
                    </li>
                </ul>
            </div>
            <!-- sidebar -->
            <div class="col content-grey">
                <nav class="p-3 shadow text-end">
                    <span class="profile-font">Admin</span>
                </nav>
                <div class="g-0 m-5">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- footer -->
        {{-- <div class="copyright py-4 text-center text-white">
    <div class="container">
        <small>
            Copyright - <a class="text-reset fw-bold text-decoration-none" target="_blank"
            href="{{ route('home') }}">
            Learn English
            </a>
        </small>
    </div>
</div> --}}
        <!-- footer -->
        {{-- </body>
</html> --}}
