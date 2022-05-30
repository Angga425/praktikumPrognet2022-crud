<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCategorysDetails;;

class ProductCategories extends Model
{
    use HasFactory;
    
    protected $table = 'product_categories';
    protected $fillable = ['category_name'];

    public function product_category_details() { 
      return $this->hasMany(ProductCategorysDetails::class, 'category_id', 'id');
    }   

    public function product(){
      return $this->belongsToMany(Product::class, 'product_category_details', 'category_id', 'product_id')->withPivot('id');
    }
}
