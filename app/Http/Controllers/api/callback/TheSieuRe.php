<?php

namespace App\Http\Controllers\api\callback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TheSieuRe extends Controller
{
    public function __construct()
    {
        $this->middleware('XSS');
    }

    public function callback(Request $request){
        $status = $request->status;
        $code = $request->code;
        $serial = $request->serial;
        $thucnhan = $request->thucnhan;
        $transid = $request->request_id;
        $value = $request->value;
        $callback = $request->callback_sign;

        $chietkhau_the = DB::table('site_options')->where('key', 'card_discount')->first()->value;
        $tien_nhan = $value - $value * $chietkhau_the / 100;

        /* $parther_id = "2524391561";
        $parther_key = "dac4d1ef15fb3b2b76d94c47c2a2d97a"; */

        $parther_id = DB::table('site_options')->where('key','parther_id')->first()->value;
        $parther_key = DB::table('site_options')->where('key','parther_key')->first()->value;

        $callback_sign = md5($parther_key . $code . $serial);


        if($callback == $callback_sign){
            $history = DB::table('history_bank')->where('tranid', $transid)->first();

            if(!$history){
                return response()->json([
                    'status' => false,
                    'message' => 'Lỗi không tìm thấy giao dịch',
                ], 200);
            }else{
                if($callback_sign != md5($parther_key . $code . $serial)){
                    return response()->json([
                        'status' => false,
                        'message' => 'Lỗi không tìm thấy giao dịch',
                    ], 200);
                }else{
                    if($status == 1){
                        DB::table('history_bank')->where('tranid', $transid)->update([
                            'status' => 1,
                            'thucnhan' => $tien_nhan,
                        ]);
                        DB::table('log_site')->insert([
                            'username' => $history->username,
                            'note' => 'Bạn đã nạp thẻ cào thành công',
                        ]);
                        DB::table('users')->where('username', $history->username)->update([
                            'total_money' => Auth::user()->total_money + $tien_nhan,
                            'total_charge' => Auth::user()->total_charge + $tien_nhan,
                        ]);
                    }else{
                        DB::table('history_bank')->where('tranid', $transid)->update([
                            'status' => 2,
                        ]);
                    }
                }
            }
        }
    }
}
