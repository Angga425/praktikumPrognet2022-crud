<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Couriers;
use Redirect;
use Illuminate\Support\Facades\DB;

class CourierController extends Controller
{
    public function index(){
        $couriers = Couriers::orderby('id','desc')->paginate(5);
        return view('pages.admins.courier.courierlist', compact('couriers'));
    }
    
    public function create(){
        return view('pages.admins.courier.couriercreate');
    }
    
    public function store(Request $request){
        $couriers = new Couriers;
        $couriers->courier = $request->courier;
        $couriers->save();
        return Redirect::to('/admins/couriers');
    }

    public function edit($id){
        $where = array('id' => $id);
        $data['courier'] = Couriers::where($where)->first();
        return view('pages.admins.courier.courieredit', $data);        
    }    

    public function update(Request $request, $id){
        $update = ['courier' => $request->courier];
        Couriers::where('id', $id)->update($update);
        return Redirect::to('/admins/couriers');
    }

    public function delete($id){
        $couriers = Couriers::find($id);
        $couriers->delete();
        return Redirect::to('/admins/couriers');
    }
}
