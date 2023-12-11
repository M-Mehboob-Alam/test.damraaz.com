<?php

use App\Http\Controllers\Admin\AdminAuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController as UserOrderController;
use App\Http\Controllers\ProductController as ProductControllerOfUser;
use App\Http\Controllers\WithdrawController;
use App\Http\Controllers\ContactUsController as UserContactUsController;
use App\Http\Controllers\PhoneAuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController as showToUserCategoryController;
use App\Http\Controllers\UserProductController as UserProductControllerInUser;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\PaymentMethodController;

// admin controller

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserDetailController;
use App\Http\Controllers\Admin\WithdrawController as AdminWithdrawController;
use App\Http\Controllers\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\Admin\{ContactUsController, UserProductController, MarqueeController, SliderController};
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\Admin\RatingController as AdminRatingController;
use App\Http\Controllers\BrandingController;
use App\Http\Controllers\ProductBundleController;
use App\Http\Controllers\ShopController;
use League\CommonMark\Extension\SmartPunct\DashParser;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is, where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::view('test','emails.blocked_user');


Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/login', [AdminAuthController::class, 'getLogin'])->name('adminLogin');
    Route::post('/login', [AdminAuthController::class, 'postLogin'])->name('adminLoginPost');
});

Route::get('/view_receipt/{filename}', [App\Http\Controllers\Admin\OrderController::class, 'view_receipt'])->name('view_receipt');
    // Route::get('/view_receipt/filename', function ($filename) {
