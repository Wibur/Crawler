<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Logic\CrawlerLogic;


class CrawlerController extends Controller
{
    /**
     * crawl
     */
    public function crawl(Request $request, CrawlerLogic $logic) {
        $url = $request->input('url', 'https://www.symfony.com/blog/');

        try {
            $logic->insertData($url);
            return response()->json([], 200);
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            errorResponse($e->getCode(), $e);
        }
    }

    /**
     * 單筆詳細
     */
    public function getCrawler(Request $request, CrawlerLogic $logic) {
        $id = $request->input('id');

        try {
            $result = $logic->getCrawler($id);
        } catch (\Exception $e) {
            errorResponse($e->getCode(), $e);
        }
    }

//    public function testScreen(CrawlerLogic $logic) {
//        try {
//            return $logic->screenshotGoogle();
//        } catch (\Exception $e) {
//            dd($e->getMessage());
//        }
//    }

    /**
     * 列表
     */
    public function getCrawlList(Request $request, CrawlerLogic $logic) {
//        $page = $request->input('page', 1);
        $size = $request->input('pageSize', 10);

        $data = $logic->getCrawlsListData($size);

        return compact('data');
    }
}
