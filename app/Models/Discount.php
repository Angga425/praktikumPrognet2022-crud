<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'discounts';

    protected $fillable = [
      'percentage',
      'start',
      'end',
    ];

    public function product() { 
      return $this->belongsTo(Product::class, 'id_product', 'id');
    }
}
