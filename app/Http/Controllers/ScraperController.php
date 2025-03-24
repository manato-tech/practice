<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Log;

class ScraperController extends Controller
{
    public function getScrapedData()
    {
        try {
            $url = 'https://www.op.gg/champions/garen/build?hl=ja_JP&tier=iron'; // 取得するページのURL

            // HTTPクライアントを作成
            $client = HttpClient::create([
                'headers' => ['User-Agent' => 'Mozilla/5.0'],
                'verify_peer' => false
            ]);

            // ページ取得
            $response = $client->request('GET', $url);
            $html = $response->getContent();

            // HTMLをログに記録（デバッグ用）
            Log::info('Scraped HTML: ' . substr($html, 0, 500));

            // DOM解析
            $crawler = new Crawler($html);

            // h1タグのテキストを取得
            $title = $crawler->filter('h1')->count() > 0
                ? $crawler->filter('h1')->text()
                : 'タイトルが見つかりません';

            // pタグの最初の要素を取得
            $description = $crawler->filter('p')->count() > 0
                ? $crawler->filter('p')->first()->text()
                : '説明文が見つかりません';

            return response()->json([
                'title' => $title,
                'description' => $description,
            ]);
        } catch (\Exception $e) {
            Log::error('Scraping error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
