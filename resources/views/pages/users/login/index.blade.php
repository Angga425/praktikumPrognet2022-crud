@extends('layouts.login.index')

@section('title', 'Login User')

@section('images')
          <div class="img" style="background-image: url( {{asset('style/login/images/bg-1.jpg')}} );">
          </div>
@endsection

@section('form')
              @if(session()->has('success'))
                <div class="alert alert-success alert-dismissable fade show" role="alert">
                    {{ session('success') }}
                    <button type=button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

              @if(session()->has('loginError'))
                <div class="alert alert-danger alert-dismissable fade show" role="alert">
                    {{ session('loginError') }}
                    <button type=button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

							<form action="{{ route('users.login') }}" method="POST" class="signin-form">
                @csrf
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
		            	<button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
		            </div>
		            <div class="form-group d-md-flex">
		            	<div class="w-50 text-left">
			        <!--     	<label class="checkbox-wrap checkbox-primary mb-0">Remember Me -->
									  <!-- <input type="checkbox" checked> -->
									  <span class="checkmark"></span>
										</label>
									</div>
									<div class="w-50 text-md-right">
										<a href="#">Forgot Password</a>
									</div>
		            </div>
		          </form>
@endsection

@section('registration-link')
    <p class="text-center">Not a member? <a data-toggle="tab" href="{{ route('users.register-index') }}">Sign Up</a></p>
@endsection
