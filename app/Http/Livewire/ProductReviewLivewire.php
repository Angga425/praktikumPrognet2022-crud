<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductReviews;
use App\Models\Transactions;
use Livewire\Component;

class ProductReviewLivewire extends Component
{
    public $transaction;
    public $transaction_id;
    public $review;
    public $rate = 0;
    public function render()
    {
        return view('livewire.product-review');
    }

    public function mount()
    {
        $this->getTransaction();
    }

    public function getTransaction()
    {
        $this->transaction = Transactions::find($this->transaction_id)->products()->get();
    }

    public function storeReview($product_id)
    {

        ProductReview::create(
            [
                'product_id' => $product_id,
                'user_id' => auth()->user()->id,
                'content' => $this->review,
                'rate' => $this->rate,
            ]
        );
        $this->reset('review', 'rate');
        $this->getTransaction();
    }
}