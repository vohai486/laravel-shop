@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Đơn Hàng</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Chi tiết đơn hàng</div>
            </div>
        </div>

        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Deliver To:</strong><br>
                                        <strong>Name:</strong> {!! @$order->fullname !!}
                                        <br>
                                        <strong>Phone:</strong> {!! @$order->phone !!}
                                        <br>
                                        <strong>Address:</strong> {!! @$order->address !!}
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Order Date:</strong><br>
                                        {{ date('F d, Y / H:i', strtotime($order->created_at)) }}
                                        <br><br>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Payment Method:</strong><br>
                                        {{ $order->payment_method }}<br>
                                        <strong>Payment Status: </strong>
                                        @if (strtoupper($order->payment_status) == 'COMPLETED')
                                            <span class="badge badge-success">COMPLETED</span>
                                        @elseif(strtoupper($order->payment_status) == 'PENDING')
                                            <span class="badge badge-warning">PENDING</span>
                                        @else
                                            <span class="badge badge-danger">{{ $order->payment_status }}</span>
                                        @endif
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Order Status:</strong><br>
                                        @if ($order->order_status === 'delivered')
                                            <span class="badge badge-success">Delivered</span>';
                                        @elseif($order->order_status === 'declined')
                                            <span class="badge badge-danger">Declined</span>';
                                        @else
                                            <span class="badge badge-warning">{{ $order->order_status }}</span>
                                        @endif
                                        <br><br>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="section-title">Order Summary</div>
                            <p class="section-lead">All items here cannot be deleted.</p>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <th data-width="40">#</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Totals</th>
                                    </tr>
                                    @foreach ($order->orderItems as $orderItem)
                                        @php
                                            $totalPrice += $orderItem->qty * $orderItem->product->price;
                                        @endphp
                                        <tr>
                                            <td>{{ $orderItem->id }}</td>
                                            <td>{{ $orderItem->product->name }}</td>
                                            <td>{{ $orderItem->product->price }}
                                            </td>
                                            <td>{{ $orderItem->qty }}</td>
                                            <td>{{ $orderItem->qty * $orderItem->product->price }}</td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-8">
                                    <div class="col-md-4 d-print-none">
                                        <form {{-- action="{{ route('admin.orders.status-update', $order->id) }}" --}} method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="">Payment Status</label>
                                                <select class="form-control" name="payment_status" id="">
                                                    <option @selected($order->payment_status === 'pending') value="pending">Pending</option>
                                                    <option @selected($order->payment_status === 'completed') value="completed">Completed
                                                    </option>
                                                </select>

                                            </div>

                                            <div class="form-group">
                                                <label for="">Order Status</label>
                                                <select class="form-control" name="order_status" id="">
                                                    @if ($order->status == 1)
                                                        <td style="vertical-align:middle">
                                                            <div class="badge badge-warning">Chờ xác nhận</div>
                                                        </td>
                                                    @elseif($order->status == 2)
                                                        <td style="vertical-align:middle">
                                                            <div class="badge badge-success">Hoàn thành</div>
                                                        </td>
                                                    @else
                                                        <td style="vertical-align:middle">
                                                            <div kkk="{{ $order->status }}" class="badge badge-danger">Hủy
                                                            </div>
                                                        </td>
                                                    @endif
                                                    <option @selected($order->status == 1) value="1">Chờ xác nhận
                                                    </option>
                                                    <option @selected($order->status == 2) value="2">Hoàn thành
                                                    </option>
                                                    <option @selected($order->status == '3') value="3">Hủy
                                                    </option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-info">Update</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Shipping</div>
                                        <div class="invoice-detail-value">{{ $order->total_money }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-md-right">
                    <div class="float-lg-left mb-lg-0 mb-3">

                    </div>
                    <button class="btn btn-warning btn-icon icon-left" id="print_btn"><i class="fas fa-print"></i>
                        Print</button>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
