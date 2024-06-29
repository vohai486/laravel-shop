@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Danh mục</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Danh sách danh mục</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-md">
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>Tên</th>
                                <th>Trạng thái</th>
                                <th>Hiển thị ở trang chủ</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>

                                    @if ($category->status)
                                        <td>
                                            <div class="badge badge-success">Active</div>
                                        </td>
                                    @else
                                        <td>
                                            <div class="badge badge-danger">Inactive</div>
                                        </td>
                                    @endif

                                    @if ($category->show_at_home)
                                        <td>
                                            <div class="badge badge-success">Yes</div>
                                        </td>
                                    @else
                                        <td>
                                            <div class="badge badge-danger">No</div>
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
                                                <a url={{ route('admin.category.destroy', ['category' => $category->id]) }}
                                                    href="javascript:;" class="btn dropdown-item delete-item">Delete</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.category.edit', ['category' => $category->id]) }}">Edit</a>
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

@push('scripts')
    <script>
        $(document).ready(function() {

            $('body').on('click', '.delete-item', function(e) {
                e.preventDefault()
            })
        })
    </script>
@endpush
