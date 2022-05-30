<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ProductUserController;
use App\Http\Controllers\User\OrderUserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Admin\TransactionResourceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\CourierController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return redirect()->route('user.homepage');
});

Auth::routes();


// User
Route::prefix('user')->name('user.')->group(function(){
    // Route::get('/homepage', [UserController::class, 'index'])->name('index');
    Route::view('/homepage','landingpage.user.homepage')      ->name('homepage');
    Route::view('/collections','landingpage.user.collections')->name('collections');
    Route::view('/about','landingpage.user.about')            ->name('about');
    
    // Sebelum Login
    Route::middleware(['guest:web'])->group(function(){
        Route::view('/login',   'landingpage.user.login')                      ->name('login');
        Route::view('/register','landingpage.user.register')                   ->name('register');
        Route::post('/create',  [UserController::class, 'create'])             ->name('create');
        Route::get('/email',    [EmailController::class, 'email'])             ->name('email');
        Route::get('/verify',   [UserController::class, 'verify'])             ->name('verify');
        Route::post('/doLogin', [UserController::class, 'doLogin'])            ->name('doLogin');
        Route::view('/forgot-password','landingpage.user.forgot-password')     ->name('forgot-password');
        Route::post('/request-reset', [UserController::class, 'request_reset'])->name('request-reset');
        Route::get('/reset', [EmailController::class, 'reset'])                ->name('reset');
        Route::get('/verify-reset', [UserController::class, 'verify_reset'])   ->name('verify-reset');
        Route::post('/save-reset',  [UserController::class, 'save_reset'])     ->name('save-reset');
    });
    
    // Setelah Login
    Route::middleware(['auth:web'])->group(function(){
        Route::get('/home', [UserController::class, 'index']) ->name('home');
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
        Route::get('product/{product}', [ProductUserController::class, 'show'])->name('product.show');
        Route::post('product/{product}/review', [ProductUserController::class, 'storeReview'])->name('review.store');
        Route::get('product/{product}/buy-now', [ProductUserController::class, 'buyNow'])->name('product.buynow');
        Route::get('payment/{transaction}', [TransactionController::class, 'payment'])->name('payment');
        Route::post('payment/{transaction}/proof_payment', [TransactionController::class, 'uploadProofPayment'])->name('proof_payment');
        Route::post('payment/{transaction}', [TransactionController::class, 'deleteTransaction'])->name('delete-transaction');
        Route::view('cart', 'users.cart.index')->name('cart');
        Route::view('checkout', 'users.transaction.checkout')->name('checkout');
        Route::get('my-transaction', [OrderUserController::class, 'index'])->name('my-transaction');
    });

});

// Admin
Route::prefix('admins/')->name('admins.')->group(function () {
    Route::get('/', function() { 
        return redirect()->route('admins.login');
    });
    
    Route::middleware('guest')->group(function () { 
        Route::get('login', [AdminController::class, 'index'])->name('login-index');
        Route::post('login', [AdminController::class, 'login'])->name('login');
  });
    // Sebelum Login
    // Route::middleware(['guest:admin'])->group(function(){
    //     Route::view('/login','landingpage.admin.login')                         ->name('login');
    //     Route::view('/register','landingpage.admin.register')                   ->name('register');
    //     Route::post('/create',  [AdminController::class, 'create'])             ->name('create');
    //     Route::get('/email',    [EmailController::class, 'admin_email'])        ->name('email');
    //     Route::get('/verify',   [AdminController::class, 'verify'])             ->name('verify');
    //     Route::post('/doLogin', [AdminController::class, 'doLogin'])            ->name('doLogin');
    //     Route::view('/forgot-password','landingpage.admin.forgot-password')     ->name('forgot-password');
    //     Route::post('/request-reset', [AdminController::class, 'request_reset'])->name('request-reset');
    //     Route::get('/reset',        [EmailController::class, 'admin_reset'])    ->name('reset');
    //     Route::get('/verify-reset', [AdminController::class, 'verify_reset'])   ->name('verify-reset');
    //     Route::post('/save-reset',  [AdminController::class, 'save_reset'])     ->name('save-reset');
    // });
    
    // Setelah Login
    Route::middleware('auth:admins')->group(function () {
        Route::post('logout', [AdminController::class, 'logout'])->name('logout');
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
  });


  Route::get('categories', [CategoryController::class, 'index']);
  Route::get('categories/create', [CategoryController::class, 'create']);
  Route::post('categories/store', [CategoryController::class, 'store']);
  Route::get('categories/edit/{id}', [CategoryController::class, 'edit']);
  Route::post('categories/update/{id}', [CategoryController::class, 'update']);
  Route::get('categories/delete/{id}', [CategoryController::class, 'delete']);
  
  Route::get('products', [ProductController::class, 'index']);
  Route::get('products/create', [ProductController::class, 'create']);
  Route::post('products/store', [ProductController::class, 'store']);
  Route::get('products/show/{id}', [ProductController::class, 'show']);
  Route::get('products/edit/{id}', [ProductController::class, 'edit']);
  Route::post('products/update/{id}', [ProductController::class, 'update']);
  Route::get('products/delete/{id}', [ProductController::class, 'delete']);
  Route::get('/products/{id}/reviews', [ProductController::class, 'listReviewProduct'])->name('product.reviews');
  Route::post('/products/{id}/review-response', [ProductController::class, 'responseReview'])->name('product.review-response');

  Route::get('discounts', [DiscountController::class, 'index']);
  Route::get('discounts/create', [DiscountController::class, 'create']);
  Route::get('discounts/{id}', [DiscountController::class, 'show']);
  Route::post('discounts/store', [DiscountController::class, 'store']);
  Route::get('discounts/edit/{id}', [DiscountController::class, 'edit']);
  Route::post('discounts/update/{id}', [DiscountController::class, 'update']);
  Route::get('discounts/delete/{id}', [DiscountController::class, 'delete']);

  Route::get('couriers', [CourierController::class, 'index']);
  Route::get('couriers/create', [CourierController::class, 'create']);
  Route::post('couriers/store', [CourierController::class, 'store']);
  Route::get('couriers/edit/{id}', [CourierController::class, 'edit']);
  Route::post('couriers/update/{id}', [CourierController::class, 'update']);
  Route::get('couriers/delete/{id}', [CourierController::class, 'delete']);

  Route::resource('transaction', TransactionResourceController::class);
  Route::post('transaction/{transaction}/cancel', [TransactionResourceController::class, 'cancelTransaction'])->name('transaction.cancel');
  Route::post('transaction/{transaction}/accept', [TransactionResourceController::class, 'acceptPayment'])->name('transaction.accept');
  Route::post('transaction/{transaction}/shipped', [TransactionResourceController::class, 'updateShipped'])->name('transaction.shipped');

});

