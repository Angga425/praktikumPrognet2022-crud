<?php

namespace App\Http\Livewire;

use App\Models\carts;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartLivewire extends Component
{
    public $price_total = 0;
    public $cart_count = 0;

    protected $listeners = [
        'addedToCart' => 'countCart',
        'itemIncremented' => 'countCart',
        'itemDecremented' => 'countCart',
        'itemDeleted' => 'countCart',
    ];

    public function render()
    {
        if (auth()->check()) {
            $this->countCart();
        }
        return view('livewire.cart');
    }

    public function countCart()
    {
        $cart = carts::with('product')->whereUserId(Auth::user()->id)->whereStatus('Dalam Keranjang')->get();
        $this->price_total = 0;
        foreach ($cart as $item) {
            $this->price_total += ($item->product->discount ? $item->product->price_discount() : $item->product->price) * $item->qty;
        }
        $this->cart_count = $cart->count();
    }
}