<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RechargeController extends Controller
{
    public function __construct()
    {
        $this->middleware('XSS');
    }

    public function banking(){
        $title = "Chuyển khoản";
        $bank_list = DB::table('bank_accounts')->get();
        return view('recharge.banking', compact('title', 'bank_list'));
    }

    public function cards(){
        $title = "Nạp thẻ cào";
        $carddiscount = DB::table('site_options')->where('key', 'card_discount')->first();
        $server = DB::table('history_bank')->where(['type' => 'thecao', 'username' => Auth::user()->username])->get();
        return view('recharge.card', compact('title', 'server', 'carddiscount'));
    }
}
