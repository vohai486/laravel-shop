@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Sản phẩm</h1>
        </div>
        @php
            $route = '';
            $textBtn = '';
            $title = '';
            if ($type === 'create') {
                $route = route('admin.product.store');
                $title = 'Tạo sản phẩm';
            }
            if ($type === 'edit' && isset($product)) {
                $route = route('admin.product.update', ['product' => $product->id]);
                $title = 'Cập nhập sản phẩm';
            }

        @endphp
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
                        <label>Image</label>
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Choose File</label>
                            <input type="file" name="image" id="image-upload" />
                        </div>
                        @error('image')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ old('name', $product->name ?? '') }}">
                        @error('name')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" class="form-control select2" id="">
                            <option value="">select</option>
                            @foreach ($categories as $category)
                                <option @selected(isset($product) && $product->category_id === $category->id) value="{{ $category->id }}">
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control"
                            value="{{ old('price', $product->price ?? '') }}">
                        @error('price')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Short Description</label>
                        <textarea name="short_description" class="form-control" id="">{{ old('short_description', $product->short_description ?? '') }}</textarea>
                        @error('short_description')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Long Description</label>
                        <textarea name="long_description" class="form-control summernote" id="">{{ old('long_description', $product->long_description ?? '') }}</textarea>
                        @error('long_description')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Sku</label>
                        <input type="text" name="sku" class="form-control"
                            value="{{ old('sku', $product->sku ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label>Seo Title</label>
                        <input type="text" name="seo_title" class="form-control"
                            value="{{ old('seo_title', $product->seo_title ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label>Seo Description</label>
                        <textarea name="seo_description" class="form-control" id="">{{ old('seo_description', $product->seo_description ?? '') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Show at Home</label>
                        <select name="show_at_home" class="form-control" id="">
                            <option @selected(isset($product) && $product->show_at_home === 1) value="1">Yes
                            </option>
                            <option @selected(isset($product) && $product->show_at_home === 0) value="0">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" id="">
                            <option @selected(isset($product) && $product->status === 1) value="1">Active
                            </option>
                            <option @selected(isset($product) && $product->status === 0) value="0">Inactive
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ $title }}</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".summernote").summernote({
                dialogsInBody: true,
                minHeight: 150,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough']],
                    ['para', ['paragraph']]
                ]
            });
            if ('{{ $type }}' === 'edit' && '{{ isset($product) }}') {
                $('#image-preview').css('background-image',
                    'url( {{ $product ? asset($product->thumb_image) : '' }})');
                $('#image-preview').css('background-size', 'contain');
            }
        })
    </script>
@endpush
