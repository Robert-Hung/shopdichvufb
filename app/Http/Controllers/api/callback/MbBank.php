<?php

namespace App\Http\Controllers\api\callback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class MbBank extends Controller
{
    public function __construst()
    {
        $this->middleware('XSS');
    }

    public function callback(){
        $accs = DB::table('bank_accounts')->where('type','mbbank')->first();
        $access_token = $accs->token;
        $phone_number = $accs->number;
        $password = $accs->password;

        $mbbank = $this->hisMbbank($access_token,$phone_number,$password);

        //return "<pre>".print_r($mbbank,true)."</pre>";
        
        $mbbank = json_decode($mbbank,true);
        if($mbbank['success'] == true){
            /* echo "<pre>";
            print_r($mbbank);
            echo "</pre>"; */
            foreach($mbbank['data'] as $key => $value){
                //$partherPhone = $value['benAccountNo'];
                $creditAmount = $value['creditAmount'];
                $refNo = $value['refNo'];
                $availableBalance = $value['availableBalance'];
                $description = $value['description'];

                $cmt = explode(' ',$value['description']);
                //echo $cmt[1] . "<br>";
                $cde = explode('.',$cmt[1]);
                //echo $cde[0] . "<br>";

                $checkTrainId = DB::table('history_bank')->where('tranid',$refNo)->first();
                if($checkTrainId){
                    echo "false";
                }else{
                    $username = DB::table('users')->where('transfer_code', $cde[0])->first();
                    if($username){
                        $username = $username->username;
                        DB::table('history_bank')->insert([
                            'type' => 'mbbank',
                            'username' => $username,
                            'thucnhan' => $creditAmount,
                            'status' => 'success',
                            'date' => date('Y-m-d H:i:s'),
                            'tranid' => $refNo,
                        ]);
                        DB::table('users')->where('username', $username)->update([
                            'total_money' => $username->total_money + $creditAmount,
                            'total_charge' => $username->total_charge + $creditAmount,
                        ]);
                        DB::table('log_site')->insert([
                            'username' => $username,
                            'note' => 'N???p ti???n t??? m???ng MBBank + '.$creditAmount . 'v??o t??i kho???n',
                            'created_at' => date('Y-m-d H:i:s'),
                        ]);
                        echo "true";
                    }else{
                        echo "null";
                    }
                }
                //cmt 
            }
        }else{
            return response()->json(['status'=>false,'message'=> $mbbank['message']]);
        }

    }

    public function hisMbbank($access_token, $phone_number, $password){
        $dataPost = array(
            "access_token" => "$access_token", //token t??? h??? th???ng
            "username" => "$phone_number", //T??i kho???n bank
            "password" => "$password", //M???t kh???u bank
            "accountNumber" => "$phone_number", //S??? t??i kho???n c???n l???y l???ch s???
            "bank" => "mbb", //Ng??n h??ng c???n l???y lsgd
            "day"=> 1 //Ng??y l???y l???ch s??? g???n nh???t
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
