@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Mã giảm giá</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Danh sách mã</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-md">
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>Tên</th>
                                <th>Code</th>
                                <th>Số lượng</th>
                                <th>Tiền tối thiểu</th>
                                <th>Ngày hết hạn</th>
                                <th>Loại giảm</th>
                                <th>Số tiền giảm</th>
                                <th>Trạng thái</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($coupons as $coupon)
                                <tr>
                                    <td>{{ $coupon->id }}</td>
                                    <td>{{ $coupon->name }}</td>
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ $coupon->qty }}</td>
                                    <td>{{ $coupon->min_purchase_amount }}</td>
                                    <td>{{ $coupon->expire_date }}</td>
                                    <td>{{ $coupon->discount_type }}</td>
                                    <td>
                                        @php
                                            if ($coupon->discount_type === 'percent') {
                                                echo $coupon->discount . '%';
                                            } else {
                                                echo $coupon->discount;
                                            }
                                        @endphp
                                    </td>
                                    @if ($coupon->status)
                                        <td style="vertical-align:middle">
                                            <div class="badge badge-success">Active</div>
                                        </td>
                                    @else
                                        <td style="vertical-align:middle">
                                            <div class="badge badge-danger">Inactive</div>
                                        </td>
                                    @endif

                                    <td>
                                        <div class="dropdown d-inline">
                                            <button class="btn btn-dark dropdown-toggle" type="button"
                                                id="dropdownMenuButton4" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="true">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" x-placement="bottom-start"
                                                style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a url={{ route('admin.coupon.destroy', ['coupon' => $coupon->id]) }}
                                                    href="javascript:;" class="btn dropdown-item delete-item">Delete</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.coupon.edit', ['coupon' => $coupon->id]) }}">Edit</a>
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
