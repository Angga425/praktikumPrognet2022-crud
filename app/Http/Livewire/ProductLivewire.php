<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\ProductCategories;
use App\Models\ProductCategorysDetails;
use Livewire\Component;
use Livewire\WithPagination;

class ProductLivewire extends Component
{
    use WithPagination;

    public $search;

    public $byCategory = null;

    public function render()
    {
        // $products = Product::where('product_name', 'like', '%' . $this->search . '%')->paginate(8);
        $products = ProductCategorysDetails::when($this->byCategory, function($query){
            $query->where('category_id',$this->byCategory);
        })->paginate(8);
        $categories = ProductCategories::all();
        $producsimage = ProductImages::all();
        return view('livewire.product-livewire', compact('products', 'producsimage','categories'));
    }
}
