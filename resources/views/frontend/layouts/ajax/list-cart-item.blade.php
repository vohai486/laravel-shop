@foreach ($cartItems as $item)
    <tr>
        <td class="shoping__cart__item">
            <img width="80" height="80" src="{{ asset($item->product->thumb_image) }}" alt="">
            <h5>{{ $item->product->name }} - {{ $item->productVariant->title }} </h5>
        </td>
        <td class="shoping__cart__price">
            {{ $item->productVariant->price }}
        </td>
        <td class="shoping__cart__quantity">
            <div class="quantity">
                <div class="pro-qty">
                    <span class="dec qtybtn v_dec">-</span>
                    <input type="text" data-id="{{ $item->id }}" value="{{ $item->qty }}">
                    <span class="inc qtybtn v_inc">+</span>
                </div>
            </div>
        </td>
        <td class="shoping__cart__total">
            {{ $item->qty * $item->productVariant->price }}
        </td>
        <td class="shoping__cart__item__close">
            <span class="icon_close btn_close" data-id="{{ $item->id }}"></span>
        </td>
    </tr>
@endforeach

<input type="hidden" value="{{ $subTotalPrice }}" id="sub_total_price">

<script>
    $(document).ready(function() {
        $('.qtybtn').on('click', function() {
            const $button = $(this);
            const oldValue = $button.parent().find("input").val();
            const cartItemId = $button.parent().find("input").attr('data-id');
            // getListCart()
            let newVal = 0
            if ($button.hasClass('v_inc')) {
                newVal = parseFloat(oldValue) + 1;
            } else {
                if (oldValue === 1) {
                    newVal = 0;
                } else {
                    newVal = parseFloat(oldValue) - 1;
                }
            }

            $.ajax({
                method: 'POST',
                url: '{{ route('cart.quantity-update') }}',
                data: {
                    _token: "{{ csrf_token() }}",
                    qty: newVal,
                    cart_item_id: cartItemId
                },
                beforeSend: function() {},
                success: function(response) {
                    getListCart()
                    getCountCartItem()
                },
                error: function(xhr, status, error) {},
                complete: function() {}
            })
        })

        $('.btn_close').on('click', function() {
            const cartItemId = $(this).attr('data-id');

            $.ajax({
                method: 'POST',
                url: '{{ route('cart-product-remove') }}',
                data: {
                    _token: "{{ csrf_token() }}",
                    cart_item_id: cartItemId
                },
                beforeSend: function() {},
                success: function(response) {
                    getListCart()
                    getCountCartItem()

                },
                error: function(xhr, status, error) {},
                complete: function() {}
            })
        })
    })
</script>
