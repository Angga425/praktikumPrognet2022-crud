<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
use Illuminate\Http\Request;

class OrderUserController extends Controller
{
    public function index(){
    $transactions = Transactions::whereUserId(auth()->user()->id)->get();
    return view('users.order.index', compact('transactions'));
}
}