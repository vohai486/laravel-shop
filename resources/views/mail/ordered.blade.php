<div class="container">
    <h2 class="text-center">Đơn hàng đặt</h2>
    <p>Ngày đặt: <b>{{ date('d-m-Y', strtotime($order->created_at)) }}</b></p>
    <div class="border-bottom border-dark">
        <div class="row">
            <div class="col-6">Sản phẩm</div>
            <div class="col-3">Số lượng</div>
            <div class="col-3">Giá tiền</div>
        </div>
    </div>
    <div class="border-bottom border-dark">
        @foreach ($order->orderItems as $item)
            <div class="row">
                <div class="col-6">{{ $item->product->title }}</div>
                <div class="col-3">{{ $item->qty }}</div>
                <div class="col-3">{{ $item->qty * $item->price }}</div>
            </div>
        @endforeach

    </div>
    <div class="border-bottom border-top border-dark">
        <div class="row">
            <div class="col-9 text-right">Tổng cộng</div>
            <div class="col-3">{{ $order->total_money }}</div>
        </div>
    </div>
</div>
