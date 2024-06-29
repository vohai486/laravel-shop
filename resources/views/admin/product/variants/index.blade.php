@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Products Options & Variants ({{ $product->name }})</h1>
        </div>

        <div>
            <a href="{{ route('admin.product.index') }}" class="btn btn-primary my-3">Go Back</a>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Create Product Options</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.product-option.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Tên option</label>
                                        <input type="text" name="name" id="" class="form-control">
                                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label for="">Position</label>
                                        <input value="{{ $product->options->count() + 1 }}" type="number" name="position"
                                            id="" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card card-primary">

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tên Option</th>
                                    <th>Position</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product->options as $option)
                                    <tr>
                                        <td>{{ ++$loop->index }}</td>
                                        <td>{{ $option->name }}</td>
                                        <td>{{ $option->position }}</td>
                                        <td>
                                            <a href='{{ route('admin.product-option.destroy', $option->id) }}'
                                                class='btn btn-danger delete-item mx-2'><i class='fas fa-trash'></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                @if (count($product->options) === 0)
                                    <tr>
                                        <td colspan='4' class="text-center">No data found!</td>

                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Create Product Variants</h4>

                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.product-variant.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Title</label>
                                        <input type="text" name="title" id="" class="form-control">
                                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                                        @error('title')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Giá tiền</label>
                                        <input type="number" name="price" id="" class="form-control">
                                        @error('price')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Position</label>
                                        <select name="position" class="form-control select2" id="">
                                            <option value="">select</option>
                                            @foreach ($product->options as $option)
                                                {{-- @selected(isset($product) && $product->category_id === $category->id) --}}
                                                <option value="{{ $option->position }}">
                                                    {{ $option->position }}</option>
                                            @endforeach
                                        </select>
                                        @error('position')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Số lượng trong kho</label>
                                        <input type="number" name="inventory_quantity" id="" class="form-control">
                                        @error('inventory_quantity')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card card-primary">

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Position</th>
                                    <th>Tồn kho</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product->variants as $variant)
                                    <tr>
                                        <td>{{ ++$loop->index }}</td>
                                        <td>{{ $variant->title }}</td>
                                        <td>{{ $variant->price }}</td>
                                        <td>{{ $variant->position }}</td>
                                        <td>{{ $variant->inventory_quantity }}</td>
                                        <td>
                                            <a href='{{ route('admin.product-variant.destroy', $variant->id) }}'
                                                class='btn btn-danger delete-item mx-2'><i class='fas fa-trash'></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                @if (count($product->variants) === 0)
                                    <tr>
                                        <td colspan='6' class="text-center">No data found!</td>

                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </section>
@endsection
