<?php

use Illuminate\Support\Facades\Route;

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
Route::get('lang/{locale}',function ($locale){
    session(['locale' => $locale]);
    return redirect()->back();
})->name('home');

Auth::routes(['verify' => true]);
Route::get('auth/facebook/redirect/{type}',[App\Http\Controllers\Auth\FbController::class, 'redirectToFacebook'])->name('facebook');
Route::get('auth/facebook/callback',[App\Http\Controllers\Auth\FbController::class, 'facebookAuth'])->name('facebook.callback');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard',[App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/testimonial',[App\Http\Controllers\TestimonialController::class, 'index'])->name('testimonial');
Route::get('/testimonial/image',[App\Http\Controllers\TestimonialController::class, 'all_images'])->name('pictureTestimonial');
Route::get('/testimonial/video',[App\Http\Controllers\TestimonialController::class, 'all_videos'])->name('videoTestimonial');
Route::get('/product/{id}',[App\Http\Controllers\ProductController::class, 'index'])->name('product');
Route::post('/product/recommend/answer',[App\Http\Controllers\ProductController::class, 'answer'])->name('product.answer');

Route::group(['middleware'=>'checkManager','prefix' => 'manager','as' =>'manager.'],function (){
    Route::get('/dashboard', [\App\Http\Controllers\Manager\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/user/list', [\App\Http\Controllers\Manager\UserController::class, 'index'])->name('user.list');
    Route::get('/user/create', [\App\Http\Controllers\Manager\UserController::class, 'create'])->name('user.create');
    Route::get('/user/{id}/edit', [\App\Http\Controllers\Manager\UserController::class, 'edit'])->name('user.edit');
});

Route::group(['middleware'=>'checkAdmin','prefix' => 'admin','as' =>'admin.'],function (){
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [\App\Http\Controllers\ProfileController::class, 'update_admin'])->name('profile.update');
    Route::post('/getSetting', [\App\Http\Controllers\Admin\SettingController::class, 'getSetting'])->name('getSetting');
    Route::post('/changeSetting', [\App\Http\Controllers\Admin\SettingController::class, 'change'])->name('changeSetting');

    Route::post('/user/update', [\App\Http\Controllers\Manager\UserController::class, 'update'])->name('user.update');
    Route::post('/user/delete', [\App\Http\Controllers\Manager\UserController::class, 'delete'])->name('user.delete');

    Route::get('/customer/list', [\App\Http\Controllers\Manager\UserController::class, 'customer_index'])->name('customer.list');
    Route::get('/customer/{id}/edit', [\App\Http\Controllers\Manager\UserController::class, 'customer_edit'])->name('customer.edit');
    Route::get('/customer/{id}/edit_referral', [\App\Http\Controllers\Manager\UserController::class, 'referral_edit'])->name('customer.edit_referral');
    Route::get('/customer/{id}/edit_credit', [\App\Http\Controllers\Manager\UserController::class, 'credit_edit'])->name('customer.edit_credit');

    Route::get('/product/list', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('product.list');
    Route::get('/product/create', [\App\Http\Controllers\Admin\ProductController::class, 'create'])->name('product.create');
    Route::get('/product/import', [\App\Http\Controllers\Admin\ProductController::class, 'import'])->name('product.import');
    Route::post('/product/import/excel', [\App\Http\Controllers\Admin\ProductController::class, 'import_excel'])->name('product.importExcel');
    Route::get('/product/{id}/edit', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('product.update');
    Route::post('/product/delete', [\App\Http\Controllers\Admin\ProductController::class, 'delete'])->name('product.delete');

    Route::get('/category/list', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category.list');
    Route::get('/category/create', [\App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('category.create');
    Route::get('/category/{id}/edit', [\App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update', [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('category.update');
    Route::post('/category/delete', [\App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('category.delete');

    Route::get('/product/list', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('product.list');
    Route::get('/product/create', [\App\Http\Controllers\Admin\ProductController::class, 'create'])->name('product.create');
    Route::get('/product/{id}/edit', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('product.update');
    Route::post('/product/delete', [\App\Http\Controllers\Admin\ProductController::class, 'delete'])->name('product.delete');
    Route::get('/product/{id}/testimonials', [\App\Http\Controllers\Admin\ProductController::class, 'view_testimonials'])->name('product.testimonial.view');
    Route::get('/testimonial/{product_id}/create', [\App\Http\Controllers\Admin\ProductController::class, 'create_testimonial'])->name('testimonial.create');
    Route::get('/testimonial/{testimonial_id}/edit', [\App\Http\Controllers\Admin\ProductController::class, 'edit_testimonial'])->name('testimonial.edit');
    Route::post('/testimonial/update', [\App\Http\Controllers\Admin\ProductController::class, 'update_testimonial'])->name('testimonial.update');
    Route::get('/product/recommend', [\App\Http\Controllers\Admin\ProductController::class, 'recommend'])->name('product.recommend');
    Route::post('/product/recommend/save', [\App\Http\Controllers\Admin\ProductController::class, 'save_recommend'])->name('product.recommend.save');
    Route::post('/product/recommend/get', [\App\Http\Controllers\Admin\ProductController::class, 'get_recommend'])->name('product.recommend.get');


    Route::get('/productbundel/list', [\App\Http\Controllers\Admin\ProductbundelController::class, 'index'])->name('productbundel.list');
    Route::get('/productbundel/change', [\App\Http\Controllers\Admin\ProductbundelController::class, 'change'])->name('productbundel.change');
    Route::get('/productbundel/categoryitem', [\App\Http\Controllers\Admin\ProductbundelController::class, 'index'])->name('productbundel.categoryitem');
    Route::get('/productbundel/create', [\App\Http\Controllers\Admin\ProductbundelController::class, 'create'])->name('productbundel.create');
    Route::post('/productbundel/update', [\App\Http\Controllers\Admin\ProductbundelController::class, 'update'])->name('productbundel.update');
    Route::get('/productbundel/{id}/edit', [\App\Http\Controllers\Admin\ProductbundelController::class, 'edit'])->name('productbundel.edit');
    Route::post('/productbundel/delete',    [\App\Http\Controllers\Admin\ProductbundelController::class, 'delete'])->name('productbundel.delete');
    Route::get('/productbundel/import', [\App\Http\Controllers\Admin\ProductbundelController::class, 'import'])->name('productbundel.import');
    Route::get('/productbundel/track/{id}', [\App\Http\Controllers\Admin\ProductbundelController::class, 'track'])->name('productbundel.track');
    Route::post('/productbundel/import/excel', [\App\Http\Controllers\Admin\ProductbundelController::class, 'import_excel'])->name('productbundel.importExcel');

    Route::get('/credipoint/list', [\App\Http\Controllers\Admin\CreditpointController::class, 'index'])->name('creditpoint.list');
    Route::get('/creditpoint/create', [\App\Http\Controllers\Admin\CreditpointController::class, 'create'])->name('creditpoint.create');
    Route::post('/creditpoint/update', [\App\Http\Controllers\Admin\CreditpointController::class, 'update'])->name('creditpoint.update');
    Route::get('/creditpoint/{id}/edit', [\App\Http\Controllers\Admin\CreditpointController::class, 'edit'])->name('creditpoint.edit');
    Route::post('/creditpoint/delete',    [\App\Http\Controllers\Admin\CreditpointController::class, 'delete'])->name('creditpoint.delete');
    Route::get('/creditpoint/import',    [\App\Http\Controllers\Admin\CreditpointController::class, 'import'])->name('creditpoint.import');


    Route::get('/promocode/list', [\App\Http\Controllers\Admin\PromoCodeController::class, 'index'])->name('promoCode.list');
    Route::get('/promocode/create', [\App\Http\Controllers\Admin\PromoCodeController::class, 'create'])->name('promoCode.create');
    Route::get('/promocode/{id}/edit', [\App\Http\Controllers\Admin\PromoCodeController::class, 'edit'])->name('promoCode.edit');
    Route::post('/promocode/update', [\App\Http\Controllers\Admin\PromoCodeController::class, 'update'])->name('promoCode.update');
    Route::post('/promocode/delete', [\App\Http\Controllers\Admin\PromoCodeController::class, 'delete'])->name('promoCode.delete');
    Route::get('/promocode/import', [\App\Http\Controllers\Admin\PromoCodeController::class, 'import'])->name('promoCode.import');
    Route::post('/promocode/import/excel', [\App\Http\Controllers\Admin\PromoCodeController::class, 'import_excel'])->name('promoCode.importExcel');
    Route::get('/promocode/track/{id}', [\App\Http\Controllers\Admin\PromoCodeController::class, 'track'])->name('promoCode.track');


    Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('order.index');
    Route::post('/orders/getList', [\App\Http\Controllers\Admin\OrderController::class, 'getOrders'])->name('order.getList');
});

Route::group(['middleware'=>'checkUser','as' =>'customer.'],function (){
    Route::get('/main/{type}',[App\Http\Controllers\Customer\DashboardController::class, 'index']);
    Route::post('/profile/update', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::get('/testimonial/upload',[App\Http\Controllers\TestimonialController::class, 'edit'])->name('testimonial.upload');
    Route::post('/testimonial/save',[App\Http\Controllers\TestimonialController::class, 'save'])->name('testimonial.save');

    Route::get('/product/add_to_cart/{product_id}',[App\Http\Controllers\ProductController::class, 'addToCart'])->name('product.addToCart');
    Route::get('/main/{type}',[App\Http\Controllers\Customer\DashboardController::class, 'index']);
    Route::get('/dashboard/cupon',[App\Http\Controllers\Customer\DashboardController::class, 'cupon'])->name('dashboard.cupon');
    Route::post('/cart/remove',[App\Http\Controllers\ProductController::class, 'removeCart'])->name('cart.remove');
});
