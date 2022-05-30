<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class ProductUserController extends Controller
{
    public function show(Product $product)
    {
        $reviews = $product->product_reviews()->get();
        $reviewCount = $product->product_reviews()->count();
        $rate = [
            '1' => $reviews->where('rate', 1)->count(),
            '2' => $reviews->where('rate', 2)->count(),
            '3' => $reviews->where('rate', 3)->count(),
            '4' => $reviews->where('rate', 4)->count(),
            '5' => $reviews->where('rate', 5)->count(),
        ];
        if (!auth()->check()) {
            return view('users.product.show', compact('product', 'reviews', 'reviewCount', 'rate'));
        }
        $isHasReview = $product->product_reviews()->where('user_id', auth()->user()->id)->where('product_id', $product->id)->count() > 0;
        return view('users.product.show', compact('product', 'reviews', 'rate', 'reviewCount', 'isHasReview'));
    }

    public function buyNow(Product $product)
    {
        return view('users.transaction.buy-now', compact('product'));
    }

    public function storeReview(Request $request, Product $product)
    {
        if ($product->product_reviews()->where('user_id', auth()->user()->id)->count() > 0) return redirect()->back();

        $request->validate([
            'content' => 'required|min:10',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        $product->product_reviews()->create([
            'user_id' => auth()->user()->id,
            'content' => $request->content,
            'rate' => $request->rating,
        ]);

        return redirect()->back();
    }
}
