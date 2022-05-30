@extends('users.layout')

@section('content')
<div class="w-full">
<div class="container">
    <div class="mb-5">
        <h1 class="text-center">Checkout</h1>
    </div>

    @livewire('checkout-livewire')
</div>
</div>
@endsection