@extends('layouts.admin')

@section('content')   
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="form-signin" action="/admins/categories/store" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h2>Add Category</h2>
                                <br>
                                <label for="">Category Name :</label>
                                <div class="input-group input-group-outline my-3">                                    
                                    <input type="text" class="form-control" name="category_name">
                                </div>
                                <br>
                                <div>
                                    <button class="btn btn-primary" style="background-color:#80134d" type="submit">
                                        Add Category
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