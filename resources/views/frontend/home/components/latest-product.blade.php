<section class="latest-product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Latest Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        @for ($i = 1; $i <= ceil($latestProducts->count() / 3); $i++)
                            <div class="latest-prdouct__slider__item">
                                @for ($y = 0 + ($i - 1) * 3; $y < $i * 3; $y++)
                                    @if ($y < $latestProducts->count())
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{ asset($latestProducts[$y]->thumb_image) }}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{ $latestProducts[$y]->name }}</h6>
                                                <span>{{ $latestProducts[$y]->price }}</span>
                                            </div>
                                        </a>
                                    @endif
                                @endfor
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Top Rated Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        @php
                            // $ratedProducts = \App\Models\Product::withAvg('reviews', 'rating')
                            //     ->orderByDesc('reviews_avg_rating')
                            //     ->limit(6)
                            //     ->get();
                        @endphp
                        @for ($i = 1; $i <= ceil($ratedProducts->count() / 3); $i++)
                            <div class="latest-prdouct__slider__item">
                                @for ($y = 0 + ($i - 1) * 3; $y < $i * 3; $y++)
                                    @if ($y < $ratedProducts->count())
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{ asset($ratedProducts[$y]->thumb_image) }}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{ $ratedProducts[$y]->name }}</h6>
                                                <span>{{ $ratedProducts[$y]->price }}</span>
                                            </div>
                                        </a>
                                    @endif
                                @endfor
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Review Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        @php
                            // $ratedReviewsProducts = \App\Models\Product::withCount('reviews')
                            //     ->orderByDesc('reviews_count')
                            //     ->limit(6)
                            //     ->get();
                        @endphp
                        @for ($i = 1; $i <= ceil($ratedReviewsProducts->count() / 3); $i++)
                            <div class="latest-prdouct__slider__item">
                                @for ($y = 0 + ($i - 1) * 3; $y < $i * 3; $y++)
                                    @if ($y < $ratedReviewsProducts->count())
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{ asset($ratedReviewsProducts[$y]->thumb_image) }}"
                                                    alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{ $ratedReviewsProducts[$y]->name }}</h6>
                                                <span>{{ $ratedReviewsProducts[$y]->price }}</span>
                                            </div>
                                        </a>
                                    @endif
                                @endfor
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
