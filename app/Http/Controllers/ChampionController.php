<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChampionController extends Controller
{
    public function getGuide(Request $request)
    {
        $champion = $request->query('champion', 'ガレン');
        $apiKey = env('OPENROUTER_API_KEY');
        
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'HTTP-Referer' => env('APP_URL', 'http://localhost'),
                'X-Title' => 'LoL Champion Guide',
                'Content-Type' => 'application/json',
            ])->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => 'anthropic/claude-3-haiku',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "{$champion}のリーグ・オブ・レジェンドのチャンピオンガイドを、初心者向けに詳細かつ具体的に作成してください。"
                    ]
                ]
            ]);

            $guide = $response->json();

            // JSONからガイドの内容を抽出
            $guideContent = $guide['choices'][0]['message']['content'] ?? 'ガイドが見つかりませんでした。';

            // レスポンスを直接返す（HTMLエスケープ）
            return response($guideContent)
                ->header('Content-Type', 'text/plain; charset=UTF-8');

        } catch (\Exception $e) {
            Log::error('API Request Failed', [
                'error' => $e->getMessage()
            ]);
            
            return response('エラーが発生しました: ' . $e->getMessage(), 500);
        }
    }
}