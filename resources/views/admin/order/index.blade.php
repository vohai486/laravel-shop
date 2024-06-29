@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Đơn hàng</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Danh sách Đơn hàng</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-md">
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>Tên người dùng</th>
                                <th>Số lượng sản phẩm</th>
                                <th>Trạng thái</th>
                                <th>Ngày đặt</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->orderItems->count() }}</td>
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
                                            <div kkk="{{ $order->status }}" class="badge badge-danger">Hủy</div>
                                        </td>
                                    @endif
                                    <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                                    <td>
                                        <div class="dropdown d-inline">
                                            <button class="btn btn-dark dropdown-toggle" type="button"
                                                id="dropdownMenuButton4" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="true">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" x-placement="bottom-start"
                                                style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a href="{{ route('admin.orders.show', ['id' => $order->id]) }}"
                                                    class="btn dropdown-item ">Show</a>
                                                <a class="dropdown-item delete-item" href="javascript:;"
                                                    url={{ route('admin.orders.destroy', ['id' => $order->id]) }}
                                                    href="{{ route('admin.orders.destroy', ['id' => $order->id]) }}">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
@endsection
