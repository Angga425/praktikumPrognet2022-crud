<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\EmailController;
use Hash;
use Auth;
use DB;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index(Request $request){
 
        $itemuser=$request->user();
        $itemstatuscount = DB::table('notifications')
        ->select('id','notifications.id_user', 'notifications.id_ulasan_checkout', 'notifications.jenis')
        ->where('notifications.id_user', $itemuser->id)
        ->count();
        $itemstatus = DB::table('notifications')
        ->select('id','notifications.id_user', 'notifications.id_ulasan_checkout', 'notifications.jenis')
        ->where('notifications.id_user', $itemuser->id)
        ->get();

        $itemulasan = DB::table('notifications')
        ->select('id','notifications.id_user', 'notifications.id_ulasan_checkout', 'notifications.jenis')
        ->where('notifications.id_user', $itemuser->id)
        ->where('notifications.jenis', "ulasan")
        ->count();
        $itemcekot= DB::table('notifications')
        ->select('id','notifications.id_user', 'notifications.id_ulasan_checkout', 'notifications.jenis')
        ->where('notifications.id_user', $itemuser->id)
        ->where('notifications.jenis', "checkout")
        ->count();
            if ($itemstatuscount > '0') {
            if($itemstatuscount == '1'){
                if($itemstatus[0]->jenis == 'checkout'){
                notify()->success('Hi status transaksimu dengan id : '.$itemstatus[0]->id_ulasan_checkout.', sudah diperbarui!!!');
                $itemdelete = DB::delete('DELETE FROM notifications WHERE notifications.id = '.$itemstatus[0]->id.';');
                }
                elseif($itemstatus[0]->jenis == 'ulasan'){
                notify()->success('Hi reviewmu dengan id : '.$itemstatus[0]->id_ulasan_checkout.', sudah dibalas!!!');
                $itemdelete = DB::delete('DELETE FROM notifications WHERE notifications.id = '.$itemstatus[0]->id.';');
                }
            }
            elseif($itemstatuscount > '1'){
                foreach ($itemstatus as $ya){
                    if($itemcekot > 0 and $itemulasan > 0){
                        notify()->success('Hi beberapa status transaksimu sudah diperbarui dan reviewmu sudah dibalas oleh admin, terimakasih!!!');
                        foreach ($itemstatus as $y){ 
                        $itemdelete = DB::delete('DELETE FROM notifications WHERE notifications.id = '.$y->id.';');
                        }
                    }
                    elseif($ya->jenis == "checkout"){
                        notify()->success('Hi beberapa status transaksimu sudah diperbarui terimakasih!!!');
                        foreach ($itemstatus as $y){ 
                        $itemdelete = DB::delete('DELETE FROM notifications WHERE notifications.id = '.$y->id.';');
                        }
                    }
                    elseif($ya->jenis == "ulasan"){
                        notify()->success('Hi beberapa reviewmu sudah dibalas terimakasih!!!');
                        foreach ($itemstatus as $y){ 
                        $itemdelete = DB::delete('DELETE FROM notifications WHERE notifications.id = '.$y->id.';');
                        }
                    }
                    
                }
            }
        }
        return view('users.homepage', compact(
            'itemuser','itemstatuscount','itemstatus','itemulasan',
            'itemcekot', 
        ));
    }

    public function create(Request $req){
        $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'image' => 'image',
        ]);

        $gambar = null;
        if($req->file('image')){
            $gambar = $req->file('image')->store('profile_picture');            
        }

        // Buat User baru
        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->profile_image = $gambar;
        $user->verification_code = sha1(time());
        $data = $user->save();

        // Success
        if($data){
            EmailController::email($user->name, $user->email, $user->verification_code);
            return redirect()->route('user.login')->with('success', 'Berhasil Mendaftar! Silahkan cek email untuk verifikasi');
        }
        
        // Fail
        return redirect()->route('user.login')->with('fail', 'Gagal Mendaftar!');
        
    }

    public function verify(){
        // Mengambil kode verifikasi lewat route
        $verification_code = \Illuminate\Support\Facades\Request::get('code');

        $user = User::where(['verification_code' => $verification_code])->first();

        // Verifikasi Akun
        if($user){
            $user->email_verified_at = new Carbon();
            $user->save();
            return redirect()->route('user.login')->with('success', 'Akun Anda telah diverifikasi! Silahkan masuk');
        }

        // Gagal Verifikasi
        return redirect()->route('user.login')->with('fail', 'Kode verifikasi tidak valid!');
    }

    public function doLogin(Request $req){
        $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Email belum terdaftar
        if(!$user = User::where(['email' => $req->email])->first()){
            return redirect()->route('user.login')->with('fail', 'Email belum terdaftar!');
        }

        $eva = $user->email_verified_at;
        
        // Email belum terverifikasi
        if($eva == null){
            return redirect()->route('user.login')->with('fail', 'Email anda belum terverifikasi!');
        }

        $status = $user->status;

        // User tidak aktif
        if($status == 'nonaktif'){
            return redirect()->route('user.login')->with('fail', 'Akun Anda tidak aktif! Hubungi mainadmin@gmail.com untuk aktivasi akun Anda');
        }

        $check = $req->only('email','password');

        // Set Remember Cookie jika user mencentang box
        $remember = $req->has('remember') ? true : false;

        // Success
        if(Auth::guard('web')->attempt($check,$remember)){
            $req->session()->regenerate();

            return redirect()->intended('/user/home');
        }

        // Fail
        return redirect()->route('user.login')->with('fail', 'Email atau Password tidak sesuai!');

    }

    public function logout(Request $req){
        Auth::logout();

        $req->session()->invalidate();

        $req->session()->regenerateToken();

        return redirect()->route('user.homepage');
    }

    public function request_reset(Request $req){
        $req->validate([
            'email' => 'required|email',
        ]);

        // Email belum terdaftar
        if(!$user = User::where(['email' => $req->email])->first()){
            return redirect()->route('user.forgot-password')->with('fail', 'Email belum terdaftar!');
        }

        $eva = $user->email_verified_at;

        // Email belum terverifikasi
        if($eva == null){
            return redirect()->route('user.forgot-password')->with('fail', 'Silahkan verifikasi akun Anda terlebih dahulu!');
        }

        // Buat kode verifikasi
        $user->verification_code = sha1(time());
        $data = $user->save();

        // Kirim email
        EmailController::reset($user->name, $user->email, $user->verification_code);
        return redirect()->route('user.forgot-password')->with('success', 'Silahkan cek email untuk reset password Anda');
    }

    public function verify_reset(){
        // Mengambil kode verifikasi lewat route
        $verification_code = \Illuminate\Support\Facades\Request::get('code');

        $user = User::where(['verification_code' => $verification_code])->first();

        // Ganti Password
        if($user){
            $email = $user->email;
            return view('landingpage.user.change-password', ['email'=>$email]);
        }

        // Gagal ganti Password
        return redirect()->route('user.forgot-password')->with('fail', 'Kode verifikasi tidak valid!');
    }

    public function save_reset(Request $req){
        $req->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $user = User::where(['email' => $req->email])->first();

        // Save Password baru
        if($user){
            $user->password = Hash::make($req->password);
            $user->save();
            return redirect()->route('user.login')->with('success', 'Berhasil melakukan reset password!');
        }

        // Gagal save Password
        return redirect()->route('user.login')->with('fail', 'Terjadi Kesalahan!');

    }
}