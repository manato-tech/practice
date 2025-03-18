<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class ImageAnalysisController extends Controller
{
    public function saveAnalysis(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'analysis_data' => 'required|json'
        ]);
        
        $post = Post::findOrFail($validated['post_id']);
        $post->ai_analysis = $validated['analysis_data'];
        $post->save();
        
        return response()->json(['success' => true]);
    }
    public function analyze(Request $request)
{
    // 基本的な画像分析のロジック
    $validated = $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'post_id' => 'required|exists:posts,id'
    ]);
    
    $image = $request->file('image');
    $imageInfo = getimagesize($image->path());
    $width = $imageInfo[0];
    $height = $imageInfo[1];
    
    // 画像の分析結果
    $result = [
        'width' => $width,
        'height' => $height,
        'dominant_tone' => $this->getDominantTone($image->path()),
        'avg_color' => $this->getAverageColor($image->path()),
        'brightness' => $this->getBrightness($image->path()),
    ];
    
    return response()->json([
        'success' => true,
        'result' => $result
    ]);
}

// 主要な色調を取得
private function getDominantTone($imagePath)
{
    // 簡略化した実装
    $img = imagecreatefromstring(file_get_contents($imagePath));
    $w = imagesx($img);
    $h = imagesy($img);
    
    $rTotal = $gTotal = $bTotal = 0;
    $total = 0;
    
    for ($x = 0; $x < $w; $x += 10) {
        for ($y = 0; $y < $h; $y += 10) {
            $rgb = imagecolorat($img, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            
            $rTotal += $r;
            $gTotal += $g;
            $bTotal += $b;
            $total++;
        }
    }
    
    $rAvg = $rTotal / $total;
    $gAvg = $gTotal / $total;
    $bAvg = $bTotal / $total;
    
    if ($rAvg > $gAvg && $rAvg > $bAvg) {
        return '赤系';
    } elseif ($gAvg > $rAvg && $gAvg > $bAvg) {
        return '緑系';
    } elseif ($bAvg > $rAvg && $bAvg > $gAvg) {
        return '青系';
    } else {
        return 'モノクロ系';
    }
}

// 平均色を取得
private function getAverageColor($imagePath)
{
    $img = imagecreatefromstring(file_get_contents($imagePath));
    $w = imagesx($img);
    $h = imagesy($img);
    
    $rTotal = $gTotal = $bTotal = 0;
    $total = 0;
    
    for ($x = 0; $x < $w; $x += 10) {
        for ($y = 0; $y < $h; $y += 10) {
            $rgb = imagecolorat($img, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            
            $rTotal += $r;
            $gTotal += $g;
            $bTotal += $b;
            $total++;
        }
    }
    
    $r = round($rTotal / $total);
    $g = round($gTotal / $total);
    $b = round($bTotal / $total);
    
    $hex = sprintf("#%02x%02x%02x", $r, $g, $b);
    
    return [
        'r' => $r,
        'g' => $g,
        'b' => $b,
        'hex' => $hex
    ];
}

// 明るさを取得
private function getBrightness($imagePath)
{
    $img = imagecreatefromstring(file_get_contents($imagePath));
    $w = imagesx($img);
    $h = imagesy($img);
    
    $brightnessTotal = 0;
    $total = 0;
    
    for ($x = 0; $x < $w; $x += 10) {
        for ($y = 0; $y < $h; $y += 10) {
            $rgb = imagecolorat($img, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            
            // 明るさの計算 (0-255)
            $brightness = (0.299 * $r + 0.587 * $g + 0.114 * $b);
            $brightnessTotal += $brightness;
            $total++;
        }
    }
    
    $avgBrightness = $brightnessTotal / $total;
    $category = '';
    
    if ($avgBrightness < 64) {
        $category = '暗い';
    } elseif ($avgBrightness < 128) {
        $category = 'やや暗い';
    } elseif ($avgBrightness < 192) {
        $category = 'やや明るい';
    } else {
        $category = '明るい';
    }
    
    return [
        'value' => round($avgBrightness, 2),
        'category' => $category
    ];
}
}