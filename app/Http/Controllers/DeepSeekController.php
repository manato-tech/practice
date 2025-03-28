<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ChampionController extends Controller
{
    // 全データ取得を統合
    public function getData(Request $request)
    {
        $champion = $request->query('champion', 'garen');
        $tier = $request->query('tier', 'all');
        
        return Cache::remember("champion_{$champion}_{$tier}", 3600, function() use ($champion, $tier) {
            return [
                'stats' => $this->fetchStats($champion, $tier),
                'guide' => $this->fetchGuide($champion)
            ];
        });
    }

    // 統計データ取得（op.ggなどから）
    private function fetchStats($champion, $tier)
    {
        // 既存のスクレイピング処理を統合
        $sources = ['opgg', 'ugg', 'lolalytics'];
        $data = [];
        
        foreach ($sources as $source) {
            $response = Http::get("https://api.yoursite.com/scrape/{$source}", [
                'champion' => $champion,
                'tier' => $tier
            ]);
            
            $data[$source] = $response->json() ?? ['error' => 'Data not available'];
        }
        
        return $data;
    }

    // DeepSeekガイド取得
    private function fetchGuide($champion)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('DEEPSEEK_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.deepseek.com/v1/chat/completions', [
                'model' => 'deepseek-chat',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "League of Legendsで{$champion}の初心者向け戦い方を解説してください"
                    ]
                ],
                'temperature' => 0.7,
                'max_tokens' => 1000
            ]);

            return $response->json()['choices'][0]['message']['content'] ?? 'ガイドを生成できませんでした';
        } catch (\Exception $e) {
            return null;
        }
    }
}