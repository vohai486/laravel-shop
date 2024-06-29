@extends('frontend.layouts.master')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/assets/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ $product->category->name }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('home') }}">Home</a>
                            <a href="./index.html">{{ $product->category->name }}</a>
                            <span>{{ $product->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" src="{{ asset($product->thumb_image) }}"
                                alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $product->name }}</h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            @if ($product->reviews->count() > 0)
                                <span>({{ $product->reviews->count() }} reviews)</span>
                            @endif
                        </div>
                        <div class="product__details__price " id="v_total_price">{{ $product->price }}</div>
                        {{-- <p>{{ $product->short_description }}</p> --}}

                        @if ($product->options()->count() > 0 && $product->variants()->count() > 0)
                            <div class="product_variants">

                                {{-- ->sortBy('price') --}}
                                @foreach ($product->options->sortBy('position') as $option)
                                    <h4>{{ $option->name }}</h4>
                                    @foreach ($product->variants->sortBy('position') as $variant)
                                        <div class="v_form-check">
                                            <input class="v_check-input" type="radio"
                                                name="product_variant-{{ $option->position }}"
                                                id="variant-{{ $variant->id }}" data-price="{{ $variant->price }}"
                                                value="{{ $variant->id }}">
                                            <label class="v_check-label" for="size-{{ $variant->id }}">
                                                {{ $variant->title }}
                                            </label>
                                        </div>
                                    @endforeach
                                @endforeach

                            </div>
                        @endif

                        <div class="product__details__quantity">
                            <div class="quantity">
                                <form id="v_add_to_cart_form" class="pro-qty">
                                    <input type="text" name="quantity" id="v_quantity" value="1">
                                </form>
                            </div>
                        </div>
                        <a href="javascript:;" class="primary-btn" id="v_btn_add_to_cart">ADD TO CARD</a>
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <ul>
                            <li><b>Availability</b> <span>In Stock</span></li>
                            <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                            <li><b>Weight</b> <span>0.5 kg</span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Reviews <span>({{ $product->reviews->count() }})</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    {!! $product->long_description !!}
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Reviews</h6>
                                    <form method="POST"
                                        action="{{ route('products.reviews.store', ['product' => $product]) }}">
                                        @csrf
                                        <div class="form-group">
                                            <div class=" d-flex">
                                                <div class=" text-center">
                                                    <div class="rating"> <input type="radio" name="rating"
                                                            value="5" id="5"><label for="5">☆</label>
                                                        <input type="radio" name="rating" value="4"
                                                            id="4"><label for="4">☆</label> <input
                                                            type="radio" name="rating" value="3"
                                                            id="3"><label for="3">☆</label> <input
                                                            type="radio" name="rating" value="2"
                                                            id="2"><label for="2">☆</label> <input
                                                            type="radio" name="rating" value="1"
                                                            id="1"><label for="1">☆</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <textarea placeholder="Viết bình luận" name="content" id=""
                                                class="form-control @error('content') is-invalid @enderror" cols="5" rows="3">{{ old('content') }}</textarea>
                                            @error('content')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group justify-content-end d-flex">
                                            <button type="submit" class="btn btn-primary btn-lg" tabindex="4">
                                                Đăng
                                            </button>
                                        </div>
                                    </form>

                                    @foreach ($product->reviews as $review)
                                        <div class="mt-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex" style="gap:20px">
                                                        <div class="flex-shrink-0" style="flex-shrink:0">
                                                            <img style="width:40px" src="{{ $review->user->avatar }}"
                                                                class="img img-rounded img-fluid" />
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex justify-content-between">
                                                                <p>
                                                                    <a class="float-left"
                                                                        href="javscript:;"><strong>{{ $review->user->name }}</strong></a>
                                                                </p>
                                                                <div class="d-flex ">
                                                                    @for ($i = 0; $i < $review->rating; $i++)
                                                                        <span class="float-right"><i
                                                                                class="text-warning fa fa-star"></i></span>
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                            <p>{{ $review->content }}</p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($relatedProducts as $prod)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{ asset($prod->thumb_image) }}">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">{{ $prod->name }}</a></h6>
                                <h5>{{ $prod->price }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.qtybtn').on('click', function() {
                const $button = $(this);
                const oldValue = $button.parent().find("input").val();
                let newVal = 0;
                if ($button.hasClass('v_inc')) {
                    newVal = parseFloat(oldValue) + 1;
                } else {
                    if (oldValue <= 1) {
                        return;
                    } else {
                        newVal = parseFloat(oldValue) - 1;
                    }
                }
                if (newVal > 0) {
                    updatePrice(newVal)
                }
            })

            $('input[name*="product_variant"]').on('change', function(e) {
                const price = $(this).attr('data-price')
                updatePrice()
            })

            $('#v_add_to_cart_form').on('submit', function(e) {
                e.preventDefault()
                const variant_id = $('input[name*="product_variant"]:checked').val();
                let formData = $(this).serialize();
                const qty = $('#v_quantity').val();
                $.ajax({
                    method: 'POST',
                    url: '{{ route('add-to-cart') }}',
                    data: {
                        _token: "{{ csrf_token() }}",
                        qty,
                        product_id: "{{ $product->id }}",
                        variant_id
                    },
                    beforeSend: function() {
                        $('#v_btn_add_to_cart').attr('disabled', true);
                        $('#v_btn_add_to_cart').html(
                            '<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Loading...'
                        )
                    },
                    success: function(response) {
                        getCountCartItem()
                    },
                    error: function(xhr, status, error) {},
                    complete: function() {
                        $('#v_btn_add_to_cart').html('Add to Cart');
                        $('#v_btn_add_to_cart').attr('disabled', false);
                    }
                })

            })

            $('#v_btn_add_to_cart').on('click', function(e) {
                $('#v_add_to_cart_form').trigger('submit');
            })

            function updatePrice(quantity) {
                let price = '{{ $product->price }}'
                let newQty = 1
                const dataPrice = $('input[name*="product_variant"]:checked').attr('data-price')
                if (dataPrice) {
                    price = +dataPrice
                }
                newQty = quantity ?? $('#v_quantity').val()
                $('#v_total_price').text(newQty * price)
            }


        })
    </script>
@endpush
