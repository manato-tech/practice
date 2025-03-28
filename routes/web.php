<?php

use App\Http\Controllers\LolController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageAnalysisController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScraperController;
use App\Http\Controllers\DeepSeekController;


use App\Http\Controllers\ChampionController;

Route::get('/champion-guide', [ChampionController::class, 'getGuide']);
//Route::get('/scrape', [ScraperController::class, 'getScrapedData'])->name('scraper.getScrapedData');
//Route::get('/scrape-data', [ScraperController::class, 'getScrapedData'])->name('scrape.data');
Route::get('/deepseek/champion-guide', [DeepSeekController::class, 'getChampionGuide'])->name('deepseek.champion-guide');
Route::post('/deepseek/guide', [DeepSeekController::class, 'getGuide'])->name('deepseek.guide');

//名前はべつにしないといかんらしい
Route::get('/scrape', [ScraperController::class, 'getScrapedData'])->name('scrape.data');
Route::get('/scrape/blonze', [ScraperController::class, 'getScrapedData_blonze'])->name('scrape.data_blonze');
Route::get('/scrape/silver', [ScraperController::class, 'getScrapedData_silver'])->name('scrape.data_silver');
Route::get('/scrape/gold', [ScraperController::class, 'getScrapedData_gold'])->name('scrape.data_gold');

Route::get('/scrape/lola/iron', [ScraperController::class, 'getScrapedData_lola_iron'])->name('scrape.data_lola_iron');
Route::get('/scrape/lola/blonze', [ScraperController::class, 'getScrapedData_lola_blonze'])->name('scrape.data_lola_blonze');
Route::get('/scrape/lola/silver', [ScraperController::class, 'getScrapedData_lola_silver'])->name('scrape.data_lola_silver');
Route::get('/scrape/lola/gold', [ScraperController::class, 'getScrapedData_lola_gold'])->name('scrape.data_lola_gold');

// routes/web.php に追加
Route::get('/scrape/data-ugg-iron', [ScraperController::class, 'scrapedData_ugg_iron'])->name('scrape.data_ugg_iron');

// Home route
Route::get('/', function () {
    return view('home');
})->name('home');

// Scraping route
Route::get('/scrape-data', [ScraperController::class, 'getScrapedData'])->name('scrape.data');



// 🔹 投稿関連ルート (posts)
//Route::middleware(['auth'])->group(function () {
 //   Route::resource('post', PostController::class);
  //  Route::get('/post/search', [PostController::class, 'search'])->name('post.search');

//});
Route::get('/post/lol', [LolController::class, 'lol'])->name('lol.lol');

Route::get('/post/search', [PostController::class, 'search'])->name('post.search');


Route::middleware(['auth'])->group(function () {
    Route::resource('post', PostController::class);
});


// 🔹 画像分析関連
Route::post('/image/analyze', [ImageAnalysisController::class, 'analyze'])->name('image.analyze');
Route::post('/image/save-analysis', [ImageAnalysisController::class, 'saveAnalysis'])->name('image.save-analysis');

// 🔹 認証関連
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🔹 その他
Route::get('/test', [TestController::class, 'test'])->name('test');
Route::get('/', function () {
    return view('welcome');
});

// 🔹 ダッシュボード (認証済みのみ)
Route::get('/dashboard', function () {
   return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
