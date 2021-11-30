<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ClientController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PdfController;


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


Route::get('/admin',[AdminController::class,'Admin'])->name('admin');
Route::get('add/category/',[CategoryController::class,'AddCategory'])->name('add.category');
Route::get('view/category/',[CategoryController::class,'ViewCategory'])->name('view.category');
Route::post('store/category/',[CategoryController::class,'StoreCategory'])->name('store.category');
Route::get('edit/category/{id}',[CategoryController::class,'EditCategory'])->name('edit.category');
Route::post('update/category/{id}',[CategoryController::class,'UpdateCategory'])->name('update.category');
Route::get('delete/category/{id}',[CategoryController::class,'DeleteCategory'])->name('delete.category');

Route::get('add/product/',[ProductController::class,'AddProduct'])->name('add.product');
Route::get('view/product/',[ProductController::class,'ViewProduct'])->name('view.product');
Route::post('store/product/',[ProductController::class,'StoreProduct'])->name('store.product');
Route::get('edit/product/{id}',[ProductController::class,'EditProduct'])->name('edit.product');
Route::post('update/product/{id}',[ProductController::class,'UpdateProduct'])->name('update.product');
Route::get('delete/product/{id}',[ProductController::class,'DeleteProduct'])->name('delete.product');
Route::get('activate/product/{id}',[ProductController::class,'ActivateProduct'])->name('activate.product');

Route::get('view/productbyname/{category_id}',[ProductController::class,'ViewProductbyname'])->name('view.productbyname');


Route::get('view/order/',[ClientController::class,'orders'])->name('view.order');

Route::get('add/slider/',[SliderController::class,'Addslider'])->name('add.slider');
Route::get('view/slider/',[SliderController::class,'Viewslider'])->name('view.slider');
Route::get('edit/slider/{id}',[SliderController::class,'Editslider'])->name('edit.slider');
Route::post('store/slider/',[SliderController::class,'Storeslider'])->name('store.slider');
Route::get('delete/slider/{id}',[SliderController::class,'Deleteslider'])->name('delete.slider');
Route::get('activate/slider/{id}',[SliderController::class,'Activateslider'])->name('activate.slider');
Route::post('update/slider/{id}',[SliderController::class,'Updateslider'])->name('update.slider');

Route::get('viewpdforder/{id}', [PdfController::class,'VIEW'])->name('pdf');




Route::get('/',[ClientController::class,'Home'])->name('home');
Route::get('/shop',[ClientController::class,'Shop'])->name('shop');
Route::get('/addtocart/{id}',[ClientController::class,'addtocart'])->name('addtocart');
Route::post('/updatecart/{id}',[ClientController::class,'updatecart'])->name('updatecart');
Route::get('/removeproduct/{id}',[ClientController::class,'removeproduct'])->name('removeproduct');
Route::get('/cart',[ClientController::class,'Cart'])->name('cart');
Route::get('/checkout',[ClientController::class,'Checkout'])->name('checkout');
Route::get('/login',[ClientController::class,'Login'])->name('login');
Route::get('/logout',[ClientController::class,'Logout'])->name('logout');
Route::get('/register',[ClientController::class,'Register'])->name('register');
Route::post('/signup',[ClientController::class,'signup'])->name('signup');
Route::post('/createaccount',[ClientController::class,'CreateAccount'])->name('createaccount');

Route::post('/accessaccount',[ClientController::class,'accessaccount'])->name('accessaccount');
Route::post('/postcheckout',[ClientController::class,'postcheckout'])->name('postcheckout');

//Route::get('/dashboard', function () {
    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