Route::group(['prefix' => 'admin', 'as' => 'admin.',  'middleware' => 'auth:admin'], function () {
    // Route::view('dashboard','admin');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('category', CategoryController::class);
    Route::resource('product', AdminProductController::class);
    Route::get('admin/delete/{product}/{image}', [AdminProductController::class, 'deleteProductImage'])->name('deleteProductImage');
    Route::resource('slider', SliderController::class);

    Route::get('all/mega/sales/products', [AdminProductController::class, 'allMegaSalesProducts'])->name('megaSales');
    Route::get('add/remove/to/mega/sale/product/{product}', [AdminProductController::class, 'adminAddRemoveToMegaSale'])->name('adminAddRemoveToMegaSale');
    // branding
    Route::get('create/new/branding', [BrandingController::class, 'create'])->name('create.branding');
    Route::get('create/new/product/branding', [BrandingController::class, 'createNewProduct'])->name('branding.createNewProduct');
    Route::post('store/new/product/branding', [BrandingController::class, 'storeNewProduct'])->name('branding.storeNewProduct');
    Route::get('edit/branding/{id}', [BrandingController::class, 'edit'])->name('branding.edit');
    Route::get('view/branding/{id}', [BrandingController::class, 'view'])->name('branding.view');
    Route::get('delete/branding/{id}', [BrandingController::class, 'delete'])->name('branding.destroy');
    Route::post('store/create/new/branding', [BrandingController::class, 'store'])->name('store.branding');
    Route::post('update/branding', [BrandingController::class, 'update'])->name('branding.update');
    Route::get('all/branding', [BrandingController::class, 'index'])->name('index.branding');

    // branding withdraw
    Route::post('add/branding/payment/type', [BrandingController::class, 'addBrandingPaymentType'])->name('addBrandingPaymentType');
    Route::post('withdraw/branding/payment', [BrandingController::class, 'withdrawBrandingPayment'])->name('withdrawBrandingPayment');
    Route::post('update/withdraw/branding/payment', [BrandingController::class, 'updateWithdrawBrandingPayment'])->name('updateWithdrawBrandingPayment');
    Route::get('delete/branding/withdraw/{withdraw}', [BrandingController::class, 'deleteWithdrawBrandingPayment'])->name('deleteWithdrawBrandingPayment');
    //
    Route::get('/profile', [AdminHomeController::class, 'profile'])->name('profile');
    Route::post('/change-your-password', [AdminHomeController::class, 'password_change'])->name('change.password');

    // user
    Route::get('/all-users', [UserDetailController::class, 'user'])->name('user.index');
    Route::get('/block-un-block-user/{user_id}', [UserDetailController::class, 'deleted_at'])->name('user.deleted_at');
    Route::get('/user/details/{user}', [UserDetailController::class, 'userDetails'])->name('user.detail');
    Route::get('/users/bonus', [UserDetailController::class, 'usersBonus'])->name('users.bonus');
    Route::post('/user/details-update', [UserDetailController::class, 'updateUser'])->name('user.detail.update');
    Route::post('/user/password-update/{id}', [UserDetailController::class, 'changeUserPassword'])->name('user.password.update');

    Route::get('search/user/data', [UserDetailController::class, 'search_data'])->name('search_data');

    Route::get('check/username', [UserDetailController::class, 'checkUsername'])->name('checkUsername');
    Route::get('check/Email', [UserDetailController::class, 'checkEmail'])->name('checkEmail');
    Route::get('check/Phone', [UserDetailController::class, 'checkPhone'])->name('checkPhone');
    Route::get('check/Whatsapp', [UserDetailController::class, 'checkWhatsapp'])->name('checkWhatsapp');

    Route::post('update/username', [UserDetailController::class, 'updateUsername'])->name('updateUsername');
    Route::post('update/Email', [UserDetailController::class, 'updateEmail'])->name('updateEmail');
    Route::post('update/Phone', [UserDetailController::class, 'updatePhone'])->name('updatePhone');
    Route::post('update/Whatsapp', [UserDetailController::class, 'updateWhatsapp'])->name('updateWhatsapp');

    // orders
    Route::get('/all/{order}/return-order', [OrderController::class, 'returnOrder'])->name('orders.returnOrder');
    Route::get('/all/{orders}/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/all/stpped/bundle/payments/{status}', [ProductBundleController::class, 'stoppedBundlePayments'])->name('orders.stoppedBundlePayments');
    Route::get('/change/status/{id}', [ProductBundleController::class, 'changeStatusStoppedBundlePayments'])->name('changeStatusStoppedBundlePayments');
    Route::get('/view/orders/{order}', [OrderController::class, 'viewOrder'])->name('view.order');
    Route::get('/view/return-orders/{order}', [OrderController::class, 'viewReturnOrder'])->name('view.ReturnOrder');
    Route::get('/change/orders/status/{order}', [OrderController::class, 'changeOrderStatus'])->name('view.order.status');
    Route::post('/change/orders/status', [OrderController::class, 'markAs'])->name('view.order.marked');
    Route::get('/change/return-orders/status/{order}', [OrderController::class, 'changeReturnStatus'])->name('view.changeReturnStatus.status');
    Route::post('/change/return-orders/status', [OrderController::class, 'markAsReturnOrder'])->name('view.order.markAsReturnOrder');

    //     $filePath = public_path('payment_ss') . '/' . $filename;
    //     if (!file_exists($filePath)) {
    //         return response()->json(['error' => 'File not found.'], 404);
    //     }
    //     $fileContent = file_get_contents($filePath);
    //     $mimeType = mime_content_type($filePath);

    //     return response($fileContent)
    //         ->header('Content-Type', $mimeType);
    // });
    // withdraw
    Route::get('/all/{withdraws}/withdraws', [AdminWithdrawController::class, 'index'])->name('withdraws.index');
    Route::get('/view/withdraws/{withdraw}', [AdminWithdrawController::class, 'viewWithdraw'])->name('view.withdraw');
    Route::get('/change/withdraws/status/{withdraw}', [AdminWithdrawController::class, 'changewithdrawstatus'])->name('view.withdraw.status');
    Route::post('/change/withdraws/status', [AdminWithdrawController::class, 'markAs'])->name('view.withdraw.marked');

    // comission
    Route::post('add/user/commission', [UserDetailController::class, 'addCommission'])->name('user.add.commission');
    Route::post('change/user/commission', [UserDetailController::class, 'changeCommission'])->name('user.change.commission');
    Route::post('change/user/referral/commission', [UserDetailController::class, 'changeReferralCommission'])->name('user.referral.commission');
    Route::post('change/user/sale-commission', [UserDetailController::class, 'changeSaleCommission'])->name('user.change.sale.commission');
    Route::get('delete/user/commission/{commission}', [UserDetailController::class, 'deleteCommission'])->name('user.delete.commission');
    Route::get('delete/user/referral/commission/{commission}', [UserDetailController::class, 'deleteReferralCommission'])->name('user.delete.referral.commission');
    Route::get('delete/user/sale-commission/{commission}', [UserDetailController::class, 'deleteSaleCommission'])->name('user.delete.sale.commission');

    // contact us

    Route::get('contact', [ContactUsController::class, 'index'])->name('contact');
    Route::post('contact/save/{id}', [ContactUsController::class, 'contact'])->name('contact.save');
    Route::get('contacted', [ContactUsController::class, 'contacted'])->name('contacted');
    // user products
    Route::get('user-product/{status}', [UserProductController::class, 'pending'])->name('userProduct.index');
    Route::get('all/inactive/products', [UserProductController::class, 'inActiveProducts'])->name('products.inActive');
    Route::post('user-product/{id}', [UserProductController::class, 'acceptOrRejectProduct'])->name('userProduct.upload');

    // marquee(news feed)
    Route::get('news', [MarqueeController::class, 'index'])->name('marquee.index');
    Route::post('news-update', [MarqueeController::class, 'update'])->name('marquee.update');
    // Shops
    Route::get('new/shop/requests', [AdminHomeController::class, 'newShop'])->name('newShop');
    Route::get('all/shops/{shop}', [AdminHomeController::class, 'allShops'])->name('allShops');
    Route::get('change/mega/sale/status/{shop}', [AdminHomeController::class, 'changeMegaSaleStatus'])->name('changeMegaSaleStatus');
    Route::get('view/shop/{shop}', [AdminHomeController::class, 'viewShopDetail'])->name('viewShopDetail');
    Route::post('approved/new/shop', [AdminHomeController::class, 'approvedNewShop'])->name('approvedNewShop');



    Route::get('/notifications', [AdminNotificationController::class, 'index'])->name('notifications');
    Route::get('/notification/mark-read/{id}', [AdminNotificationController::class, 'markOne'])->name('markOneRead');
    Route::get('/notifications/mark-all-read', [AdminNotificationController::class, 'markAll'])->name('markAllRead');
    Route::get('/send-notification-to-users', [AdminNotificationController::class, 'create'])->name('notification.create');
    Route::post('/post-notification-to-users', [AdminNotificationController::class, 'notifications'])->name('notification.store');
    Route::get('/view-notification-for-users', [AdminNotificationController::class, 'forUser'])->name('notification.forUser.view');
    Route::get('/ratings', [AdminRatingController::class, 'index'])->name('rating.index');
    // Shop Accounts
    Route::get('/view_accounts', [PaymentMethodController::class, 'view_accounts'])->name('view_accounts');
    Route::post('/change/account', [PaymentMethodController::class, 'store'])->name('store_accounts');
    Route::get('account_toggle/{id}', [PaymentMethodController::class, 'toggle'])->name('account_toggle');
    // Bundle Accounts
    Route::get('bundles/view_accounts', [PaymentMethodController::class, 'view_accounts_bundle'])->name('view_accounts_bundle');
    Route::post('bundles/change/account', [PaymentMethodController::class, 'store_bundle'])->name('store_accounts_bundle');
    Route::get('bundles/account_toggle/{id}', [PaymentMethodController::class, 'toggle_bundle'])->name('account_toggle_bundle');

    Route::get('view/store/information', [DashboardController::class, 'viewStoreInformation'])->name('viewStoreInformation');
    Route::post('upload/store/information', [DashboardController::class, 'uploadStoreInformation'])->name('uploadStoreInformation');

    // Whatsapp
    Route::get('view/store/whatsapp', [DashboardController::class, 'viewStoreWhatsapp'])->name('viewStoreWhatsapp');
    Route::post('upload/store/whatsapp', [DashboardController::class, 'uploadStoreWhatsapp'])->name('uploadStoreWhatsapp');

    // User Individual Details
    Route::get('user/personal/{user}',[UserDetailController::class, 'userPersonalDetail'] )->name('userPersonalDetail');
    Route::get('user/orders/{user}',[UserDetailController::class, 'userOrders'] )->name('userOrders');
    Route::get('user/referral/team/{user}',[UserDetailController::class, 'userReferralTeam'] )->name('userReferralTeam');
    Route::get('user/referral/commission/{user}',[UserDetailController::class, 'userReferralCommission'] )->name('userReferralCommission');
    Route::get('user/commission/{user}',[UserDetailController::class, 'userCommission'] )->name('userCommission');
    Route::get('user/sale/commission/{user}',[UserDetailController::class, 'userSaleCommission'] )->name('userSaleCommission');
    Route::get('user/withdraw/{user}',[UserDetailController::class, 'userWithdraw'] )->name('userWithdraw');
    // delete use
    Route::post('delete/user/details', [UserDetailController::class, 'adminDeleteUser'])->name('adminDeleteUser');
    // payment gateways
    Route::get('view/payment/gateway', [UserDetailController::class, 'paymentGateway'])->name('paymentGateway');
    Route::get('change/payment/gateway/{payment}', [UserDetailController::class, 'changePaymentGateway'])->name('changePaymentGateway');
    // admin product bundles
    Route::get('all/product/bundle', [ProductBundleController::class, 'index'])->name('allProductBundle');
    Route::get('hide/product/bundle{bundle_id}', [ProductBundleController::class, 'hideProductPackage'])->name('hideProductPackage');
    Route::get('hide/product/bundle/detail/{id}', [ProductBundleController::class, 'hideSubProductPackage'])->name('hideSubProductPackage');
    Route::get('view/product/bundle/{bundle_id}', [ProductBundleController::class, 'viewProductBundle'])->name('viewProductBundle');
    Route::delete('view/sub/product/{id}', [ProductBundleController::class, 'deleteSubProduct'])->name('deleteSubProduct');
    Route::get('create/new/product/bundle', [ProductBundleController::class, 'create'])->name('createBundle');
    Route::post('store/new/product/bundle', [ProductBundleController::class, 'store'])->name('storeBundle');
    Route::post('store/new/product/bundle/details', [ProductBundleController::class, 'storeNewProduct'])->name('storeNewProduct');
    Route::post('edit/product/bundle/details', [ProductBundleController::class, 'editSubProductDetail'])->name('editSubProductDetail');
    Route::post('edit/product/bundle', [ProductBundleController::class, 'editBundle'])->name('editBundle');
    Route::get('bundles/level/commissions',[ProductBundleController::class, 'levelCommissionBundle'])->name('levelCommissionBundle');
    Route::post('new/level/commissions',[ProductBundleController::class, 'newLevelCommissionBundle'])->name('newLevelCommissionBundle');
    Route::post('edit/level/commissions',[ProductBundleController::class, 'editLevelCommissionBundle'])->name('editLevelCommissionBundle');
    Route::get('delete/level/commissions/{level}',[ProductBundleController::class, 'deleteLevelCommissionBundle'])->name('deleteLevelCommissionBundle');
    
    Route::get('view/all/order/bundles/{status}', [ProductBundleController::class, 'getBundleOrder'])->name('getBundleOrder');
        
    // bundle orders
    Route::get('bundle/orders/{status}', [ProductBundleController::class, 'bundleOrder'])->name('bundleOrder');
    Route::get('bundle/order/view/{order}', [ProductBundleController::class, 'bundleOrderView'])->name('bundleOrderView');
    Route::get('get/order/view/{order}', [ProductBundleController::class, 'getBundleOrderView'])->name('getBundleOrderView');
    Route::get('change/bundle/order/{order}', [ProductBundleController::class, 'bundleOrderStatus'])->name('bundleOrderStatus');
    Route::get('get/change/bundle/order/{order}', [ProductBundleController::class, 'getBundleOrderStatus'])->name('getBundleOrderStatus');
    Route::post('mark/bundle/order', [ProductBundleController::class, 'bundleMarked'])->name('bundleMarked');
    Route::post('get/mark/bundle/order', [ProductBundleController::class, 'getBundleMarked'])->name('getBundleMarked');
    Route::post('get/mark/stopped/bundle/payment', [ProductBundleController::class, 'getStoppedBundlePaymentMarked'])->name('getStoppedBundlePaymentMarked');
});

