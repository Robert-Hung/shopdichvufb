<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\ViewServiceController;
use App\Http\Controllers\service\FacebookController;
use App\Http\Controllers\service\FacebookV2Controller;
use App\Http\Controllers\service\InstagramController;
use App\Http\Controllers\service\TiktokController;
use App\Http\Controllers\RechargeController;
use App\Http\Controllers\HistoryService;
use App\Http\Controllers\api\service\baostart\BSFacebookController;
use App\Http\Controllers\api\service\subgiare\SGRFacebookController;
use App\Http\Controllers\api\service\subgiare\SGRInstagramController;
use App\Http\Controllers\recharge\cards\TheSieuReController;
use Illuminate\Support\Facades\Artisan;

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

//command artisan
/* Route::get('runsql', function () {
    Artisan::call('migrate');
    Artisan::call('db:seed');
    return 'done';
}); */  


Route::get('/', function () {
    return view('landing.landing');
});

Route::prefix('auth')->middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('login', [AuthController::class, 'DoLogin'])->name('auth.login.post');
    Route::post('register', [AuthController::class, 'DoRegister'])->name('auth.register.post');

    Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->name('auth.forgot-password');
    Route::post('forgot-password', [AuthController::class, 'DoForgotPassword'])->name('auth.forgot-password.post');

    Route::get('reset-password/{token}', [AuthController::class, 'resetPassword'])->name('auth.reset-password');
    Route::post('reset-password', [AuthController::class, 'DoResetPassword'])->name('auth.reset-password.post');
});
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('login', function () {
    return redirect()->route('auth.login');
});
Route::get('register', function () {
    return redirect()->route('auth.register');
});

Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::prefix('account')->middleware('auth')->group(function () {
    Route::get('profile', [HomeController::class, 'profile'])->name('account.profile');
    Route::post('change-password', [HomeController::class, 'changePassword'])->name('account.change-password');

    Route::get('history', [HomeController::class, 'history'])->name('account.history');

    Route::get('upgrade-level', [HomeController::class, 'upgradeLevel'])->name('account.upgrade-level');
});

Route::prefix('recharge')->middleware('auth')->group(function () {
    Route::get('banking', [RechargeController::class, 'banking'])->name('recharge.banking');

    Route::get('cards', [RechargeController::class, 'cards'])->name('recharge.cards');
    Route::post('cards', [TheSieuReController::class, 'thesieure'])->name('recharge.cards.post');
});



