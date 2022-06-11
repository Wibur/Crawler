<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\CrawlerController;

// 爬蟲
Route::get('/crawler', [CrawlerController::class, 'crawl']);
// 取得細項
//Route::get('/getCrawler', [CrawlerController::class, 'getCrawler']);
// 取得列表
Route::get('/getCrawlerList', [CrawlerController::class, 'getCrawlList']);
Route::get('/crawl', function () {
    return view('crawl.index');
});
