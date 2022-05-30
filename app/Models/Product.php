<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImages;
use App\Models\Discount;
use App\Models\ProductCategorysDetails;
use App\Models\ProductReviews;
use App\Models\ProductCategories;
use App\Models\carts;
use App\Models\TransactionDetails;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';  

    protected $fillable = [
      'product_name',
      'price',
      'description',
      'stock',
      'weight',
    ];

    public function product_images() { 
      return $this->hasMany(ProductImages::class, 'product_id','id');
    }   

    public function discount() { 
      return $this->hasOne(Discount::class);
    }   
    
    public function isHasDiscount() { 
      return $this->discounts ? true : false;
    }  
    
    public function price_discount() { 
      return (1 - $this->discount->percentage / 100) * $this->price;
    }   

    public function product_categories() {
      return $this->belongsToMany(ProductCategories::class, 'product_category_details','product_id','category_id')->withPivot('id');
    }

    public function product_category_details() { 
      return $this->hasMany(ProductCategorysDetails::class, 'product_id','id');
    }   

    public function carts() { 
      return $this->hasMany(carts::class);
    } 
    
    public function product_reviews() { 
      return $this->hasMany(ProductReviews::class);
    } 

    public function transaction_details() { 
      return $this->hasMany(TransactionDetails::class);
    } 

    public function getRateAttribute(){
      if ($this->product_reviews->count() >0){
        return $this->product_reviews->avg('rate');
      }
    }
}
