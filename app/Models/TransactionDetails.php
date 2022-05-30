<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;
use App\Models\Transactions;

class TransactionDetails extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products() { 
      return $this->belongsTo(Product::class);
    }

    public function transactions() { 
      return $this->belongsTo(Transactions::class);
    }
}
