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
            $result = $logic->insertData($url);
        } catch (\Exception $e) {
            errorResponse($e->getCode(), $e);
        }
    }

    /**
     * 單筆詳細
     */
    public function getCrawler() {
        
    }

    /**
     * 列表
     */
    public function getCrawlList(Request $request, CrawlerLogic $logic) {
        $page = $request->input('page', 1);
        $size = $request->input('pageSize', 10);

        $data = $logic->getCrawlsListData($page, $size);

        return view('crawl.index', compact('data'));
    }
}
