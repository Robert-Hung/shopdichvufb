<?php

namespace App\Http\Controllers\api\cron;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class upgradeLevel extends Controller
{
    public function __construct()
    {
        $this->middleware('XSS');
    }

    public function upgradeLevel()
    {
        $list_user = DB::table('users')->get();
        $chargeCTV = DB::table('site_options')->where('key', 'charge_level_CTV')->first()->value;
        $chargeDL = DB::table('site_options')->where('key', 'charge_level_DL')->first()->value;
        $chargeNPP = DB::table('site_options')->where('key', 'charge_level_NPP')->first()->value;
        foreach ($list_user as $user) {
            $role = $user->role;
            $total_money = $user->total_money;
            if($total_money == $chargeCTV ){
                if($role == 2){
                    continue;
                }elseif($role == 99){
                    continue;
                }else{
                    DB::table('users')->where('i d', $user->id)->update(['role' => 2]);
                }
            }elseif($total_money == $chargeDL){
                if($role == 3){
                    continue;
                }elseif($role == 99){
                    continue;
                }else{
                    DB::table('users')->where('id', $user->id)->update(['role' => 3]);
                }
            }elseif($total_money == $chargeNPP){
                if($role == 4){
                    continue;
                }elseif($role == 99){
                    continue;
                }else{
                    DB::table('users')->where('id', $user->id)->update(['role' => 4]);
                }
            }else{
                continue;
            }
        }
    }
}
