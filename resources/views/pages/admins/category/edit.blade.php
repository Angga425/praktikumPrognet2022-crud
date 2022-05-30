@extends('layouts.admin')

@section('content')   
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="form-signin" action="/admins/categories/update/{{$category->id}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h2>Edit Category</h2>
                                <br>
                                <label for="">Category Name :</label>
                                <div class="input-group input-group-outline my-3">                                    
                                    <input type="text" class="form-control" name="category_name" value="{{ $category->category_name }}">
                                </div>
                                <br>                          
                                <button class="btn btn-primary" type="submit">
                                    Edit Category
                                </button>                                                                   
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection