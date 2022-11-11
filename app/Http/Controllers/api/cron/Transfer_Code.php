<?php

namespace App\Http\Controllers\api\cron;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Transfer_Code extends Controller
{
    public function __construct()
    {
        $this->middleware('XSS');
    }

    public function transfer_code(){
        $list_user = DB::table('users')->get();
        $trs = DB::table('site_options')->where('key', 'transfer_code')->first()->value;
        foreach ($list_user as $user) {
            $transfer_code = $user->transfer_code;
            if($transfer_code == 0){
                $transfer_code = $trs . $user->id;
                DB::table('users')->where('id', $user->id)->update(['transfer_code' => $transfer_code]);
            }else{
                continue;
            }
        }
    }
}
