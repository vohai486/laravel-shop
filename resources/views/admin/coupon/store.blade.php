@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Mã giảm giá</h1>
        </div>
        @php
            $route = '';
            $textBtn = '';
            $title = '';
            if ($type === 'create') {
                $route = route('admin.coupon.store');
                $title = 'Tạo mã';
            }
            if ($type === 'edit' && isset($coupon)) {
                $route = route('admin.coupon.update', ['coupon' => $coupon->id]);
                $title = 'Cập nhập mã';
            }

        @endphp
        <div class="card card-primary">
            <div class="card-header">
                <h4>Tạo mÃ</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.coupon.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Tên mã giảm giá</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ old('name', $coupon->name ?? '') }}">
                        @error('name')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Code</label>
                        <input type="text" name="code" class="form-control"
                            value="{{ old('code', $coupon->code ?? '') }}">
                        @error('code')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Số lượng</label>
                        <input type="text" name="qty" class="form-control"
                            value="{{ old('qty', $coupon->qty ?? '') }}">
                        @error('qty')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Tiền tối thiểu để sử dụng</label>
                        <input type="text" name="min_purchase_amount" class="form-control"
                            value="{{ old('min_purchase_amount', $coupon->min_purchase_amount ?? '') }}">
                        @error('min_purchase_amount')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Ngày hết hạn</label>
                        <input type="date" name="expire_date" class="form-control"
                            value="{{ old('date', $coupon->expire_date ?? '') }}">
                        @error('expire_date')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Loại giảm</label>
                        <select name="discount_type" class="form-control" id="">
                            <option @selected(isset($coupon) && $coupon->discount_type === 'percent') value="percent">Phần trăm</option>
                            <option @selected(isset($coupon) && $coupon->discount_type === 'amount') value="amount">Tiền giảm</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Số tiền giảm</label>
                        <input type="text" name="discount" class="form-control"
                            value="{{ old('discount', $coupon->discount ?? '') }}">
                        @error('discount')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Trạng thái</label>
                        <select name="status" class="form-control" id="">
                            <option @selected(isset($coupon) && $coupon->status == 1) value="1">Active</option>
                            <option @selected(isset($coupon) && $coupon->status == 0) value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </section>
@endsection
