<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\api\tools\getUIDController;
use App\Http\Controllers\api\callback\TheSieuRe;
use App\Http\Controllers\api\callback\MbBank;
use App\Http\Controllers\api\callback\Momo;
use App\Http\Controllers\api\callback\VietComBank;
use App\Http\Controllers\api\callback\Tsr;
use App\Http\Controllers\api\cron\upgradeLevel;
use App\Http\Controllers\api\cron\Transfer_Code;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('tools/getUID', function(){
    abort(403, 'Method Not Allowed');
});
Route::post('/tools/getUID', [getUIDController::class, 'getUID'])->name('tools.getUID');

Route::prefix('/cron')->group(function () {
    Route::get('/upgradeLevel', [upgradeLevel::class, 'upgradeLevel'])->name('cron.upgradeLevel');
    Route::get('/transfer_code', [Transfer_Code::class, 'transfer_code'])->name('cron.transfer_code');
});

Route::prefix('/callback')->group(function () {
    //card
    Route::get('tsr', [TheSieuRe::class, 'callback']);
    //banking
    Route::get('mbbank', [MbBank::class, 'callback']);
    Route::get('momo', [Momo::class, 'callback']);
    Route::get('vcb', [VietComBank::class, 'callback']);
    Route::get('tsrs', [Tsr::class, 'callback']);
});
