<?php

namespace App\Http\Livewire;

use App\Models\carts;
use App\Models\City;
use App\Models\Couriers;
use App\Models\Province;
use App\Models\Transactions;
use App\Models\TransactionDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CartListLivewire extends Component
{
    public $subtotal = 0;
    public $provinces;
    public $id_province = '';
    public $cities;
    public $id_city = '';
    public $id_courier = '';
    public $cost = 0;
    public $weight = 0;
    public $isLoading = false;

    public function render()
    {
        $carts = carts::with('product')->whereUserId(auth()->user()->id)->whereStatus('Dalam Keranjang')->get();
        $this->provinces = Province::all();
        $couriers = Couriers::all('courier', 'id');
        return view('livewire.cart-list', compact('carts', 'couriers'));
    }

    public function deleteItem($id)
    {
        $cart = carts::find($id);
        $cart->delete();
        $this->emit('itemDeleted');
    }

    public function decrementQty($id)
    {
        $cart = carts::find($id);
        if ($cart->product->stock > 0) {
            if ($cart->qty > 1) {
                $cart->qty -= 1;
                $cart->product->stock += 1;
                $cart->save();
            } else {
                $this->deleteItem($id);
            }
        }

        $this->emit('itemDecremented');
    }

    public function incrementQty($id)
    {
        $cart = carts::find($id);
        $cart->qty += 1;
        $cart->product->stock -= 1;
        $cart->save();
        $this->emit('itemIncremented');
    }

    public function checkout()
    {
        return redirect()->route('user.checkout');
    }
}