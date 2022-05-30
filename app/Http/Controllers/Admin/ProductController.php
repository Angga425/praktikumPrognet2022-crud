<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductCategories;
use App\Models\ProductCategorysDetails;
use App\Models\ProductImages;
use App\Models\ProductReviews;
use App\Models\Product;
use App\Models\Discount;
use App\Models\Response;
use Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function index(){
        $products = DB::table('products')
            ->select('products.*')            
            ->orderby('id','desc')->paginate(10);
        $categories = DB::table('product_categories')
            ->join('product_category_details','product_categories.id','=','product_category_details.category_id')
            ->select('product_categories.*','product_category_details.*')
            ->get();
        $discount = DB::table('discounts')
            ->select('discounts.*')
            ->get();
        $producsimage = ProductImages::all();

        return view('pages.admins.product.productlist', compact('products','categories','discount', 'producsimage'));
    }

    public function create(){
        $categories = ProductCategories::all();
        return view('pages.admins.product.productcreate', compact('categories'));
    }

    public function store(Request $request){
        

        

        $product = new Product;
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->product_rate = 0;
        $product->stock = $request->stock;
        $product->weight = $request->weight;
        $product->save();

        $kategoridata = $request->category_id;
        foreach($kategoridata as $kategori){
            $category = new ProductCategorysDetails;
            $product_id = Product::orderBy('id','desc')->first()->id;
            $category->category_id = $kategori;
            $category->product_id = $product_id;
            $category->save();
        }
        
        $id = Product::orderBy('id','desc')->first()->id;
        if($id){
            $files = [];
            foreach($request->file('files') as $file){
                if($file->isValid()){
                    $nama_image = time()."_".$file->getClientOriginalName();
                    $folder = 'uploads/product_images';
                    $file->move($folder,$nama_image);
                    $files[] = [
                        'product_id' => $id,
                        'image_name' => $nama_image,
                    ];
                }
            }
            ProductImages::insert($files);
        }
        return Redirect::to('/admins/products');
    }

    public function edit($id){
        $category = ProductCategories::all();
        $categoryDetail = DB::table('product_category_details')
            ->select('category_id')
            ->where('product_id', '=', $id)->get();
        $products = Product::find($id);
        $producsimage = ProductImages::find($id);
        return view('pages.admins.product.productedit', compact('category','categoryDetail','products', 'producsimage'));
    }

    public function update(Request $request, $id){
        $update = [
            'product_name' => $request->product_name,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'weight' => $request->weight,
        ];
        Product::where('id', $id)->update($update);

        ProductCategorysDetails::where('product_id','=',$id)->delete();
        $kategoridata = $request->category_id;
        foreach($kategoridata as $category){
            $categoryDetail = new ProductCategorysDetails;
            $categoryDetail->product_id = $id;
            $categoryDetail->category_id = $category;
            $categoryDetail->save();
        }
        return Redirect::to('/admins/products');
    }

    public function delete($id){
        Product::where('id', $id)->delete();
        return Redirect::to('/admins/products');
    }

    public function show($id){
        $where = array('products.id' => $id);
    	$products['products'] = DB::table('products')
            ->join('product_category_details', 'products.id','=','product_category_details.product_id')
            ->join('product_categories', 'product_categories.id','=','product_category_details.category_id')
            ->select('products.*','product_categories.category_name')
            ->where($where)->first();
        $image = DB::table('products')
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->select('product_images.*')
            ->where($where)->get();
        $categories = DB::table('product_categories')
            ->join('product_category_details', 'product_categories.id', '=', 'product_category_details.category_id')
            ->join('products', 'products.id', '=', 'product_category_details.product_id')
            ->select('product_categories.category_name')
            ->where('products.id', '=', $id)->get();
        $reviews = DB::table('product_reviews')->join('users', 'users.id', '=', 'product_reviews.user_id')
            ->select('product_reviews.*', 'users.name')->where('product_reviews.product_id', '=',$id)
            ->orderby('product_reviews.id', 'desc')->get();
        $responses = DB::table('response')->select('response.*')->get();
        return view('pages.admins.product.productdetail', compact('products','reviews','responses', 'image','categories','id'));
    }

    // public function uploadImage($id){
    //     $products = Product::find($id);
    //     return view('pages.admins.product.productimage', compact('product','id'));
    // }

    public function upload(Request $request, $id){
        $files = [];
        foreach ($request->file('files') as $file){
            if($file->isValid()){
                $nama_image = time()."_".$file->getClientOriginalName();
                $folder = 'uploads/product_images';
                $file->move($folder,$nama_image);
                $files[] = [
                    'product_id' => $id,
                    'image_name' => $nama_image,
                ];
            }
        }
        ProductImages::insert($files);
        return Redirect::to('/admins/products');
    }

    // public function discount($id){
    //     $products = Product::find($id);
    //     return view('pages.admins.product.dicountcreate', compact('products','id'));
    // }

    // public function addDiscount(Request $request, $id){
    //     $discount = new Discount;
    //     $discount->percentage = $request->percentage;
    //     $discount->product_id = $id;
    //     $discount->start = $request->start;
    //     $discount->end = $request->end;
    //     $discount->save();

    //     return Redirect::to('/admin/discounts/show/'.$id);
    // }

    public function listReviewProduct($id)
    {
        $data = Product::find($id);
        $reviews = $data->product_reviews;
        return view('pages.admins.product.review', compact('data', 'reviews'));
    }

    public function responseReview(Request $request, $id)
    {
        $response = Response::whereProductReviewsId($id)->get();
        if (!$response->count() >= 0 && !$response->count() < 1) {
            return redirect()->back()->with('danger', 'Response hanya dapat sekali.');
        }
        Response::create([
            'product_reviews_id' => $id,
            'admin_id' => Auth()->guard('admins')->id(),
            'content' => $request->content
        ]);

        return redirect()->back()->with('success', 'Response berhasil ditambahkan.');
    }

}
