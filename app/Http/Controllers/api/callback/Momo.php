<?php

namespace App\Http\Controllers\api\callback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class Momo extends Controller
{
    public function __construct()
    {
        $this->middleware('XSS');
    }

    public function callback(){
        $accs = DB::table('bank_accounts')->where('type','momo')->first();
        $access_token = $accs->token;
        $phone_number = $accs->number;
        $dmomo = $this->dMomo($access_token, $phone_number);
        $dmomo = json_decode($dmomo,true);
        //print_r($dmomo);
        if($dmomo['success'] == true){
            foreach($dmomo['data'] as $key => $value){
                $transId = $value['transId'];
                $partnerId = $value['partnerId'];
                $partnerName = $value['partnerName'];
                $amount = $value['amount'];
                $comment = $value['comment'];

                $checkTransId = DB::table('history_bank')->where('tranid',$transId)->first();
                if($checkTransId){
                    continue;
                }else{
                    $username = DB::table('users')->where('transfer_code', $comment)->first();
                    if($username){
                        $username = $username->username;
                        DB::table('history_bank')->insert([
                            'type' => 'momo',
                            'username' => $username,
                            'thucnhan' => $amount,
                            'status' => 'success',
                            'date' => date('Y-m-d H:i:s'),
                            'tranid' => $transId,
                        ]);
                        
                        DB::table('users')->where('username', $username)->update([
                            'total_money' => $username->total_money + $amount,
                            'total_charge' => $username->total_charge + $amount,
                        ]);

                        DB::table('log_site')->insert([
                            'username' => $username,
                            'note' => 'Nạp tiền từ mạng Momo + '.$amount . 'vào tài khoản',
                            'created_at' => date('Y-m-d H:i:s'),
                        ]);
                        
                    }else{
                        continue;
                    }
                }
            }
        }else{
            return response()->json(['status'=>false,'message'=> $dmomo['message']]);
        }
    }

    public function dMomo($access_token, $phone_number){
        $dataPost = array(
            "access_token" => $access_token, //token từ hệ thống
            "phone" => $phone_number, //số điện thoại Momo muốn lấy giao dịch
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apigiare.com/api/getHistoryMomo",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($dataPost),
            CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "accept: application/json")
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            //hiện kết quả
            return $response;
    }
}
