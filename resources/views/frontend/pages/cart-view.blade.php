@extends('frontend.layouts.master')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/assets/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="list-cart">


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#" id="apply_coupon_form">
                                <input name="coupon_code" type="text" placeholder="Enter your coupon code">
                                <button type="submit" id="btn-apply-coupon" class="site-btn ">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Discount <span id="v_discount_price"></span></li>
                            <li>SubTotal <span id="v_sub_total_price"></span></li>
                            <li>Total <span id="v_cart_total_price"></span></li>
                        </ul>
                        <a href="{{ route('checkout.index') }}" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection

@push('scripts')
    <script>
        function getListCart() {
            $.ajax({
                method: 'GET',
                url: '{{ route('get-cart-products') }}',
                success: function(response) {
                    $('#list-cart').html(response)
                    const subTotalPrice = $('#sub_total_price').val()

                    $('#v_discount_price').text(0)
                    $('#v_sub_total_price').text(subTotalPrice)
                    $('#v_cart_total_price').text(subTotalPrice)

                },
                error: function(error) {
                    $('#list-cart').html('<div>Chưa có sản phẩm trong giỏ hàng</div>')
                }
            })
        }
        $(document).ready(function() {
            getListCart()

            $('#apply_coupon_form').on('submit', function(e) {
                e.preventDefault();
                const code = $(this).find('input').val();
                if (code.trim().length === 0) return;

                const subtotal = $('#v_sub_total_price').text();

                $.ajax({
                    method: 'POST',
                    url: '{{ route('apply-coupon') }}',
                    data: {
                        _token: "{{ csrf_token() }}",
                        code: code,
                        subtotal: subtotal
                    },
                    beforeSend: function() {},
                    success: function(response) {
                        console.log(response)
                        $('#v_discount_price').text(response.discount)
                        $('#v_sub_total_price').text(subtotal)
                        $('#v_cart_total_price').text(response.finalTotal)
                    },
                    error: function(xhr, status, error) {},
                    complete: function() {}
                })
            })
        })
    </script>
@endpush
