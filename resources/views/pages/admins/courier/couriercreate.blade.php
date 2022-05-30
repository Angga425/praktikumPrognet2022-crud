@extends('layouts.admin')

@section('content')   
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="form-signin" action="/admins/couriers/store" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h2>Add Courier</h2>
                                <br>
                                <label for="">Courier Name :</label>
                                <div class="input-group input-group-outline my-3">                                    
                                    <input type="text" class="form-control" name="courier">
                                </div>
                                <br>
                                <div>
                                    <button class="btn btn-primary" style="background-color:#80134d" type="submit">
                                        Add Courier
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