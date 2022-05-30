@extends('users.layout')

@section('content')
    @livewire('product-buy-now-livewire', ['product' => $product])
@endsection
