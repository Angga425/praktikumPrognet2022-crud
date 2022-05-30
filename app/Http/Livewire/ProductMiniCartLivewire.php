<?php

namespace App\Http\Livewire;

use App\Models\carts;
use App\Models\Product;
use App\Models\Transaction;
use Livewire\Component;

class ProductMiniCartLivewire extends Component
{
    public Product $product;
    public $qty = 1;

    public function render()
    {
        if (!auth()->check()) {
            return view('livewire.product-mini-cart');
        }
        $carts = carts::whereUserId(auth()->user()->id)->whereProductId($this->product->id);
        return view('livewire.product-mini-cart', compact('carts'));
    }

    public function addToCart()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $cart = carts::whereUserId(auth()->user()->id)->whereProductId($this->product->id)->first();
        if ($cart) {
            $cart->update([
                'qty' => $cart->qty + $this->qty,
            ]);
        } else {
            carts::create([
                'user_id' => auth()->user()->id,
                'product_id' => $this->product->id,
                'qty' => $this->qty,
                'status' => 'Dalam Keranjang'
            ]);
        }
        $this->emit('addedToCart');
    }

    public function decrementQty()
    {
        if ($this->qty > 1) {
            $this->qty -= 1;
        }
    }

    public function incrementQty()
    {
        if ($this->qty < $this->product->stock) {
            $this->qty += 1;
        }
    }
}