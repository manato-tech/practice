<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Log;

class ScraperController extends Controller
{
    public function getScrapedData(Request $request)
    {
        try {
            // Get champion name from request, default to 'garen' if not provided
            $champion = $request->query('champion', 'garen');
            
            // Build the URL with the champion name
            $url = "https://www.op.gg/champions/{$champion}/build?hl=ja_JP&tier=iron";
            
            // Log the URL (for debugging)
            Log::info('Scraping URL: ' . $url);
            
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
                'champion' => $champion, // Return the champion name for reference
                'tier' => 'iron', // Return the tier for reference
            ]);
        } catch (\Exception $e) {
            Log::error('Scraping error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getScrapedData_blonze(Request $request)
    {
        try {
            // Get champion name from request, default to 'garen' if not provided
            $champion = $request->query('champion', 'garen');
            
            // Build the URL with the champion name
            $url = "https://www.op.gg/champions/{$champion}/build?hl=ja_JP&tier=blonze";
            
            // Log the URL (for debugging)
            Log::info('Scraping URL: ' . $url);
            
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
                'champion' => $champion, // Return the champion name for reference
                'tier' => 'iron', // Return the tier for reference
            ]);
        } catch (\Exception $e) {
            Log::error('Scraping error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getScrapedData_silver(Request $request)
    {
        try {
            // Get champion name from request, default to 'garen' if not provided
            $champion = $request->query('champion', 'garen');
            
            // Build the URL with the champion name
            $url = "https://www.op.gg/champions/{$champion}/build?hl=ja_JP&tier=silver";
            
            // Log the URL (for debugging)
            Log::info('Scraping URL: ' . $url);
            
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
                'champion' => $champion, // Return the champion name for reference
                'tier' => 'iron', // Return the tier for reference
            ]);
        } catch (\Exception $e) {
            Log::error('Scraping error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getScrapedData_gold(Request $request)
    {
        try {
            // Get champion name from request, default to 'garen' if not provided
            $champion = $request->query('champion', 'garen');
            
            // Build the URL with the champion name
            $url = "https://www.op.gg/champions/{$champion}/build?hl=ja_JP&tier=gold";
            
            // Log the URL (for debugging)
            Log::info('Scraping URL: ' . $url);
            
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
                'champion' => $champion, // Return the champion name for reference
                'tier' => 'iron', // Return the tier for reference
            ]);
        } catch (\Exception $e) {
            Log::error('Scraping error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // まず、以下のパッケージをインストールする必要があります
// composer require nesk/puphpeteer

public function scrapedData_ugg_iron(Request $request) {
    try {
        $champion = $request->query('champion', 'garen');
        $url = "https://www.leagueofgraphs.com/ja/champions/stats/garen/iron";
        
        // HTTPクライアントを作成
        $client = HttpClient::create([
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36'
            ]
        ]);
        
        // ページ取得
        $response = $client->request('GET', $url);
        $html = $response->getContent();
        
        // DOM解析
        $crawler = new Crawler($html);
        
        // #graphDD2のIDを持つ要素を検索して、中のテキストを取得
        $winRate = '勝率が見つかりません';
        if ($crawler->filter('#graphDD2')->count() > 0) {
            $winRateText = trim($crawler->filter('#graphDD2')->text());
            // 数値+%のパターンを抽出
            if (preg_match('/(\d+\.\d+%)/', $winRateText, $matches)) {
                $winRate = $matches[1];
            } else {
                $winRate = $winRateText; // パターンに一致しない場合はテキストそのまま
            }
        } 
        // もし#graphDD2が見つからない場合、pie-chart-containerクラスから探す
        else if ($crawler->filter('.pie-chart-container .pie-chart')->count() > 0) {
            $pieCharts = $crawler->filter('.pie-chart-container .pie-chart');
            $pieCharts->each(function ($node) use (&$winRate) {
                $text = trim($node->text());
                if (preg_match('/(\d+\.\d+%)/', $text, $matches)) {
                    $winRate = $matches[1];
                }
            });
        }
        
        return response()->json([
            'champion' => $champion,
            'winRate' => $winRate,
            'status' => 'スクレイピング完了'
        ]);
    } catch (\Exception $e) {
        Log::error('スクレイピングエラー: ' . $e->getMessage());
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    public function getScrapedData_lola_iron(Request $request)
    {
        try {
            // Get champion name from request, default to 'garen' if not provided
            $champion = $request->query('champion', 'garen');
            
            // Build the URL with the champion name
            $url = "https://lolalytics.com/ja/lol/{$champion}/build/?tier=iron";
            
            // Log the URL (for debugging)
            Log::info('Scraping URL: ' . $url);
            
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
                'champion' => $champion, // Return the champion name for reference
                'tier' => 'iron', // Return the tier for reference
            ]);
        } catch (\Exception $e) {
            Log::error('Scraping error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getScrapedData_lola_blonze(Request $request)
    {
        try {
            // Get champion name from request, default to 'garen' if not provided
            $champion = $request->query('champion', 'garen');
            
            // Build the URL with the champion name
            $url = "https://lolalytics.com/ja/lol/{$champion}/build/?tier=bronze";
            
            // Log the URL (for debugging)
            Log::info('Scraping URL: ' . $url);
            
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
                'champion' => $champion, // Return the champion name for reference
                'tier' => 'iron', // Return the tier for reference
            ]);
        } catch (\Exception $e) {
            Log::error('Scraping error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function getScrapedData_lola_silver(Request $request)
    {
        try {
            // Get champion name from request, default to 'garen' if not provided
            $champion = $request->query('champion', 'garen');
            
            // Build the URL with the champion name
            $url = "https://lolalytics.com/ja/lol/{$champion}/build/?tier=silver";
            
            // Log the URL (for debugging)
            Log::info('Scraping URL: ' . $url);
            
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
                'champion' => $champion, // Return the champion name for reference
                'tier' => 'iron', // Return the tier for reference
            ]);
        } catch (\Exception $e) {
            Log::error('Scraping error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getScrapedData_lola_gold(Request $request)
    {
        try {
            // Get champion name from request, default to 'garen' if not provided
            $champion = $request->query('champion', 'garen');
            
            // Build the URL with the champion name
            $url = "https://lolalytics.com/ja/lol/{$champion}/build/?tier=gold";
            
            // Log the URL (for debugging)
            Log::info('Scraping URL: ' . $url);
            
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
                'champion' => $champion, // Return the champion name for reference
                'tier' => 'iron', // Return the tier for reference
            ]);
        } catch (\Exception $e) {
            Log::error('Scraping error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}