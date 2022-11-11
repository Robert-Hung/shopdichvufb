<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('XSS');
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(){
        $title = "Trang quản trị";
        $total_money = DB::table('users')->sum('total_money');
        $total_charge = DB::table('users')->sum('total_charge');
        $total_minus = DB::table('users')->sum('total_minus');
        $total_user = DB::table('users')->count();
        $revenueMonth = DB::table('history_bank')->whereMonth('date', Carbon::now()->month)->sum('thucnhan');
        $totalOrderMonth = DB::table('client_orders')->whereMonth('created_at', Carbon::now()->month)->count();
        $chargeMonth = DB::table('history_bank')->whereMonth('created_at', Carbon::now()->month)->count();
        $total_order = DB::table('client_orders')->count();
        $chargeToday = DB::table('history_bank')->whereDate('created_at', Carbon::now()->toDateString())->count();
        $userRegToday = DB::table('users')->whereDate('created_at', Carbon::now()->toDateString())->count();
        
        //history notice admin to 7 days carbon::now()->subDays(7)
        $site_admin = DB::table('site_admin')->whereDate('created_at', '>=', Carbon::now()->subDays(7))->get();
        return view('admin.index', compact('title', 'total_money', 'total_charge', 'total_minus', 'total_user', 'revenueMonth', 'totalOrderMonth', 'chargeMonth', 'total_order', 'chargeToday', 'userRegToday', 'site_admin'));
    }

    public function settingWebsite(){
        $title = "Cài đặt website";
        //
        $status_web = DB::table('site_options')->where('key', 'status_web')->first();
        $domain = DB::table('site_options')->where('key', 'domain')->first();
        $transfer_code = DB::table('site_options')->where('key', 'transfer_code')->first();
        $describe = DB::table('site_options')->where('key', 'describe')->first();
        $keyword = DB::table('site_options')->where('key', 'key_word')->first();
        $favicon = DB::table('site_options')->where('key', 'favicon_web')->first();
        $intro_img = DB::table('site_options')->where('key', 'intro_img')->first();
        $token_fb = DB::table('site_options')->where('key', 'token_facebook')->first();
        $api_telegram_bot = DB::table('site_options')->where('key', 'api_telegram_bot')->first();
        $id_chat_tel = DB::table('site_options')->where('key', 'id_chat_tel')->first();
        $charge_level_TV = DB::table('site_options')->where('key', 'charge_level_TV')->first();
        $charge_level_CTV = DB::table('site_options')->where('key', 'charge_level_CTV')->first();
        $charge_level_DL = DB::table('site_options')->where('key', 'charge_level_DL')->first();
        $charge_level_NPP = DB::table('site_options')->where('key', 'charge_level_NPP')->first();
        $discount_TV = DB::table('site_options')->where('key', 'discount_TV')->first();
        $discount_CTV = DB::table('site_options')->where('key', 'discount_CTV')->first();
        $discount_DL = DB::table('site_options')->where('key', 'discount_DL')->first();
        $discount_NPP = DB::table('site_options')->where('key', 'discount_NPP')->first();
        $card_discount = DB::table('site_options')->where('key', 'card_discount')->first();

        //check column not null
        if(!$status_web){ $status_web = new \stdClass(); $status_web->value = ""; }if(!$domain){ $domain = new \stdClass(); $domain->value = ""; }if(!$describe){ $describe = new \stdClass(); $describe->value = ""; }if(!$keyword){ $keyword = new \stdClass(); $keyword->value = ""; }if(!$favicon){ $favicon = new \stdClass(); $favicon->value = ""; }if(!$intro_img){ $intro_img = new \stdClass(); $intro_img->value = ""; }if(!$token_fb){ $token_fb = new \stdClass(); $token_fb->value = ""; }if(!$api_telegram_bot){ $api_telegram_bot = new \stdClass(); $api_telegram_bot->value = ""; }if(!$id_chat_tel){ $id_chat_tel = new \stdClass(); $id_chat_tel->value = ""; }if(!$charge_level_TV){ $charge_level_TV = new \stdClass(); $charge_level_TV->value = ""; }if(!$charge_level_CTV){ $charge_level_CTV = new \stdClass(); $charge_level_CTV->value = ""; }if(!$charge_level_DL){ $charge_level_DL = new \stdClass(); $charge_level_DL->value = ""; }if(!$charge_level_NPP){ $charge_level_NPP = new \stdClass(); $charge_level_NPP->value = ""; }if(!$discount_TV){ $discount_TV = new \stdClass(); $discount_TV->value = ""; }if(!$discount_CTV){ $discount_CTV = new \stdClass(); $discount_CTV->value = ""; }if(!$discount_DL){ $discount_DL = new \stdClass(); $discount_DL->value = ""; }if(!$discount_NPP){ $discount_NPP = new \stdClass(); $discount_NPP->value = ""; }if(!$card_discount){ $card_discount = new \stdClass(); $card_discount->value = ""; }
        if(!$transfer_code){ $transfer_code = new \stdClass(); $transfer_code->value = ""; }
        return view('admin.pages.settingWeb', compact('title', 'status_web', 'domain','transfer_code' ,'describe', 'keyword', 'favicon', 'intro_img', 'token_fb', 'api_telegram_bot', 'id_chat_tel', 'charge_level_TV', 'charge_level_CTV', 'charge_level_DL', 'charge_level_NPP', 'discount_TV', 'discount_CTV', 'discount_DL', 'discount_NPP', 'card_discount'));
    }

    public function manageUser(){
        $title = "Quản lý người dùng";
        $users = DB::table('users')->get();
        return view('admin.pages.manageUser', compact('title', 'users'));
    }

    public function settingNotification(){
        $title = "Cài đặt thông báo";
        $notice = DB::table('notice_sys')->get();
        $notice_modal = DB::table('site_options')->where('key', 'thongbao')->first();
        if(!$notice_modal){ $notice_modal = new \stdClass(); $notice_modal->value = ""; }
        return view('admin.pages.notification', compact('title', 'notice', 'notice_modal'));
    }

    //down
    public function settingAdmin(){
        $title = "Cài đặt quản trị";
        $admin_name = DB::table('site_options')->where('key', 'admin_name')->first();
        $facebook_admin = DB::table('site_options')->where('key', 'facebook_admin')->first();
        $zalo_admin = DB::table('site_options')->where('key', 'zalo_admin')->first();
        $uid = DB::table('site_options')->where('key', 'uid_admin')->first();
        $token_baostart = DB::table('site_options')->where('key', 'token_baostart')->first();
        $token_subgiare = DB::table('site_options')->where('key', 'token_subgiare')->first();
        return view('admin.pages.settingAdmin', compact('title', 'admin_name', 'facebook_admin', 'zalo_admin', 'uid', 'token_baostart', 'token_subgiare'));
    }

    public function orderManage(){
        $title = "Quản lý đơn hàng";
        $orders = DB::table('client_orders')->get();
        $orders_pendding = DB::table('client_orders')->where('status', 'Pending')->get();
        return view('admin.pages.orderManage', compact('title', 'orders', 'orders_pendding'));
    }





    public function settingService(){
        $title = "Cài đặt dịch vụ";
        $service_facebook = DB::table('service_server')->where('type_server', md5('facebook'))->where('api_server', 'subgiare')->get();
        $service_instagram = DB::table('service_server')->where('type_server', md5('instagram'))->where('api_server', 'subgiare')->get();
        $service_tiktok = DB::table('service_server')->where('type_server', md5('tiktok'))->where('api_server', 'subgiare')->get();
        return view('admin.pages.settingService', compact('title', 'service_facebook', 'service_instagram', 'service_tiktok'));
    }

    public function editService(Request $request)
    {
        $title = "Chỉnh sửa dịch vụ";
        $id = $request->id;
        $service = DB::table('service_server')->where('id', $id)->first();
        if(!$service){
            return redirect()->back()->with('error', 'Không tìm thấy dịch vụ');
        }
        //check type server
        if($service->type_server == md5('facebook')){
            $type_server = 'facebook';
        }elseif($service->type_server == md5('instagram')){
            $type_server = 'instagram';
        }elseif($service->type_server == md5('tiktok')){
            $type_server = 'tiktok';
        }elseif($request->api_server == 'baostart'){
            $type_server = 'baostart';
        }else{
            return redirect()->back()->with('error', 'Không tìm thấy dịch vụ');
        }
        return view('admin.pages.editService', compact('title', 'service', 'type_server'));
    }

    public function settingService2(){
        $title = "Cài đặt dịch vụ";
        $service_facebook = DB::table('service_server')->where('type_server', md5('facebook'))->where('api_server', 'baostart')->get();
        $service_instagram = DB::table('service_server')->where('type_server', md5('instagram'))->where('api_server', 'baostart')->get();
        $service_tiktok = DB::table('service_server')->where('type_server', md5('tiktok'))->where('api_server', 'baostart')->get();
        return view('admin.pages.settingService2', compact('title', 'service_facebook', 'service_instagram', 'service_tiktok'));
    }

    public function settingCharge(){
        $title = "Cài đặt nạp tiền";
        $parther_id = DB::table('site_options')->where('key', 'parther_id')->first();
        $parther_key = DB::table('site_options')->where('key', 'parther_key')->first();
        // check partner id and key is empty    or not
        if(!$parther_id || !$parther_key){
            $parther_id = new \stdClass();
            $parther_id->value = "";
            $parther_key = new \stdClass();
            $parther_key->value = "";
        }
        $bank_list = DB::table('bank_accounts')->get();

        return view('admin.pages.settingCharge', compact('title', 'parther_id', 'parther_key', 'bank_list'));
    }

    public function historyCharge(){
        $title = "Lịch sử nạp tiền";
        $thecao = DB::table('history_bank')->where('type', 'thecao')->get();
        //$atm = DB::table('history_atm')->where('type', 'ATM')->get();

        return view('admin.pages.historyCharge', compact('title', 'thecao'));
    }

    public function blockIp(){
        $title = "Chặn ip không hợp lệ";
        return view('admin.pages.blockIp', compact('title'));
    }
}
