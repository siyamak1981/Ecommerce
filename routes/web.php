<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
  return view('pages.index');
});
Route::get('/auth/redirect/{provider}', 'App\Http\Controllers\Frontend\SocialController@redirect');
Route::get('/callback/{provider}', 'App\Http\Controllers\Frontend\SocialController@callback');

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
Route::get('/admin/change/password', 'App\Http\Controllers\AdminController@ChangePassword')->name('admin.password.change');
Route::post('/admin/password/update', 'App\Http\Controllers\AdminController@Update_pass')->name('admin.update.password');
Route::get('admin/logout', 'App\Http\Controllers\AdminController@logout')->name('admin.logout');

// Admin Dashboard
Route::group(['namespace' => 'App\Http\Controllers\Admin'], function () {
  Route::resource('admin/category', 'Category\CategoryController');
  Route::resource('admin/subcategory', 'Category\SubCategoryController');
  Route::resource('admin/brand', 'Brand\BrandController');
  Route::resource('admin/coupon', 'Coupon\CouponController');
  Route::resource('admin/product', 'Product\ProductController', [
    'except' => ['update']
  ]);
  Route::get('get/subcategory/{category_id}', 'Product\ProductController@GetSubcat'); // For Show Sub category with ajax
  Route::get('inactive/product/{id}', 'Product\ProductController@inactive');
  Route::get('active/product/{id}', 'Product\ProductController@active');
  Route::post('update/product/withoutphoto/{id}', 'Product\ProductController@UpdateProductWithoutPhoto');
  Route::post('update/product/photo/{id}', 'Product\ProductController@UpdateProductPhoto');
  Route::resource('admin/newslater', 'Newslater\NewslaterController', [
    'except' => ['edit', 'update', 'show', 'store', 'create']
  ]);
  // Admin Order Route
  Route::get('admin/pading/order', 'Order\OrderController@NewOrder')->name('admin.neworder');
  Route::get('admin/view/order/{id}', 'Order\OrderController@ViewOrder');
  Route::get('admin/payment/accept/{id}', 'Order\OrderController@PaymentAccept');
  Route::get('admin/payment/cancel/{id}', 'Order\OrderController@PaymentCancel');
  Route::get('admin/accept/payment', 'Order\OrderController@AcceptPayment')->name('admin.accept.payment');
  Route::get('admin/cancel/order', 'Order\OrderController@CancelOrder')->name('admin.cancel.order');
  Route::get('admin/process/payment', 'Order\OrderController@ProcessPayment')->name('admin.process.payment');
  Route::get('admin/success/payment', 'Order\OrderController@SuccessPayment')->name('admin.success.payment');
  Route::get('admin/delevery/process/{id}', 'Order\OrderController@DeleveryProcess');
  Route::get('admin/delevery/done/{id}', 'Order\OrderController@DeleveryDone');
  /// SEO Setting Route
  Route::get('admin/seo', 'Order\OrderController@seo')->name('admin.seo');
  Route::post('admin/seo/update', 'Order\OrderController@UpdateSeo')->name('update.seo');
  // Order Report Routes 
  Route::get('admin/today/order', 'Report\ReportController@TodayOrder')->name('today.order');
  Route::get('admin/today/delivery', 'Report\ReportController@TodayDelivery')->name('today.delivery');
  Route::get('admin/this/month', 'Report\ReportController@ThisMonth')->name('this.month');
  Route::get('admin/search/report', 'Report\ReportController@Search')->name('search.report');
  Route::post('admin/search/by/year', 'Report\ReportController@SearchByYear')->name('search.by.year');
  Route::post('admin/search/by/month', 'Report\ReportController@SearchByMonth')->name('search.by.month');
  Route::post('admin/search/by/date', 'Report\ReportController@SearchByDate')->name('search.by.date');
  Route::get('admin/return/request/', 'BackOrder\ReturnController@ReturnRequest')->name('admin.return.request');
  Route::get('admin/approve/return/{id}', 'BackOrder\ReturnController@ApproveReturn');
  Route::get('admin/all/return/', 'BackOrder\ReturnController@AllReturn')->name('admin.all.return');
  Route::get('admin/stock/show', 'BackOrder\ReturnController@ProductStock')->name('admin.product.stock');
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
  // Order Tracking Route
  Route::post('order/traking', 'NewslaterController@OrderTraking')->name('order.tracking');
  // ADD Wishlist
  Route::get('add/wishlist/{id}', 'WishlistController@addWishlist');
  /// Blog Post Route 
  Route::get('blog/post/', 'BlogController@blog')->name('blog.post');
  Route::get('language/english', 'BlogController@English')->name('language.english');
  Route::get('language/farsi', 'BlogController@Farsi')->name('language.farsi');
  Route::get('blog/single/{id}', 'BlogController@BlogSingle');
  // Pyment Step 
  Route::get('payment/page', 'CartController@PaymentPage')->name('payment.step');
  // Search Route
  Route::post('product/search', 'CartController@Search')->name('product.search');
  Route::post('user/payment/process/', 'PaymentController@Payment')->name('payment.process');
  Route::post('user/stripe/charge/', 'PaymentController@StripeCharge')->name('stripe.charge');
  Route::post('user/oncash/charge/', 'PaymentController@OnCash')->name('oncash.charge');
  Route::get('success/list/', 'PaymentController@SuccessList')->name('success.orderlist');
  Route::get('request/return/{id}', 'PaymentController@RequestReturn');
  Route::get('products/{id}', 'ProductController@ProductsView')->name('products.view.pag');
  Route::get('allcategory/{id}', 'ProductController@CategoryView');
  // Contact
  Route::get('contact/page', 'ContactController@Contact')->name('contact.page');
  Route::post('contact/form', 'ContactController@ContactForm')->name('contact.form');
  Route::get('admin/all/message', 'ContactController@AllMessage')->name('all.message');
});



// Admin Role Routes 
Route::group(['namespace' => 'App\Http\Controllers\Admin\Role'], function () {
  Route::get('admin/all/user', 'UserRoleController@UserRole')->name('admin.all.user');
  Route::get('admin/create/admin', 'UserRoleController@UserCreate')->name('create.admin');
  Route::post('admin/store/admin', 'UserRoleController@UserStore')->name('store.admin');
  Route::get('delete/admin/{id}', 'UserRoleController@UserDelete');
  Route::get('edit/admin/{id}', 'UserRoleController@UserEdit');
  Route::post('admin/update/admin', 'UserRoleController@UserUpdate')->name('update.admin');
});
// Admin Site Setting Route 
Route::get('admin/site/setting', 'App\Http\Controllers\Admin\Setting\SettingController@SiteSetting')->name('admin.site.setting');
Route::post('admin/sitesetting', 'App\Http\Controllers\Admin\Setting\SettingController@UpdateSiteSetting')->name('update.sitesetting');
