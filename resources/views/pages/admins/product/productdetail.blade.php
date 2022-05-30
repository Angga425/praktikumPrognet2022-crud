@extends('layouts.admin')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table">
                            <h2>Details Products</h2>
                            <br>                            
                            <table class="table table-striped table-hover">                                
                                @foreach($products as $product)
                                <tbody>                                                                                                           
                                    <tr>
                                        <th>Nama Produk</th>
                                        <td>{{ $product->product_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Rating Produk</th>
                                        <td>{{ $product->product_rate }}</td>
                                    </tr>
                                    <tr>
                                        <th>Stok</th>
                                        <td>{{ $product->stock }}</td>
                                    </tr>
                                    <tr>
                                        <th>Berat</th>
                                        <td>{{ $product->weight }}</td>
                                    </tr>
                                    <tr>
                                        <th>Harga</th>
                                        <td>Rp. {{ number_format($product->price,0,',','.') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi</th>
                                        <td>{{ $product->description }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td>
                                            @foreach($categories as $category)
                                                <button>{{$category->category_name}}</button>
                                            @endforeach                                            
                                        </td>
                                    </tr>                                        
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table">
                            <div class="row">
                                @forelse($image as $images)
                                <div class="thumbnail">
				                    <img class="img-fluid-left img-thumbnail" src="/uploads/product_images/{{$images->image_name}}" alt="light" style="width:200px; height:200px;">
                                </div>
                                @empty
                                <h1>Tidak Ada Foto</h1>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection