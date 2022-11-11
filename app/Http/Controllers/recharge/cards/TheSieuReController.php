<?php

namespace App\Http\Controllers\recharge\cards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;

class TheSieuReController extends Controller
{
    public function __construst()
    {
        $this->middleware('auth');
        $this->middleware('XSS');
    }

    public function thesieure(Request $request){
        $validator = Validator::make($request->all(), [
            'card_type' => 'required',
            'card_price' => 'required',
            'serial' => 'required|numeric',
            'code' => 'required|numeric',
        ],[
            'card_type.required' => 'Vui lòng chọn loại thẻ',
            'card_price.required' => 'Vui lòng chọn giá thẻ',
            'serial.required' => 'Vui lòng nhập số serial',
            'serial.numeric' => 'Số serial không đúng định dạng',
            'code.required' => 'Vui lòng nhập số code',
            'code.numeric' => 'Số code không đúng định dạng',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 200);
        }else{
            /* $parther_id = "2524391561";
            $parther_key = "dac4d1ef15fb3b2b76d94c47c2a2d97a"; */
            $parther_id = DB::table('site_options')->where('key','parther_id')->first()->value;
            $parther_key = DB::table('site_options')->where('key','parther_key')->first()->value;

            $tranid = rand(100000000, 999999999);
            $tsr = $this->charginTSR($request->card_type, $request->card_price, $request->code, $request->serial, $tranid, $parther_id, $parther_key);
            if($tsr['status'] == 99){

                DB::table('history_bank')->insert([
                    'type' => 'thecao',
                    'username' => Auth::user()->username,
                    'card_type' => $request->card_type,
                    'card_price' => $request->card_price,
                    'serial' => $request->serial,
                    'code' => $request->code,
                    'thucnhan' => 0,
                    'status' => 0,
                    'date' => time(),
                    'tranid' => $tranid,
                ]);

                return response()->json([
                    'status' => true,
                    'message' => "The Dang cho xac nhan",
                ], 200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => $tsr['message'],
                ], 200);
            }
        }
    }


    public function charginTSR($telCo, $amount, $pin, $serial, $requestId, $partner_id, $partner_key)
    {
        $client = new Client();
        $url = 'https://thesieure.com/chargingws/v2?sign='.md5($partner_key.$pin.$serial).'&telco='.$telCo.'&code='.$pin.'&serial='.$serial.'&amount='.$amount.'&request_id='.$requestId.'&partner_id='.$partner_id.'&command=charging';

        $response = $client->request('GET', $url);
        $body = $response->getBody();
        $data = json_decode($body, true);
        return $data;
    }

}
