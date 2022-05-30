<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategories;
use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(){
        $categories = ProductCategories::orderby('id','desc')->paginate(5);
        return view('pages.admins.category.index', compact('categories'));
    }
    
    public function create(){
        return view('pages.admins.category.create');
    }
    
    public function store(Request $request){
        $category = new ProductCategories;
        $category->category_name = $request->category_name;
        $category->save();
        return Redirect::to('/admins/categories');
    }

    public function edit($id){
        $where = array('id' => $id);
        $data['category'] = ProductCategories::where($where)->first();
        return view('pages.admins.category.edit', $data);        
    }    

    public function update(Request $request, $id){
        $update = ['category_name' => $request->category_name];
        ProductCategories::where('id', $id)->update($update);
        return Redirect::to('/admins/categories');
    }

    public function delete($id){
        $categories = ProductCategories::find($id);
        $categories->delete();
        return Redirect::to('/admins/categories');
    }

}
