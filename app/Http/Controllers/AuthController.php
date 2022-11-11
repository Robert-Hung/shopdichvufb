<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\ForgotPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('XSS');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function DoLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ],[
            'username.required' => "Nhập tên đăng nhập",
            'password.required' => "Nhập mật khẩu",
        ]);
        if($validator->fails()){
            return redirect()->back()->with('errors', $validator->errors()->first());
        }else{
            $credentials = $request->only('username', 'password');
            if(Auth::attempt($credentials)){
                Auth::login($request->user());
                DB::table('login_history')->insert([
                    'username' => $request->username,
                    'content' => 'Đăng nhập',
                    'ip' => $request->ip(),
                    'browser' => $this->getBrowser(),
                    'os' => $this->getOS(),
                    'device' => $this->getDevice(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                /* $mail_true = DB::table('site_options')->where('key', 'send_mail')->first();
                if($mail_true->value == true){
                    $details = [
                        'content' => "Bạn vừa đăng nhập tài khoản \n Vào lúc: ".Carbon::now()."\n Từ IP: ".$request->ip()."\n Với trình duyệt: ".$this->getBrowser()."\n Và hệ điều hành: ".$this->getOS()."\n Và thiết bị: ".$this->getDevice()
                    ];
                    Mail::to($request->user()->email)->send(new SendMail("Thông báo đăng nhập", $details));
                }
                else{
                    return redirect()->route('home');

                } */
                return redirect()->route('home');
            }else{
                return redirect()->back()->with('errors', 'Tên đăng nhập hoặc mật khẩu không đúng');
            }
        }
    }

    public function DoRegister(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|min:6|max:255|unique:users',
            'password' => 'required|string|min:6',
        ],[
            'name.required' => "Nhập tên của bạn",
            'name.string' => "Tên của bạn phải là chuỗi",
            'name.max' => "Tên của bạn không quá 255 ký tự",
            'email.required' => "Nhập email của bạn",
            'email.string' => "Email của bạn phải là chuỗi",
            'email.email' => "Email của bạn không đúng định dạng",
            'email.max' => "Email của bạn không quá 255 ký tự",
            'email.unique' => "Email của bạn đã tồn tại",
            'username.required' => "Nhập tên đăng nhập của bạn",
            'username.string' => "Tên đăng nhập của bạn phải là chuỗi",
            'username.min' => "Tên đăng nhập của bạn phải có ít nhất 6 ký tự",
            'username.max' => "Tên đăng nhập của bạn không quá 255 ký tự",
            'username.unique' => "Tên đăng nhập của bạn đã tồn tại",
            'password.required' => "Nhập mật khẩu của bạn",
            'password.string' => "Mật khẩu của bạn phải là chuỗi",
            'password.min' => "Mật khẩu của bạn phải có ít nhất 6 ký tự",
        ]);
        if($validator->fails()){
            /* Mail::to($request->email)->send(new SendMail("Thông báo tài khoản", $details)); */
            return redirect()->back()->with('errors', $validator->errors()->first());

        }else{
            $token = Str::random(45);
            $transfer_code = DB::table('site_options')->where('key', 'transfer_code')->first();
            $transfer_code = $transfer_code->value;
            DB::table('login_history')->insert([
                'username' => $request->username,
                'content' => "Đã đăng kí tài khoản",
                'ip' => $request->ip(),
                'browser' => $this->getBrowser(),
                'os' => $this->getOS(),
                'device' => $this->getDevice(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            DB::table('users')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'api_token' => $token,
                'role' => 1,
                'total_money' => 0,
                'total_charge' => 0,
                'total_minus' => 0,
                'banned' => 0,
                'ip' => $request->ip(),
                'transfer_code' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            /* $mail_true = DB::table('site_options')->where('key', 'send_mail')->first();
            if($mail_true->value == true){
                $details = [
                    'content' => "Bạn đã đăng ký thành công tài khoản \n tên đăng nhập là: " . $request->username . " \n  mật khẩu là: Đã mã hóa \n IP: " . $request->ip()

                ];
                Mail::to($request->email)->send(new SendMail("Thông báo tài khoản", $details));
            }else{
                return redirect()->route('auth.login')->with('success', 'Đăng ký thành công vui lòng đăng nhập');
            } */
            return redirect()->route('auth.login')->with('success', 'Đăng ký thành công vui lòng đăng nhập');
        }
    }
    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect()->route('auth.login')->with('errors', 'Vui lòng đăng nhập lại');
    }

    public function forgotPassword(){
        return view('auth.forget-password');
    }

    public function DoForgotPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|exists:users,email',
        ],[
            'email.required' => "Nhập email của bạn",
            'email.string' => "Email của bạn phải là chuỗi",
            'email.email' => "Email của bạn không đúng định dạng",
            'email.exists' => "Email của bạn không tồn tại",
        ]);
        if($validator->fails()){
            return redirect()->back()->with('errors', $validator->errors()->first());
        }else{
            $user = DB::table('users')->where('email', $request->email)->first();
            $genate = Str::random(45);
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $genate,
                'created_at' => Carbon::now(),
            ]);
            $details = [
                'content' => "Bạn đã yêu cầu đặt lại mật khẩu của tên đăng nhập là: " . $user->username . " \n vui lòng click vào link sau để đặt lại mật khẩu \n " . route('auth.reset-password', $genate)
            ];
            Mail::to($request->email)->send(new ForgotPassword($details));
            return redirect()->route('auth.login')->with('success', 'Vui lòng kiểm tra email để đặt lại mật khẩu');
        }
    }

    public function resetPassword(Request $request){
        $token = $request->token;
        return view('auth.reset-password', compact('token'));
    }

    public function DoResetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'token' => 'required|string|exists:password_resets,token',
            'new_password' => 'required|string|min:6',
            'confirm_password' => 'required|same:new_password',
        ],[
            'token.required' => "Nhập token của bạn",
            'token.string' => "Token của bạn phải là chuỗi",
            'token.exists' => "Token của bạn không tồn tại",
            'new_password.required' => "Nhập mật khẩu mới của bạn",
            'new_password.string' => "Mật khẩu mới của bạn phải là chuỗi",
            'new_password.min' => "Mật khẩu mới của bạn phải có ít nhất 6 ký tự",
            'confirm_password.required' => "Nhập lại mật khẩu mới của bạn",
            'confirm_password.same' => "Mật khẩu mới và xác nhận mật khẩu mới của bạn không trùng nhau",
        ]);
        if($validator->fails()){
            return redirect()->back()->with('errors', $validator->errors()->first());
        }else{
            $user = DB::table('password_resets')->where('token', $request->token)->first();
            $user = DB::table('users')->where('email', $user->email)->first();
            DB::table('users')->where('id', $user->id)->update([
                'password' => Hash::make($request->new_password),
            ]);
            DB::table('password_resets')->where('email', $user->email)->delete();
            return redirect()->route('auth.login')->with('success', 'Đặt lại mật khẩu thành công');
        }
    }

    public function getBrowser(){
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $browser        =   "Unknown Browser";
        $browser_array  =   array(
            '/msie/i'       =>  'Internet Explorer',
            '/firefox/i'    =>  'Firefox',
            '/safari/i'     =>  'Safari',
            '/chrome/i'     =>  'Chrome',
            '/edge/i'       =>  'Edge',
            '/opera/i'      =>  'Opera',
            '/netscape/i'   =>  'Netscape',
            '/maxthon/i'    =>  'Maxthon',
            '/konqueror/i'  =>  'Konqueror',
            '/mobile/i'     =>  'Handheld Browser'
        );
        foreach ($browser_array as $regex => $value) {
            if (preg_match($regex, $userAgent)) {
                $browser    =   $value;
            }
        }
        return $browser;
    }

    public function getOS(){
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $os_platform    =   "Unknown OS Platform";
        $os_array       =   array(
            '/windows nt 10/i'     =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );
        foreach ($os_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $os_platform    =   $value;
            }
        }
        return $os_platform;
    }

    public function getDevice(){
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $device_platform    =   "Unknown Device Platform";
        $device_array       =   array(
            '/ipad/i'     =>  'iPad',
            '/ipod/i'     =>  'iPod',
            '/iphone/i'   =>  'iPhone',
            '/android/i'  =>  'Android',
            '/blackberry/i'=>  'BlackBerry',
            '/webos/i'    =>  'Mobile'
        );
        foreach ($device_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $device_platform    =   $value;
            }
        }
        return $device_platform;
    }
}