Route::view('about-us', 'frontend.aboutUs')->name('frontend.aboutUs');
Route::view('privacy-policy', 'frontend.privacy_policy')->name('frontend.privacy.policy');
Route::view('terms-and-conditions', 'frontend.terms_condition')->name('frontend.terms&condition');
Route::get('/', [UserController::class, 'index'])->name('/');
Route::get('/offers/{offer}', [UserController::class, 'offer'])->name('frontend.product.offer');
Route::get('/product/{id}', [UserController::class, 'product'])->name('product.show');
Route::get('/share-product/{product_id}', [UserController::class, 'share'])->name('user.product.share');
Route::get('/top-product', [UserController::class, 'viewtopProduct'])->name('product.topProduct');
Route::get('/new-product', [UserController::class, 'viewNewProduct'])->name('product.newProduct');
Route::get('/follow-shop/{id}', [UserController::class, 'follow'])->name('shop.follow');


Route::get('check-user', [RegisterController::class, 'userCheck'])->name('userCheck');
Route::get('send-user-points', [ProductBundleController::class, 'otherUserSearching'])->name('otherUserSearching');
Route::post('send/user/points', [ProductBundleController::class, 'sendUserPointToUser'])->name('sendUserPointToUser');
Route::get('bundler-sponsor/checker', [ProductBundleController::class, 'checkBundleSponsor'])->name('checkBundleSponsor');
Route::get('register/{username}', [RegisterController::class, 'referralRegister'])->name('referralRegister');


