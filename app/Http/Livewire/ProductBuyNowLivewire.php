<?php

namespace App\Http\Livewire;

use App\Models\carts;
use App\Models\City;
use App\Models\Couriers;
use App\Models\Product;
use App\Models\Province;
use App\Models\Transactions;
use App\Models\TransactionDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ProductBuyNowLivewire extends Component
{

    public Product $product;

    public $qty;
    public $cost;
    public $province;
    public $city;
    public $courier;
    public $services;
    public $weight;
    public $subtotal;
    public $address;
    public $id_province = '';
    public $id_city = '';
    public $id_courier = '';
    public $id_service = '';
    public $serviceChanged = false;

    protected $queryString = ['qty'];

    protected $rules = [
        'address' => 'required|min:6',
    ];

    public function mount(Product $product)
    {
        $this->product = $product;
        if ($this->qty <= 0) {
            $this->qty = 1;
        }
        if ($this->qty > $this->product->stock) {
            $this->qty = $this->product->stock;
        }
        $this->sumSubtotal();
        $this->sumWeight();
        $this->provinces = Province::all();
        $this->couriers = Couriers::all('courier', 'id');
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
        $this->subtotal += ($this->product->discount ? $this->product->price_discount() : $this->product->price) * $this->qty;
    }

    public function sumWeight()
    {
        $this->weight += $this->product->weight * $this->qty;
    }

    public function checkout()
    {
        $this->validate();

        $this->product->update([
            'stock' => $this->product->stock - $this->qty
        ]);

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

        TransactionDetails::create([
            'transactions_id' => $trx->id,
            'product_id' => $this->product->id,
            'qty' => $this->qty,
            'discount' => 0,
            'selling_price' => $this->product->discount ? $this->product->price_discount() : $this->product->price
        ]);
        $this->product->stock -= $this->qty;
        $this->product->save();

        return redirect()->route('user.payment', $trx->id);
    }

    public function render()
    {
        return view('livewire.product-buy-now');
    }
}