 @extends('frontend.layouts.master')

 @section('content')
     <!-- Hero Section Begin -->
     @include('frontend.home.components.hero')
     <!-- Hero Section End -->

     <!-- Categories Section Begin -->
     @include('frontend.home.components.categories')
     <!-- Categories Section End -->

     <!-- Featured Section Begin -->
     {{-- class="featured spad  --}}
     @include('frontend.home.components.featured-product')
     <!-- Featured Section End -->

     <!-- Banner Begin -->
     @include('frontend.home.components.banner')
     <!-- Banner End -->

     <!-- Latest Product Section Begin -->
     @include('frontend.home.components.latest-product')
     <!-- Latest Product Section End -->
 @endsection
