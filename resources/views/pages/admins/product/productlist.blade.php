@extends('layouts.admin')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table">
                            <h2>List Products</h2>
                            <br>
                            <button type="button" class="btn" style="background-color:#7CFC00">
                                <a href="products/create">Add Product</a>
                            </button>
                            <!-- <button type="button" class="btn bg-gradient-danger">
                                <a href="">Trash</a>
                            </button> -->
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Harga</th>
                                        <th>Foto</th>
                                        <th colspan="3">Action</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)                                                                       
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>
                                            @foreach($categories as $category)
                                                @if($product->id == $category->product_id)
                                                <li>{{ $category->category_name }}</li>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>Rp. {{ number_format($product->price,0,',','.') }}</td>
                                        <td>
                                            @php
                                                $image = $producsimage->where('product_id', $product->id)->first();
                                            @endphp
                                            <img src='/uploads/product_images/{{$image->image_name}}' style="width: 100px; margin-top: 10px;" />
                                        </td>
                                        <td style="align: center;">
                                            <a href="products/show/{{$product->id}}" class="btn bg-gradient-info">Detail</a>
                                            <a href="products/edit/{{$product->id}}" class="btn bg-gradient-warning">Edit</a>
                                            <a href="{{ url('admins/products/' . $product->id . '/reviews') }}" class="btn bg-gradient-primary">Review</a>
                                            <a href="/admins/products/delete/{{$product->id}}" class="btn bg-gradient-danger" onclick="return confirm('Apa yakin ingin menghapus data ini?')">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection