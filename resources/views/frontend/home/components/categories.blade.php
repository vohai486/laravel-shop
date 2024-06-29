<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                @foreach ($categories as $cate)
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ $cate->thumb_image }}">
                            <h5><a href="#">{{ $cate->name }}</a></h5>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
