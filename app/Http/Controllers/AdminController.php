<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use Carbon\Carbon;
use App\Models\Couriers;
use App\Models\Transactions;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('pages.admins.login.login1');
    }

    public function login(Request $request)
    {
        // dd($request);
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admins')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('admins.dashboard');
        }

        return back()->withErrors([
            'username' => 'Use the right admin username!',
        ]);
    }
  
    public function logout(Request $request)
    {
        Auth::guard('admins')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admins.login');
    }

    public function dashboard()
    {
        $itemtransaksicount = DB::table('adminnotifications')
        ->select('id', 'adminnotifications.id_checkout_review', 'adminnotifications.jenis')
        ->where('adminnotifications.jenis', "transaksi")
        ->count();
        $itempembayarancount = DB::table('adminnotifications')
        ->select('id','adminnotifications.id_checkout_review', 'adminnotifications.jenis')
        ->where('adminnotifications.jenis', "pembayaran")
        ->count();
        $itemreviewcount = DB::table('adminnotifications')
        ->select('id','adminnotifications.id_checkout_review', 'adminnotifications.jenis')
        ->where('adminnotifications.jenis', "review")
        ->count();

        $itemtransaksitotal = DB::table('adminnotifications')
        ->select('id','id_checkout_review', 'jenis')
        ->count();

        $itemtransaksi = DB::table('adminnotifications')
        ->select('id','id_checkout_review', 'jenis')
        ->get();

        if ($itemtransaksitotal > '0') {
            if($itemtransaksitotal == '1'){
                if($itemtransaksi[0]->jenis == 'transaksi'){
                notify()->success('Hi transaksi baru dengan id : '.$itemtransaksi[0]->id_checkout_review.' sudah masuk,segera cek!!!');
                $itemdelete = DB::delete('DELETE FROM adminnotifications WHERE adminnotifications.id = '.$itemtransaksi[0]->id.';');
                }
                elseif($itemtransaksi[0]->jenis == 'pembayaran'){
                notify()->success('Hi bukti pembayaran transaksi dengan id : '.$itemtransaksi[0]->id_checkout_review.' sudah tersedia, segera cek!!!');
                $itemdelete = DB::delete('DELETE FROM adminnotifications WHERE adminnotifications.id = '.$itemtransaksi[0]->id.';');
                }

                elseif($itemtransaksi[0]->jenis == 'review'){
                    notify()->success('Hi terdapat ulasan baru dengan id : '.$itemtransaksi[0]->id_checkout_review.' segera cek!!!');
                    $itemdelete = DB::delete('DELETE FROM adminnotifications WHERE adminnotifications.id = '.$itemtransaksi[0]->id.';');
                }
            }
            elseif($itemtransaksitotal > '1'){
                foreach ($itemtransaksi as $ya){
                    if($itemtransaksicount > 0 and $itempembayarancount > 0 and $itemreviewcount > 0){
                        notify()->success('Hi beberapa transaksi dan bukti pembayaran transaksi serta ulasan baru telah tersedia, segera cek!!!');
                        foreach ($itemstatus as $y){ 
                        $itemdelete = DB::delete('DELETE FROM adminnotifications WHERE adminnotifications.id = '.$y->id.';');
                        }
                    }
                    elseif($itemtransaksicount > 0 and $itempembayarancount > 0 ){
                        notify()->success('Hi beberapa transaksi dan bukti pembayaran transaksi baru telah tersedia, segera cek!!!');
                        foreach ($itemtransaksi as $y){ 
                        $itemdelete = DB::delete('DELETE FROM adminnotifications WHERE adminnotifications.id = '.$y->id.';');
                        }
                    }
                    elseif($itemtransaksicount > 0 and $itemreviewcount > 0){
                        notify()->success('Hi beberapa transaksi dan ulasan baru telah tersedia, segera cek!!!');
                        foreach ($itemtransaksi as $y){ 
                        $itemdelete = DB::delete('DELETE FROM adminnotifications WHERE adminnotifications.id = '.$y->id.';');
                        }
                    }
                    elseif($itempembayarancount > 0 and $itemreviewcount > 0){
                        notify()->success('Hi beberapa bukti pembayaran transaksi dan ulasan baru telah tersedia, segera cek!!!');
                        foreach ($itemtransaksi as $y){ 
                        $itemdelete = DB::delete('DELETE FROM adminnotifications WHERE adminnotifications.id = '.$y->id.';');
                        }
                    }
                    elseif($ya->jenis == "transaksi"){
                        notify()->success('Hi beberapa transaksi baru sudah masuk, segera cek!!!');
                        foreach ($itemtransaksi as $y){ 
                        $itemdelete = DB::delete('DELETE FROM adminnotifications WHERE adminnotifications.id = '.$y->id.';');
                        }
                    }
                    elseif($ya->jenis == "pembayaran"){
                        notify()->success('Hi beberapa bukti transaksi pembayaran sudah tersedia, segera cek!!!');
                        foreach ($itemtransaksi as $y){ 
                        $itemdelete = DB::delete('DELETE FROM adminnotifications WHERE adminnotifications.id = '.$y->id.';');
                        }
                    }
                    elseif($ya->jenis == "review"){
                        notify()->success('Hi beberapa ulasan baru sudah tersedia, segera cek!!!');
                        foreach ($itemtransaksi as $y){ 
                        $itemdelete = DB::delete('DELETE FROM adminnotifications WHERE adminnotifications.id = '.$y->id.';');
                        }
                    }
                    
                }
            }
        }

        $user = User::count();
        if (!$user) {
            $user = 0;
        }
        $product = Product::count();
        if (! $product) {
            $product = 0;
        }
        $transaction = Transactions::count();
        if (!$transaction) {
            $transactiont = 0;
        }
        $courier = Couriers::count();
        if (!$courier) {
            $courier = 0;
        }

        $now = Carbon::now('Asia/Makassar');
        $allTransactions = Transactions::where('status', 'Telah Sampai')->get();
        //dd($allTransactions);
        $allSales = Transactions::where('status','Telah Sampai')->count();
        $monthlySales = Transactions::where('status','Telah Sampai')->whereMonth('created_at', $now->month)->count();
        $annualSales = Transactions::where('status','Telah Sampai')->whereYear('created_at', $now->year)->count();
        $monthlyTransactions = Transactions::where('status', 'Telah Sampai')->whereMonth('created_at', $now->month)->get();
        $annualTranscations = Transactions::where('status', 'Telah Sampai')->whereYear('created_at', $now->year)->get();
        $incomeTotal = 0;
        $incomeMonthly = 0;
        $incomeAnnual = 0;

        foreach ($allTransactions as $transaction) {
            $incomeTotal+=$transaction->total;
        }

        
        foreach ($monthlyTransactions as $monthly) {
            $incomeMonthly+=$monthly->total;
        }

        foreach ($annualTranscations as $annual) {
            $incomeAnnual+=$annual->total;
        }

        
        $january = Transactions::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '01')->count();
        $february = Transactions::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '02')->count();
        $march = Transactions::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '03')->count();
        $april = Transactions::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '04')->count();
        $may = Transactions::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '05')->count();
        $june = Transactions::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '06')->count();
        $july = Transactions::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '07')->count();
        $august = Transactions::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '08')->count();
        $september = Transactions::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '09')->count();
        $october = Transactions::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '10')->count();
        $november = Transactions::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '11')->count();
        $december = Transactions::where('status', 'barang telah sampai di tujuan')->whereMonth('created_at', '12')->count();

        return view('pages.admins.dashboard.index', compact(
            'user','product','transaction','courier',
            'now', 'allSales', 'monthlySales', 'annualSales', 'incomeTotal', 'incomeMonthly', 'incomeAnnual', 'january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'
        ));
    }


    
}
