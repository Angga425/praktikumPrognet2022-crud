<?php

namespace App\Http\Livewire;

use App\Models\Admin;
use App\Models\carts;
use App\Models\City;
use App\Models\Couriers;
use App\Models\Province;
use App\Models\Transactions;
use App\Models\TransactionDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CheckoutLivewire extends Component
{
    public $provinces;
    public $cities;
    public $courier;
    public $services;
    public $carts;
    public $cost = 0;
    public $subtotal = 0;
    public $weight = 0;
    public $address;
    public $id_province = '';
    public $id_city = '';
    public $id_courier = '';
    public $id_service = '';
    public $list_courier = [];
    public $serviceChanged = false;

    protected $rules = [
        'address' => 'required|min:6',
    ];

    public function render()
    {
        $this->sumSubtotal();
        $this->sumWeight();
        $this->provinces = Province::all();
        $this->carts = carts::with('product')->whereUserId(auth()->user()->id)->whereStatus('Dalam Keranjang')->get();
        $this->couriers = Couriers::all('courier', 'id');
        return view('livewire.checkout');
    }

    public function updatedIdProvince()
    {
        $this->cities = Province::find($this->id_province)->cities;
    }

    public function updatedIdCourier()
    {
        $this->services = Http::withHeaders([
            'key' => env('RAJAONGKIR_KEY'),
            'content-type' => 'application/x-www-form-urlencoded'
        ])->asForm()->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => '114',
            'destination' => $this->id_city,
            'weight' => $this->weight,
            'courier' => Couriers::find($this->id_courier)->courier
        ])->json()['rajaongkir']['results'][0]['costs'];
        $this->serviceChanged = true;
    }

    public function updatedIdService()
    {
        $this->serviceChanged = true;
    }


    public function checkCost()
    {
        $this->validate();

        $this->cost = Http::withHeaders([
            'key' => env('RAJAONGKIR_KEY'),
            'content-type' => 'application/x-www-form-urlencoded'
        ])->asForm()->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => '114',
            'destination' => $this->id_city,
            'weight' => $this->weight,
            'courier' => Couriers::find($this->id_courier)->courier
        ])->json()['rajaongkir']['results'][0]['costs'][$this->id_service]['cost'][0]['value'];

        $this->serviceChanged = false;
    }

    public function sumSubtotal()
    {
        $cart = carts::with('product')->whereUserId(auth()->user()->id)->whereStatus('Dalam Keranjang')->get();
        $this->subtotal = 0;
        foreach ($cart as $item) {
            $this->subtotal += $item->product->discount ? $item->product->price_discount() * $item->qty : $item->product->price * $item->qty;
        }
    }

    public function sumWeight()
    {
        $cart = carts::with('product')->whereUserId(auth()->user()->id)->whereStatus('Dalam Keranjang')->get();
        $this->weight = 0;
        foreach ($cart as $item) {
            $this->weight += $item->product->weight * $item->qty;
        }
    }

    public function checkout()
    {
        $this->validate();

        $cart = carts::with('product')->whereUserId(auth()->user()->id)->whereStatus('Dalam Keranjang')->get();
        $trx = Transactions::create([
            'timeout' => Carbon::now()->timezone('Asia/Makassar')->addDay(),
            'address' => $this->address,
            'regency' => City::find($this->id_city)->title,
            'province' => Province::find($this->id_province)->title,
            'total' => $this->subtotal + $this->cost,
            'shipping_cost' => $this->cost,
            'sub_total' => $this->subtotal,
            'user_id' => auth()->user()->id,
            'courier_id' => $this->id_courier,
            'status' => 'Belum Terbayar'
        ]);
        foreach ($cart as $item) {
            TransactionDetails::create([
                'transactions_id' => $trx->id,
                'product_id' => $item->product->id,
                'qty' => $item->qty,
                'discount' => $item->product->discount->percentage ?? 0,
                'selling_price' => $item->product->discount ? $item->product->price_discount() : $item->product->price
            ]);
            $item->product->stock -= $item->qty;
            $item->product->save();
        }
        carts::whereUserId(auth()->user()->id)->whereStatus('Dalam Keranjang')->delete();
    
        return redirect()->route('user.payment', $trx->id);
    }
}
