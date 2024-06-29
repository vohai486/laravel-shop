@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Sản phẩm</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Danh sách sản phẩm</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-md">
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Giá tiền</th>
                                <th>Hiển thị ở trang chủ</th>
                                <th>Trạng thái</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($products as $prod)
                                <tr>
                                    <td style="vertical-align:middle">{{ $prod->id }}</td>
                                    <td style="vertical-align:middle">
                                        <img width="50" style="object-fit: cover;" height="50"
                                            src="{{ asset($prod->thumb_image) }}" alt="">
                                    </td>
                                    <td style="vertical-align:middle">
                                        {{ $prod->name }}
                                    </td>
                                    <td style="vertical-align:middle">
                                        {{ $prod->category->name }}
                                    </td>
                                    <td style="vertical-align:middle">
                                        {{ $prod->price }}
                                    </td>
                                    @if ($prod->show_at_home)
                                        <td style="vertical-align:middle">
                                            <div class="badge badge-success">Yes</div>
                                        </td>
                                    @else
                                        <td style="vertical-align:middle">
                                            <div class="badge badge-danger">No</div>
                                        </td>
                                    @endif
                                    @if ($prod->status)
                                        <td style="vertical-align:middle">
                                            <div class="badge badge-success">Active</div>
                                        </td>
                                    @else
                                        <td style="vertical-align:middle">
                                            <div class="badge badge-danger">Inactive</div>
                                        </td>
                                    @endif
                                    <td style="vertical-align:middle">
                                        <div class="dropdown d-inline">
                                            <button class="btn btn-dark dropdown-toggle" type="button"
                                                id="dropdownMenuButton4" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="true">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" x-placement="bottom-start"
                                                style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.product-variant.show-index', ['product' => $prod->id]) }}">Options
                                                    & Variants</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.product.edit', ['product' => $prod->id]) }}">Edit</a>
                                                <a url={{ route('admin.product.destroy', ['product' => $prod->id]) }}
                                                    href="javascript:;" class="btn dropdown-item delete-item">Delete</a>
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
