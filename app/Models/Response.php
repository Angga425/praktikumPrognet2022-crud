<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admins;
use App\Models\ProductReviews;

class Response extends Model
{
    use HasFactory;

    protected $table = 'rensponses';
    protected $guarded = [];

    
    public function admins() { 
      return $this->belongsTo(Admins::class);
    }

    public function review()
    {
        return $this->belongsTo(ProductReviews::class);
    }
}
