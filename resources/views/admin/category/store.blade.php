@extends('admin.layouts.master')

@section('content')
    @php
        $route = '';
        $textBtn = '';
        $title = '';
        if ($type === 'create') {
            $route = route('admin.category.store');
            $title = 'Tạo danh mục';
        }
        if ($type === 'edit' && isset($category)) {
            $route = route('admin.category.update', ['category' => $category->id]);
            $title = 'Cập nhập danh mục';
        }

    @endphp
    <section class="section">
        <div class="section-header">
            <h1>Danh mục</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ $title }}</h4>
            </div>
            <div class="card-body">

                <form action="@php echo $route @endphp" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($type === 'edit')
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}"
                            class="form-control">
                        @error('name')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <input type="text" hidden name="id" value="{{ $category->id ?? '' }}">

                    <div class="form-group">
                        <label>Show at Home</label>
                        <select name="show_at_home" class="form-control" id="">
                            <option {{ isset($category) && $category->show_at_home === 1 ? 'selected' : '' }}
                                value="1">
                                Yes
                            </option>
                            <option {{ isset($category) && $category->show_at_home === 0 ? 'selected' : '' }}
                                value="0">
                                No
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" id="">
                            <option {{ isset($category) && $category->show_at_home === 1 ? 'selected' : '' }}
                                value="1">
                                Active
                            </option>
                            <option {{ isset($category) && $category->show_at_home === 0 ? 'selected' : '' }}
                                value="0">
                                Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ $title }}</button>
                </form>
            </div>
        </div>
    </section>
@endsection
