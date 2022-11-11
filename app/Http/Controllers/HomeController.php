<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('XSS');
    }

    public function index(){
        $title = 'Trang chủ';
        $thongbao = DB::table('notice_sys')->orderBy('id', 'desc')->get();
        $modal_notice =  DB::table('site_options')->where('key', 'thongbao')->first();
        return view('home', compact('title', 'thongbao', 'modal_notice'));
    }

    public function profile(){
        $title = 'Thông tin cá nhân';
        $login = DB::table('login_history')->where('username', Auth::user()->username)->orderBy('id', 'desc')->get();
        return view('pages.profile', compact('title', 'login'));
    }

    public function changePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:6|max:20',
            'confirm_password' => 'required|string|same:new_password',
        ],[
            'old_password.required' => 'Vui lòng nhập mật khẩu cũ',
            'old_password.string' => 'Mật khẩu cũ không hợp lệ',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới',
            'new_password.string' => 'Mật khẩu mới không hợp lệ',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự',
            'new_password.max' => 'Mật khẩu mới không được vượt quá 20 ký tự',
            'confirm_password.required' => 'Vui lòng nhập lại mật khẩu mới',
            'confirm_password.string' => 'Mật khẩu mới không hợp lệ',
            'confirm_password.same' => 'Mật khẩu mới không khớp',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }else{
            $user = DB::table('users')->where('username', Auth::user()->username)->first();
            if(Hash::check($request->old_password, $user->password)){
                $update = DB::table('users')->where('username', Auth::user()->username)->update([
                    'password' => Hash::make($request->new_password)
                ]);
                if($update){
                    DB::table('login_history')->insert([
                        'username' => Auth::user()->username,
                        'content' => "Đã thay đổi mật khẩu",
                        'ip' => $request->ip(),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                    return response()->json([
                        'status' => true,
                        'message' => 'Đổi mật khẩu thành công'
                    ]);
                }else{
                    return response()->json([
                        'status' => false,
                        'message' => 'Đổi mật khẩu thất bại'
                    ]);
                }
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Mật khẩu cũ không chính xác'
                ]);
            }
        }
    }

    public function history(){
        $title = "Lịch sử tài khoản";
        $history = DB::table('log_site')->where('username', Auth::user()->username)->orderBy('id', 'desc')->get();
        return view('pages.history', compact('title', 'history'));
    }

    public function upgradeLevel(){
        $title = "Nâng cấp tài khoản";
        $CTV = DB::table('site_options')->where('key', 'charge_level_CTV')->first();
        $DL = DB::table('site_options')->where('key', 'charge_level_DL')->first();
        $NPP = DB::table('site_options')->where('key', 'charge_level_NPP')->first();
        return view('pages.upgrade_level', compact('title', 'CTV', 'DL', 'NPP'));
    }

    

}
