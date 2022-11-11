<?php

namespace App\Http\Controllers\api\callback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class Tsr extends Controller
{
    public function __construct()
    {
        $this->middleware('XSS');
    }

    public function callback()
    {
        $url = url('/sys/_tsr.php');
        $html = file_get_contents($url);
        $pattern = 'class="text-success">';
        //$data = explode($pattern, $html)[3];
        $pattern = '/>T(.+?)</';
        $string = $html;
        preg_match_all($pattern, $string, $match);

        foreach ($match[1] as $mgd) {
            if ($mgd == "hành công" || $mgd == "hất bại") {
            } else {
                $mgd = "T$mgd";
                //check chuyển tiền và nhận
                $checkravao = explode($mgd, $html)[1];
                $checkravao1 = explode("</tr>", $checkravao)[0];
                $checkravao = explode("<span", $checkravao1)[1];
                $checkravao = explode('">', $checkravao)[0];
                $checkravao = explode('class="', $checkravao)[1];
                if ($checkravao == "text-danger") {
                    $rarvao = "Chuyển Tiền";
                }
                if ($checkravao == "text-success") {
                    $rarvao = "Nhận Tiền";
                }
                //số tiền được nhận hoặc trừ
                $sotien = '' . $checkravao . '">';
                $sotien = explode($sotien, $checkravao1)[1];
                $sotien = explode("</span>", $sotien)[0];
                $sotien = explode("đ", $sotien)[0];
                $sotien1 = explode(",", $sotien)[0];
                $sotien2 = explode(",", $sotien)[1];
                $sotien = $sotien1 . $sotien2;
                //người nhận hoặc gửi
                $nhanorgui = explode('<span class="text-muted">', $checkravao1)[1];
                $nhanorgui = explode("</span>", $nhanorgui)[0];
                //nội dung chuyển
                $nd = explode('<span class="label label-success">', $checkravao1)[1];
                $nd = explode('<td>', $nd)[1];
                $nd = explode('</td>', $nd)[0];
                //echo $nd . " -> " . $mgd . " -> " . $sotien . " -> " . $nhanorgui . " -> " . $rarvao . "<br>";
                //echo $nhanorgui;
                if ($rarvao == "Nhận Tiền") {
                    //echo $nd . " -> " . $mgd . " -> " . $sotien . " -> " . $nhanorgui . " -> " . $rarvao . "<br>";
                    $checktranid = DB::table('history_bank')->where('tranid', $mgd)->first();
                    if ($checktranid) {
                        echo "False";
                    } else {
                        $code = DB::table('users')->where('transfer_code', $nd)->first();
                        if ($code) {
                            $username = $code->username;

                            DB::table('history_bank')->insert([
                                'type' => 'tsr',
                                'username' => $username,
                                'thucnhan' => $sotien,
                                'status' => 'success',
                                'date' => date('Y-m-d H:i:s'),
                                'name' => $nhanorgui,
                                'tranid' => $mgd,
                                'created_at' => date('Y-m-d H:i:s'),
                            ]);

                            DB::table('users')->where('username', $username)->update([
                                'total_money' => $username->total_money + $sotien,
                                'total_charge' => $username->total_charge + $sotien,
                            ]);

                            DB::table('log_site')->insert([
                                'username' => $username,
                                'note' => 'Nạp tiền từ thesieure + ' . $sotien . 'vào tài khoản',
                                'created_at' => date('Y-m-d H:i:s'),
                            ]);
                            echo "true";
                        } else {
                            echo "NULL";
                        }
                    }
                }
            }
        }
    }
}
