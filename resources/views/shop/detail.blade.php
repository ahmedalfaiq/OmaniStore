@extends('layouts.app')
@section('content')
    <!-- Page Header Start -->
    {{-- <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shop Detail</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shop Detail</p>
            </div>
        </div>
    </div> --}}
    <!-- Page Header End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border ">
                        <p style="display: none"> {{ $img1 = $product->images[0] }}
                        </p>
                        @foreach ($product->images as $img)
                            <div class="carousel-item   {{ $img->id == $img1->id ? 'active' : '' }}">
                                <img class="  d-block mx-auto" height="400px;" width="300px;"
                                    src="{{ asset('storage/product/' . $img['image']) }}" alt="Image">
                            </div>
                        @endforeach

                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold">{{ $product->name }}</h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $product->rate)
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </div>
                    <small class="pt-1">({{ count($product->rates) }} Reviews)</small>
                </div>
                <h3 class="font-weight-semi-bold mb-4">${{ $product->price }}</h3>
                <p class="mb-4">
                    {{ $product->description }}
                </p>
                <form method="POST" action="{{ route('cart.add', ['id' => $product->id]) }}">
                    @csrf
                    <div class="d-flex mb-3">
                        <p class="text-dark font-weight-medium mb-0 mr-3">Sizes:</p>
                        @foreach (explode(',', $product->size) as $item)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="{{ $item }}" checked
                                    name="size" value="{{ $item }}">
                                <label class="custom-control-label" for="{{ $item }}">{{ $item }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary text-center" value="1"
                                name="quantity">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary px-3" type="submit"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                </form>


                <div class="d-flex pt-2">
                    <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class=" " id="tab-pane-3">
                <div class="row">
                    <div class="col-md-6">
                        @if (count($product->rates) < 1)
                            <h4 class="mb-4"> No review for {{ $product->name }}</h4>
                        @else
                            <h4 class="mb-4"> review for {{ $product->name }}</h4>
                            @foreach ($product->rates as $rate)
                                <div class="media mb-4">
                                    <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                    <div class="media-body">
                                        <h6>{{ $rate->user->name }}<small> - <i>{{ $rate->created_at }}</i></small></h6>
                                        <div class="text-primary mb-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $rate->rating)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <p>{{ $rate->comment }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                    <div class="col-md-6">
                        <h4 class="mb-4">Leave Your Review</h4>
                        <form class="py-2 px-4" action="{{ route('product.rating') }}" style="box-shadow: 0 0 10px 0 #ddd;"
                            method="POST">
                            @csrf
                            {{-- <p class="font-weight-bold ">Review</p> --}}
                            <div class="form-group row">
                                <div class="d-flex my-1">
                                    <p class="mb-0 mr-2">Your Rating * :</p>

                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <div class="col">
                                        <div class="rate">
                                            <input type="radio" id="star5" class="rate" name="rating"
                                                value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" class="rate" name="rating"
                                                value="4" {{-- onselect="this.form.submit()" --}} />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" class="rate" name="rating"
                                                value="3" {{-- onselect="this.form.submit()" --}} />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" class="rate" name="rating"
                                                value="2" {{-- onselect="this.form.submit()" --}}>
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" class="rate" name="rating"
                                                value="1" {{-- onselect="this.form.submit()" --}} />
                                            <label for="star1" title="text">1 star</label>
                                        </div>
                                    </div>
                                </div>
                                {{-- </div> --}}
                                {{-- <div class="form-group row mt-1"> --}}
                                <div class="form-group">
                                    <label for="comment">Your Review *</label>
                                    <textarea id="comment" cols="30" rows="5" class="form-control" name="comment" placeholder="Comment"></textarea>
                                </div>

                                {{-- </div> --}}
                                <div class=" text-right">
                                    <input type="submit" value="Rate" class="btn btn-sm py-2 px-3 btn-outline-info">
                                </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Shop Detail End -->
@endsection
