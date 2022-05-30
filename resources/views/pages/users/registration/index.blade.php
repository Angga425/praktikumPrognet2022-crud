@extends('layouts.registration.index')

@section('title', 'User Registration')

<!-- @section('images') -->
<!--           <div class="img" style="background-image: url( {{asset('style/login/images/bg-1.jpg')}} );"> -->
<!--           </div> -->
<!-- @endsection -->

<!-- SEND EMAIL NOTIFICATION -->

@section('form')
              @if(session()->has('success'))
                <div class="alert alert-success alert-dismissable fade show" role="alert">
                    {{ session('success') }}
                    <button type=button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

              @if(session()->has('registrationError'))
                <div class="alert alert-danger alert-dismissable fade show" role="alert">
                    {{ session('registrationError') }}
                    <button type=button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

							<form action="{{ route('users.register') }}" method="POST" class="signin-form">
                @csrf
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Name</label>
			      			<input name="name" id="name" type="text" class="form-control" placeholder="Name" autofocus required value="{{ old('name')}}">
                  @error('email')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
			      		</div>
			      		<div class="form-group mb-3">
			      			<label class="label" for="email">Email</label>
			      			<input name="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" autofocus required value="{{ old('email')}}">
                  @error('email')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Password</label>
		              <input name="password" id="password" type="password" class="form-control" placeholder="Password" autofocus required>
		            </div>
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-primary rounded submit px-3">Register</button>
		            </div>
		            <div class="form-group d-md-flex">
									</div>
									<!-- <div class="w-50 text-md-right"> -->
									<!-- 	<a href="#">Resend Email Verification Code</a> -->
									<!-- </div> -->
		            </div>
		          </form>
@endsection

@section('login-link')
    <p class="text-center">Already a member? <a data-toggle="tab" href="{{ route('users.login-index') }}"> Login </a></p>
@endsection