Route::prefix('service')->middleware('auth')->group(function () {

    //fb v2

    Route::prefix('facebook-v2')->middleware('auth')->group(function () {
        Route::get('like-post-sale/buy', [ViewServiceController::class, 'likePostSale'])->name('service.facebook-v2.like-post-sale');
        Route::post('like-post-sale/buy', [FacebookV2Controller::class, 'likePostSale'])->name('service.facebook-v2.like-post-sale.post');

        Route::get('like-post-speed/buy', [ViewServiceController::class, 'likePostSpeed'])->name('service.facebook-v2.like-post-speed');
        Route::post('like-post-speed/buy', [FacebookV2Controller::class, 'likePostSpeed'])->name('service.facebook-v2.like-post-speed.post');

        Route::get('comment-sale/buy', [ViewServiceController::class, 'commentSale'])->name('service.facebook-v2.comment-sale');
        Route::post('comment-sale/buy', [FacebookV2Controller::class, 'commentSale'])->name('service.facebook-v2.comment-sale.post');

        Route::get('comment-speed/buy', [ViewServiceController::class, 'commentSpeed'])->name('service.facebook-v2.comment-speed');
        Route::post('comment-speed/buy', [FacebookV2Controller::class, 'commentSpeed'])->name('service.facebook-v2.comment-speed.post');

        Route::get('sub-vip/buy', [ViewServiceController::class, 'subVip'])->name('service.facebook-v2.sub-vip');
        Route::post('sub-vip/buy', [FacebookV2Controller::class, 'subVip'])->name('service.facebook-v2.sub-vip.post');

        Route::get('sub-quality/buy', [ViewServiceController::class, 'subQuality'])->name('service.facebook-v2.sub-quality');
        Route::post('sub-quality/buy', [FacebookV2Controller::class, 'subQuality'])->name('service.facebook-v2.sub-quality.post');

        Route::get('sub-sale/buy', [ViewServiceController::class, 'subSale'])->name('service.facebook-v2.sub-sale');
        Route::post('sub-sale/buy', [FacebookV2Controller::class, 'subSale'])->name('service.facebook-v2.sub-sale.post');

        Route::get('sub-speed/buy', [ViewServiceController::class, 'subSpeed'])->name('service.facebook-v2.sub-speed');
        Route::post('sub-speed/buy', [FacebookV2Controller::class, 'subSpeed'])->name('service.facebook-v2.sub-speed.post');

        Route::get('like-page-quality/buy', [ViewServiceController::class, 'likePageQuality'])->name('service.facebook-v2.like-page-quality');
        Route::post('like-page-quality/buy', [FacebookV2Controller::class, 'likePageQuality'])->name('service.facebook-v2.like-page-quality.post');

        Route::get('like-page-sale/buy', [ViewServiceController::class, 'likePageSale'])->name('service.facebook-v2.like-page-sale');
        Route::post('like-page-sale/buy', [FacebookV2Controller::class, 'likePageSale'])->name('service.facebook-v2.like-page-sale.post');

        Route::get('like-page-speed/buy', [ViewServiceController::class, 'likePageSpeed'])->name('service.facebook-v2.like-page-speed');
        Route::post('like-page-speed/buy', [FacebookV2Controller::class, 'likePageSpeed'])->name('service.facebook-v2.like-page-speed.post');

        Route::get('eye-live/buy', [ViewServiceController::class, 'eyeLive'])->name('service.facebook-v2.eye-live');
        Route::post('eye-live/buy', [FacebookV2Controller::class, 'eyeLive'])->name('service.facebook-v2.eye-live.post');

        Route::get('share-profile/buy', [ViewServiceController::class, 'shareProfile'])->name('service.facebook-v2.share-profile');
        Route::post('share-profile/buy', [FacebookV2Controller::class, 'shareProfile'])->name('service.facebook-v2.share-profile.post');

        Route::get('member-group/buy', [ViewServiceController::class, 'memberGroup'])->name('service.facebook-v2.member-group');
        Route::post('member-group/buy', [FacebookV2Controller::class, 'memberGroup'])->name('service.facebook-v2.member-group.post');

        Route::get('view-story/buy', [ViewServiceController::class, 'viewStory'])->name('service.facebook-v2.view-story');
        Route::post('view-story/buy', [FacebookV2Controller::class, 'viewStory'])->name('service.facebook-v2.view-story.post');

        //history
        Route::get('{service}/order', [HistoryService::class, 'FacebookOrder'])->name('service.facebook-v2.order');

    });

    Route::prefix('instagram')->middleware('auth')->group(function () {
        Route::get('like-post/buy', [ViewServiceController::class, 'likePost'])->name('service.instagram.like-post');
        Route::post('like-post/buy', [InstagramController::class, 'likePost'])->name('service.instagram.like-post.post');

        Route::get('sub/buy', [ViewServiceController::class, 'sub'])->name('service.instagram.sub');
        Route::post('sub/buy', [InstagramController::class, 'sub'])->name('service.instagram.sub.post');

        Route::get('{service}/order', [HistoryService::class, 'InstagramOrder'])->name('service.instagram.order');
    });

    Route::prefix('tiktok')->middleware('auth')->group(function () {
        Route::get('like/buy', [ViewServiceController::class, 'likeTiktok'])->name('service.tiktok.like');
        Route::post('like/buy', [TiktokController::class, 'likeTiktok'])->name('service.tiktok.like.post');

        Route::get('comment/buy', [ViewServiceController::class, 'commentTiktok'])->name('service.tiktok.comment');
        Route::post('comment/buy', [TiktokController::class, 'commentTiktok'])->name('service.tiktok.comment.post');

        Route::get('share/buy', [ViewServiceController::class, 'shareTiktok'])->name('service.tiktok.share');
        Route::post('share/buy', [TiktokController::class, 'shareTiktok'])->name('service.tiktok.share.post');

        Route::get('sub/buy', [ViewServiceController::class, 'subTiktok'])->name('service.tiktok.sub');
        Route::post('sub/buy', [TiktokController::class, 'subTiktok'])->name('service.tiktok.sub.post');

        Route::get('view/buy', [ViewServiceController::class, 'viewTiktok'])->name('service.tiktok.view');
        Route::post('view/buy', [TiktokController::class, 'viewTiktok'])->name('service.tiktok.view.post');

        Route::get('{service}/order', [HistoryService::class, 'TiktokOrder'])->name('service.tiktok.order');
    });

});

