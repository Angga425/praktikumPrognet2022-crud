<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\Transactions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function payment(Transactions $transaction)
    {
        if (auth()->user()->id !== $transaction->user_id) {
            return abort(404);
        }
        if ($transaction->timeout < Carbon::now()) {
            $transaction->update([
                'status' => 'Expired'
            ]);
        }
        return view('users.transaction.payment', compact('transaction'));
    }

    public function uploadProofPayment(Request $request, Transactions $transaction)
    {
        $request->validate([
            'proof_payment' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $image = $request->file('proof_payment');
        $imageName = Str::slug(auth()->user()->name) . '-' . time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/proof_payment'), $imageName);

        $transaction->update([
            'proof_of_payment' => $imageName,
            'status' => 'Pending',
        ]);

        return redirect()->route('user.payment', $transaction);
    }

    public function deleteTransaction(Transactions $transaction)
    {
        if (auth()->user()->id !== $transaction->user_id) {
            return abort(404);
        }
        $transaction->delete();
        return redirect()->route('user.home');
    }
}