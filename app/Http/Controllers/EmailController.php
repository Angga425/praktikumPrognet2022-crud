<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use App\Mail\Admin_Email;
use App\Mail\Reset;
use App\Mail\Admin_Reset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public static function email($name, $email, $verification_code){
        $data = [
            'name' => $name,
            'verification_code' => $verification_code,
        ];
        
        Mail::to($email)->send(new Email($data));
    }

    public static function reset($name, $email, $verification_code){
        $data = [
            'name' => $name,
            'verification_code' => $verification_code,
        ];
        
        Mail::to($email)->send(new Reset($data));
    }
    
    public static function admin_email($name, $email, $verification_code){
        $data = [
            'name' => $name,
            'verification_code' => $verification_code,
        ];
        
        Mail::to($email)->send(new Admin_Email($data));
    }

    public static function admin_reset($name, $email, $verification_code){
        $data = [
            'name' => $name,
            'verification_code' => $verification_code,
        ];
        
        Mail::to($email)->send(new Admin_Reset($data));
    }
}
