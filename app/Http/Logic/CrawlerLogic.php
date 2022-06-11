<?php

namespace App\Http\Logic;

// use Spatie\Browsershot\Browsershot;
use Goutte\Client;
use App\Models\Crawls;

class CrawlerLogic
{
    private $crawlModel;
    public function __construct(Crawls $crawls) {
        $this->crawlModel = $crawls;
    }

    public function insertData(string $url) {
        $client = new Client();
        $crawler = $client->request('GET', $url);
        // 通常只有一個 取第一個為主
        $title = $crawler->filter('title')->eq(0)->text();
        $description = $crawler->filterXpath('//meta[@name="description"]')->attr('content');
        // $body;
        
        $insertData = [
            'screenshot' => $screenshot ?? '',
            'link' => $url,
            'title' => $title ?? '',
            'body' => $body ?? '',
            'description' => $description ?? '',
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $isCreated = $this->crawlModel->insert($insertData);

        if ($isCreated === false) {
            throw new \Exception('新增失敗', 500);
        }
    }

    public function getCrawlsListData(int $page = 1, int $size = 10) {
        return $this->crawlModel->getCrawlsList($page, $size);
    }

    // public function screenshotGoogle() {
    //     Browsershot::url('https://google.com')
    //             ->noSandbox()
    //             ->setOption('landscape', true)
    //             ->windowSize(2048, 980)
    //             ->waitUntilNetworkIdle()
    //             ->save("storage/" . 'googlescreenshot.jpg');
    // }
    

}