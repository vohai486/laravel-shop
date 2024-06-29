@extends('frontend.layouts.master')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/assets/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('home') }}">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your
                        code
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="{{ route('create-order') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="checkout__input">
                                <p>Name<span>*</span></p>
                                <input name="fullname" value="{{ old('fullname') }}" type="text">
                                @error('fullname')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input name="address" value="{{ old('address') }}" type="text">
                                @error('address')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input name="phone" value="{{ old('phone') }}" type="text">
                                        @error('phone')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input name="email" value="{{ old('email', auth()->user()->email) }}"
                                            type="text">
                                        @error('email')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input name="note" value="{{ old('note') }}" type="text">
                                @error('note')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    @foreach ($cartItems as $item)
                                        <li>{{ $item->product->name }}
                                            <span>{{ $item->productVariant->price * $item->qty }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>{{ $totalPrice }}</span></div>
                                <div class="checkout__order__total">Discount
                                    <span style="color:#333">{{ $discount }}</span>
                                </div>
                                <div class="checkout__order__total">Total <span>{{ $totalPrice - $discount }}</span></div>
                                <input type="number" value="{{ $totalPrice - $discount }}" hidden id="">
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