Route::get('/categories', [showToUserCategoryController::class, 'index'])->name('category.index');
Route::get('/category/{id}', [showToUserCategoryController::class, 'show'])->name('category.show');


Route::get('/all-products', [ProductControllerOfUser::class, 'product'])->name('frontend.all_product');
Route::get('/mega/sales/products', [ProductControllerOfUser::class, 'megaSale'])->name('frontend.megaSale');
Route::get('/view/product/bundles', [ProductBundleController::class, 'productBundles'])->name('frontend.productBundles');
Route::get('cart', [ProductControllerOfUser::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [ProductControllerOfUser::class, 'addToCart'])->name('add.to.cart');
Route::post('direct/place/order', [ProductControllerOfUser::class, 'directPlaceOrder'])->middleware('auth')->name('directPlaceOrder');
Route::patch('update-cart', [ProductControllerOfUser::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [ProductControllerOfUser::class, 'remove'])->name('remove.from.cart');

Route::get('product/bundle/detail/{bundle}', [ProductBundleController::class, 'productBundleDetail'])->name('productBundleDetail');
Route::get('wishlist', [ProductControllerOfUser::class, 'wishlist'])->name('wishlist');
Route::get('add-to-wishlist/{id}', [ProductControllerOfUser::class, 'addToWishlist'])->name('add.to.wishlist');
Route::delete('remove-from-wishlist', [ProductControllerOfUser::class, 'removeWishlist'])->name('remove.from.wishlist');

Route::get('compare', [ProductControllerOfUser::class, 'compare'])->name('compare');
Route::get('add-to-compare/{id}', [ProductControllerOfUser::class, 'addToCompare'])->name('add.to.compare');
Route::delete('remove-from-compare', [ProductControllerOfUser::class, 'removeCompare'])->name('remove.from.compare');
Route::get('search', [ProductControllerOfUser::class, 'search'])->name('search');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('verify-phone', [PhoneAuthController::class, 'index']);

Route::get('contact-us', [UserContactUsController::class, 'create'])->name('frontend.contactUs.create');
Route::post('contact-us/upload', [UserContactUsController::class, 'store'])->name('frontend.contactUs.store');

Route::group(['middleware' => ['auth']], function () {

    Route::get('checkout', [UserOrderController::class, 'checkout'])->name('checkout');
    Route::get('/order-placed/successful', [UserOrderController::class, 'orderPlacedSuccessful'])->name('orderPlacedSuccessful');
    Route::get('show-address/{id}', [UserOrderController::class, 'show'])->name('show.address');
    Route::post('place-order', [UserOrderController::class, 'store'])->name('place.order');
    Route::post('direct/place-order', [UserOrderController::class, 'storeDirectPlaceOrder'])->name('storeDirectPlaceOrder');
    Route::get('orders/inprogress', [UserOrderController::class, 'inProgress'])->name('order.inProgress');
    Route::get('orders/delivered', [UserOrderController::class, 'delivered'])->name('order.delivered');
    Route::get('orders/returned', [UserOrderController::class, 'returned'])->name('order.returned');
    Route::post('orders/cancel/{order_id}', [UserOrderController::class, 'cancelFromUser'])->name('order.cancelFromUser');

    Route::get('/orders', [HomeController::class, 'orders'])->name('user.order.index');
    Route::post('/order-return/{id}', [HomeController::class, 'returnOrder'])->name('user.order.return');
    Route::get('/order-detail/{id}', [HomeController::class, 'orderDetail'])->name('user.order.detail');
    Route::get('/track-order', [HomeController::class, 'trackOrder'])->name('user.order.track');
    Route::get('/user-product-detail/{id}', [HomeController::class, 'productDetail'])->name('user.product.detail');

    Route::post('/update-business', [HomeController::class, 'updateUser'])->name('user.update.business');
    Route::post('change-password', [HomeController::class, 'password_change'])->name('user.password.change');

    // view All commissions details
    Route::get('all/marketing/commission', [HomeController::class, 'allMarketingCommission'])->name('allMarketingCommission');
    Route::get('all/circle/commission', [HomeController::class, 'allCircleCommission'])->name('allCircleCommission');
    Route::get('all/sale/commission', [HomeController::class, 'allSaleCommission'])->name('allSaleCommission');
    Route::get('all/pending/commission', [HomeController::class, 'allPendingCommission'])->name('allPendingCommission');
    Route::get('all/shop/sales', [HomeController::class, 'allShopSAlesCommission'])->name('allShopSAlesCommission');
    Route::get('all/withdraws/{status}', [HomeController::class, 'allWithdrawDetail'])->name('allWithdrawDetail');

    Route::post('subscribe/to/newsletter', [UserController::class, 'subscribeNewsLetter'])->name('subscribeNewsLetter');

    Route::get('/withdraw', [WithdrawController::class, 'create'])->name('user.withdraw.create');
    Route::post('/withdraw/upload', [WithdrawController::class, 'store'])->name('user.withdraw.store');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('user.notification.index');

    /*
    ***user product to upload

    */
    Route::get('user/product/create', [UserProductControllerInUser::class, 'create'])->name('user.product.create');

    Route::post('user/product/store', [UserProductControllerInUser::class, 'store'])->name('user.product.store');


    /*
    Rating
    */
    Route::post('/rating/upload/{id}', [RatingController::class, 'store'])->name('user.rating.store');

    Route::post('/add-payment-type', [PaymentTypeController::class, 'store'])->name('user.paymentType.store');
    Route::post('/add-bundle-payment-type', [PaymentTypeController::class, 'storeBundlePayment'])->name('user.bundlePaymentType.store');
    Route::post('withdraw/bundle/amount', [PaymentTypeController::class, 'withdrawBundlePayment'])->name('withdrawBundlePayment');

    Route::get('/invoice/{id}', [InvoiceController::class, 'generateInvoice'])->name('invoice.generate');

    // ten order bonus claim
    Route::get('claim-bonus', [CommissionController::class, 'tenOrderBonus'])->name('user.bonus.claim');


    Route::get('new/shop/request', [ShopController::class, 'newShopRequest'])->name('newShopRequest');
    Route::get('shop/view/details', [ShopController::class, 'shopDetails'])->name('shopDetails');
    Route::post('upload/new/shop/request', [ShopController::class, 'uploadNewShopRequest'])->name('uploadNewShopRequest');
    Route::post('update/shop/request', [ShopController::class, 'updateShopRequest'])->name('updateShopRequest');
    Route::get('user/all/products', [ShopController::class, 'userAllProducts'])->name('userAllProducts');
    Route::get('user/all/products/{products}', [ShopController::class, 'userUploadedProducts'])->name('userUploadedProducts');
    Route::get('user/delete/product/{product}', [ShopController::class, 'deleteUserProduct'])->name('deleteUserProduct');
    Route::get('user/edit/product/{product}', [ShopController::class, 'editUserProduct'])->name('editUserProduct');
    Route::get('user/change/mega/sale/{product}', [ShopController::class, 'userChangeMegaSale'])->name('userChangeMegaSale');
    Route::post('user/change/order/status', [ShopController::class, 'changeOrderStatus'])->name('changeOrderStatus');
    Route::post('shop/change/order/status', [ShopController::class, 'changeShopOrderStatus'])->name('changeShopOrderStatus');
    Route::get('user/delete/{product}/{image}', [ShopController::class, 'deleteProductImage'])->name('deleteProductImage');
    Route::post('user/update/product', [ShopController::class, 'userUpdateProduct'])->name('userUpdateProduct');
    Route::post('set/all/products/delivery/charges',[ShopController::class, 'setAllProductDeliveryCharges'])->name('setAllProductDeliveryCharges');

    // purchased membership Card
    Route::get('purchased/membership/{purchasedWith}/{amount}', [HomeController::class, 'purchasedMembershipCard'])->name('purchase.membership.cards');
    Route::post('purchased/membership/card', [HomeController::class, 'purchasedMembershipCardNow'])->name('purchase.membership.now');
    // buy product bundles
    Route::get('bundles/home',[ProductBundleController::class, 'home'])->name('bundles.home');
    Route::get('view/all/commission',[ProductBundleController::class, 'viewAllCommission'])->name('bundles.viewAllCommission');
    Route::get('claim/circle/commission',[ProductBundleController::class, 'viewAllCircleCommission'])->name('bundles.viewAllCircleCommission');
    Route::get('buy/product/bundle/{id}',[ProductBundleController::class, 'buyNowProductBundle'])->name('buyNowProductBundle');
    Route::get('order/now/product/bundle/{id}',[ProductBundleController::class, 'orderNowProductBundle'])->name('orderNowProductBundle');
    Route::post('order/now/product/bundle/details',[ProductBundleController::class, 'orderNowProductBundleDetail'])->name('orderNowProductBundleDetail');
    Route::post('repayment/product/bundle/order/details',[ProductBundleController::class, 'repaymentProductBundleOrderDetail'])->name('repaymentProductBundleOrderDetail');
    Route::get('repayment/product/order/{id}',[ProductBundleController::class, 'repaymentProductBundle'])->name('repaymentProductBundle');
    Route::get('stop/referral/earning/payment/{id}',[ProductBundleController::class, 'stopReferralPayment'])->name('stopReferralPayment');
    Route::get('repayment/delivery/charges/order/{id}',[ProductBundleController::class, 'repaymentDeliveryChargesProductBundle'])->name('repaymentDeliveryChargesProductBundle');
    Route::post('payment/product/bundle',[ProductBundleController::class, 'paymentNowProductBundle'])->name('paymentNowProductBundle');
    Route::post('repayment/product/bundle',[ProductBundleController::class, 'repaymentNowProductBundle'])->name('repaymentNowProductBundle');
    Route::post('stop/bundle/earning/payment',[ProductBundleController::class, 'stoppedReferralEarningPayment'])->name('stoppedReferralEarningPayment');
    Route::post('claimed/now/circle/commission',[ProductBundleController::class, 'claimedNowCircleCommission'])->name('claimedNowCircleCommission');

    // send user bundle points
    Route::post('send/user/points/commission',[ProductBundleController::class, 'sendUserPoint'])->name('bundles.sendUserPoint');


});
Route::get('shop', [UserProductControllerInUser::class, 'shop'])->name('user.product.shop');
Route::get('admin/pass/login', [LoginController::class, 'adminPassLogin'])->name('adminPassLogin');
Route::post('admin/pass/login', [LoginController::class, 'adminPassLoggedIn'])->name('adminPassLoggedIn');
