<?php

namespace App\Http\Controllers\api\callback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class VietComBank extends Controller
{
    public function __construst()
    {
        $this->middleware('XSS');
    }

    public function callback(){
        $accs = DB::table('bank_accounts')->where('type','vietcombank')->first();
        $access_token = $accs->token;
        $phone_number = $accs->number;
        $password = $accs->password;

        $vietcombank = $this->hisVcb($access_token,$phone_number,$password);

        $vietcombank = json_decode($vietcombank,true);

        if($vietcombank['success'] == true){
            
            foreach($vietcombank['data'] as $key => $value){
                $CD = $value['CD'];
                $Amount = $value['Amount'];
                //xóa dấu , $Amount
                $Amount = str_replace(',','',$Amount);
                $Description = $value['Description'];
                $PCTime = $value['PCTime'];
                $Description = explode('.',$Description);
                $Description = $Description[2];

                $checkTrainId = DB::table('history_bank')->where('tranid',$PCTime)->first();
                if($CD == '+'){
                    if($checkTrainId){
                        echo "false";
                    }else{
                        $username = DB::table('users')->where('transfer_code', $Description)->first();
                        if($username){
                            $username = $username->username;
                            DB::table('history_bank')->insert([
                                'type' => 'vcb',
                                'username' => $username,
                                'thucnhan' => $Amount,
                                'status' => 'success',
                                'date' => date('Y-m-d H:i:s'),
                                'tranid' => $PCTime,
                            ]);

                            DB::table('users')->where('transfer_code', $Description)->update([
                                'total_money' => $username->total_money + $Amount,
                                'total_charge' => $username->total_charge + $Amount,
                            ]);

                            DB::table('log_site')->insert([
                                'username' => $username,
                                'note' => 'Nạp tiền từ mạng VCB + '.$Amount . 'vào tài khoản',
                                'created_at' => date('Y-m-d H:i:s'),
                            ]);
                            echo "true";
                        }else{
                            echo "false";
                        }
                    }
                }
            }

        }else{
            return response()->json(['success' => false, 'message' => $vietcombank['message']]);
        }

    }

    public function hisVcbbank($access_token,$phone_number,$password){
        $dataPost = array(
            "access_token" => "$access_token", //token từ hệ thống
            "username" => "$phone_number", //Tài khoản bank
            "password" => "$password", //Mật khẩu bank
            "accountNumber" => "$phone_number", //Số tài khoản cần lấy lịch sử
            "bank" => "vcb", //Ngân hàng cần lấy lsgd
            "day"=> 1 //Ngày lấy lịch sử gần nhất
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apigiare.com/api/getTransHistory",
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
            return $response;
    }

}
