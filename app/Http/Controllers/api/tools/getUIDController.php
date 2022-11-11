<?php

namespace App\Http\Controllers\api\tools;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class getUIDController extends Controller
{
    public function __construct()
    {
        /* 
        $this->middleware('auth:sanctum');
        $this->middleware('auth:api'); */
        $this->middleware('XSS');
    }

    public function getUID(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'link' => 'required|string|max:255',
        ],[
            'link.required' => 'Link không được để trống',
            'link.string' => 'Link phải là chuỗi',
            'link.max' => 'Link không được quá 255 ký tự'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 200);
        }else{
            $url = "https://id.traodoisub.com/api.php";
            $client = new Client();
            //params
            $params = [
                'link' => $request->link,
            ];
            $response = $client->request('POST', $url, [
                'form_params' => $params
            ]);
            $body = $response->getBody();
            $data = json_decode($body, true);
            if(isset($data['error'])){
                return response()->json([
                    'status' => false,
                    'message' => $data['error']
                ], 200);
            }else{
                return response()->json([
                    'status' => true,
                    'message' => $data['id']
                ], 200);
            }
            
        }
    }

}
