@extends('layouts.admin')

@section('content')   
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="form-signin" action="/admins/products/update/{{$products->id}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h2>Edit Product</h2>
                                <br>
                                <label for="">Nama Produk :</label>
                                <div class="input-group input-group-outline my-3">                                    
                                    <input type="text" class="form-control" placeholder="Nama Produk" name="product_name" value="{{$products->product_name}}">
                                </div>
                                <label for="">Harga Satuan :</label>
                                <div class="input-group input-group-outline my-3">                                    
                                    <input type="text" class="form-control" placeholder="Harga Satuan" name="price" value="{{$products->price}}">
                                </div>
                                <label for="">Stok :</label>
                                <div class="input-group input-group-outline my-3">                                    
                                    <input type="text" class="form-control" placeholder="Stok" name="stock" value="{{$products->stock}}">
                                </div>
                                <label for="">Berat Produk :</label>
                                <div class="input-group input-group-outline my-3">                                    
                                    <input type="text" class="form-control" placeholder="Berat Produk" name="weight" value="{{$products->weight}}">
                                </div>
                                <label for="">Kategori :</label>
                                <div class="input-group input-group-outline my-3">                                    
                                    <select name="category_id[]">
                                        @foreach($category as $categories)
                                        <option
                                            @foreach ($categoryDetail as $dataDetail)
                                                @if ($dataDetail->category_id==$categories->id) selected="selected"
                                                @endif
                                            @endforeach
                                            value="{{$categories->id}}">{{$categories->category_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>                                
                                <label for="">Deskripsi :</label>
                                <div class="mb-3">
                                    <textarea name="description" id="" cols="50" rows="5">{{$products->description}}</textarea>                                                    
                                </div>
                                <label for="">Pilih Foto :</label>
                                <div class="preview">
                                    <img id="file-ip-1-preview" style="width: 100px">
                                </div>
                                <div class="input-group input-group-outline my-3"> 
                                    <input type="hidden" class="form-control @error ('hidden_image') is-invalid @enderror"  id="hidden_image" value="{{$products->image_name}}" name="hidden_image">                                   
                                    <input type="file" class="form-control" placeholder="" name="foto" onchange="showPreview(event);">
                                </div>
                                <br>
                                <div>
                                    <button class="btn btn-primary" type="submit">
                                        Edit Product
                                    </button>                                                                   
                                </div>                          
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function showPreview(event){
            if(event.target.files.length > 0){
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
@endsection