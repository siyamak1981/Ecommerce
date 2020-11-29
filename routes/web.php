<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
  return view('pages.index');
});

Auth::routes(['verify' => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/change-password', 'App\Http\Controllers\HomeController@changepassword')->name('password.change');
Route::post('/change-password/update', 'App\Http\Controllers\HomeController@updatepassword')->name('user.update.password');
Route::get('/user/logout', 'App\Http\Controllers\HomeController@logout')->name('user.logout');

// // Admin Route
Route::get('/admin/home/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
Route::get('admin', 'App\Http\Controllers\Admin\Auth\LoginController@showLoginForm')->name('admin.show');
Route::post('admin', 'App\Http\Controllers\Admin\Auth\LoginController@login')->name('admin.login');

Route::post('admin/password/email', 'App\Http\Controllers\Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/password/reset', 'App\Http\Controllers\Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::get('admin/password/reset/{token}', 'App\Http\Controllers\Admin\Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin/password/reset', 'App\Http\Controllers\Admin\Auth\ResetPasswordController@reset')->name('admin.password.update');
Route::get('/admin/change/password','App\Http\Controllers\AdminController@ChangePassword')->name('admin.password.change');
Route::post('/admin/password/update','App\Http\Controllers\AdminController@Update_pass')->name('admin.update.password'); 
Route::get('admin/logout', 'App\Http\Controllers\AdminController@logout')->name('admin.logout');

// Admin Dashboard
Route::group(['namespace' => 'App\Http\Controllers\Admin'], function () {
Route::resource('admin/category', 'Category\CategoryController');
Route::resource('admin/subcategory', 'Category\SubCategoryController');
Route::resource('admin/brand', 'Brand\BrandController');
Route::resource('admin/coupon', 'Coupon\CouponController');
Route::resource('admin/product', 'Product\ProductController', [
  'except' => ['update']]);
Route::get('get/subcategory/{category_id}', 'Product\ProductController@GetSubcat');// For Show Sub category with ajax
Route::get('inactive/product/{id}', 'Product\ProductController@inactive');
Route::get('active/product/{id}', 'Product\ProductController@active');
Route::post('update/product/withoutphoto/{id}', 'Product\ProductController@UpdateProductWithoutPhoto');
Route::post('update/product/photo/{id}', 'Product\ProductController@UpdateProductPhoto');

Route::resource('admin/newslater', 'Newslater\NewslaterController', [
  'except' => ['edit', 'update','show','store','create']]);
});

// Blog Admin All
Route::group(['namespace' => 'App\Http\Controllers\Admin\Post'], function () {
Route::get('blog/category/list', 'PostController@BlogCatList')->name('add.blog.categorylist');
Route::post('admin/store/blog', 'PostController@BlogCatStore')->name('store.blog.category');
Route::get('delete/blogcategory/{id}', 'PostController@DeleteBlogCat');
Route::get('edit/blogcategory/{id}', 'PostController@EditBlogCat');
Route::post('update/blog/category/{id}', 'PostController@UpdateBlogCat');
Route::get('admin/add/post', 'PostController@Create')->name('add.blogpost');
Route::get('admin/all/post', 'PostController@index')->name('all.blogpost');
Route::post('admin/store/post', 'PostController@store')->name('store.post');
Route::get('delete/post/{id}', 'PostController@DeletePost');
Route::get('edit/post/{id}', 'PostController@EditPost');
Route::post('update/post/{id}', 'PostController@UpdatePost');

});

// Frontend All Routes
Route::group(['namespace' => 'App\Http\Controllers\Frontend'], function () {
// Add to Cart Route 
Route::get('add/to/cart/{id}', 'CartController@AddCart');
Route::get('product/cart', 'CartController@ShowCart')->name('show.cart');
Route::get('remove/cart/{rowId}', 'CartController@removeCart');
Route::post('update/cart/item/', 'CartController@UpdateCart')->name('update.cartitem');
Route::get('/cart/product/view/{id}', 'CartController@ViewProduct');
Route::post('insert/into/cart/', 'CartController@insertCart')->name('insert.into.cart');
Route::get('user/checkout/', 'CartController@Checkout')->name('user.checkout');
Route::get('user/wishlist/', 'CartController@wishlist')->name('user.wishlist');
Route::post('user/apply/coupon/', 'CartController@Coupon')->name('apply.coupon');
Route::get('coupon/remove/', 'CartController@CouponRemove')->name('coupon.remove');
Route::get('check', 'CartController@check');
// Add to Product Route 
Route::get('product/details/{id}/{product_name}', 'ProductController@ProductView');
Route::post('/cart/product/add/{id}', 'ProductController@AddCart');
Route::post('store/newslater', 'NewslaterController@StoreNewslater')
->name('store.newslater');
// ADD Wishlist
Route::get('add/wishlist/{id}', 'WishlistController@addWishlist');
/// Blog Post Route 
Route::get('blog/post/', 'BlogController@blog')->name('blog.post');
Route::get('language/english', 'BlogController@English')->name('language.english');
Route::get('language/farsi', 'BlogController@Farsi')->name('language.farsi');
Route::get('blog/single/{id}', 'BlogController@BlogSingle');
});