//admin
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('setting_website', [AdminController::class, 'settingWebsite'])->name('admin.setting_website');
    Route::post('setting_website', [SettingController::class, 'DoSettingWebsite'])->name('admin.setting_website.post');

    Route::get('manage_user', [AdminController::class, 'manageUser'])->name('admin.manage_user');
    Route::post('update/user', [SettingController::class, 'updateUser'])->name('admin.update.user');
    Route::get('delete/user/{id}', [SettingController::class, 'deleteUser'])->name('admin.delete.user');

    Route::get('setting_notification', [AdminController::class, 'settingNotification'])->name('admin.setting_notification');
    Route::post('update_notice_modal', [SettingController::class, 'updateNoticeModal'])->name('admin.update_notice_modal');
    Route::post('update_notice', [SettingController::class, 'updateNotice'])->name('admin.update_notice');
    Route::get('delete_notice/{id}', [SettingController::class, 'deleteNotice'])->name('admin.delete_notice');
    //charge
    Route::get('setting_charge', [AdminController::class, 'settingCharge'])->name('admin.setting_charge');
    Route::post('update_charge', [SettingController::class, 'updateCharge'])->name('admin.update_charge');
    Route::post('add_charge', [SettingController::class, 'addCharge'])->name('admin.add_charge');

    Route::get('delete_charge/{id}', [SettingController::class, 'deleteCharge'])->name('admin.delete_charge');

    Route::get('history_charge', [AdminController::class, 'historyCharge'])->name('admin.history_charge');

    Route::get('block_ip', [AdminController::class, 'blockIp'])->name('admin.block_ip');
    Route::post('block_ip', [SettingController::class, 'blockIp'])->name('admin.block_ip.post');
    //order
    Route::get('order-manage', [AdminController::class, 'orderManage'])->name('admin.order-manage');
    Route::get('success-order/{id}', [SettingController::class, 'successOrder'])->name('admin.success-order');
    Route::get('cancer-order/{id}', [SettingController::class, 'cancerOrder'])->name('admin.cancer-order');

    //service
    Route::get('setting_services', [AdminController::class, 'settingService'])->name('admin.setting_service');
    Route::post('service/facebook/add', [ServiceController::class, 'addServiceFacebook'])->name('admin.service.facebook.add');
    Route::post('service/instagram/add', [ServiceController::class, 'addServiceInstagram'])->name('admin.service.instagram.add');
    Route::post('service/tiktok/add', [ServiceController::class, 'addServiceTiktok'])->name('admin.service.tiktok.add');
    Route::get('service/off/{id}', [ServiceController::class, 'offService'])->name('admin.service.off');
    Route::get('service/on/{id}', [ServiceController::class, 'onService'])->name('admin.service.on');
    Route::get('service/delete/{id}', [ServiceController::class, 'deleteService'])->name('admin.service.delete');
    Route::get('service/edit/{id}', [AdminController::class, 'editService'])->name('admin.service.edit');
    Route::post('service/update', [ServiceController::class, 'updateService'])->name('admin.service.update');

    Route::get('setting_services-2', [AdminController::class, 'settingService2'])->name('admin.setting_service2');
    Route::post('service/facebook/add-2', [ServiceController::class, 'addServiceFacebook2'])->name('admin.service.facebook.add-2');
    Route::post('service/instagram/add-2', [ServiceController::class, 'addServiceInstagram2'])->name('admin.service.instagram.add-2');
    Route::post('service/tiktok/add-2', [ServiceController::class, 'addServiceTiktok2'])->name('admin.service.tiktok.add-2');
    Route::get('service/off-2/{id}', [ServiceController::class, 'offService2'])->name('admin.service.off-2');
    Route::get('service/on-2/{id}', [ServiceController::class, 'onService2'])->name('admin.service.on-2');
    Route::get('service/delete-2/{id}', [ServiceController::class, 'deleteService2'])->name('admin.service.delete-2');
    Route::get('service/edit-2/{id}', [AdminController::class, 'editService2'])->name('admin.service.edit-2');
    Route::post('service/update-2', [ServiceController::class, 'updateService2'])->name('admin.service.update-2');
    //
    //down
    Route::get('setting_admin', [AdminController::class, 'settingAdmin'])->name('admin.setting_admin');
    Route::post('update_admin', [SettingController::class, 'updateAdmin'])->name('admin.update_admin');

    Route::post('login_momo', [SettingController::class, 'loginMomo'])->name('admin.login_momo');
});
