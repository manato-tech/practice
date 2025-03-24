<?php

use App\Http\Controllers\LolController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageAnalysisController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScraperController;

Route::get('/scrape-data', [App\Http\Controllers\ScraperController::class, 'getScrapedData'])->name('scrape.data');

Route::get('/scrape', [ScraperController::class, 'getScrapedData'])->name('scrape.data');





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
