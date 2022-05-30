<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admins;

class Admin_Notification extends Model
{
    use HasFactory;

    protected $table = 'admin_notifications';

    public function admins() { 
      return $this->belongsTo(Admins::class);
    }
}
