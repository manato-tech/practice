<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PostController;

// routes/web.php に追加
Route::post('/image/analyze', [App\Http\Controllers\ImageAnalysisController::class, 'analyze'])->name('image.analyze');
Route::post('/image/save-analysis', [App\Http\Controllers\ImageAnalysisController::class, 'saveAnalysis'])->name('image.save-analysis');
Route::post('/image/save-analysis', [App\Http\Controllers\ImageAnalysisController::class, 'saveAnalysis'])->name('image.save-analysis');
Route::delete('post/{post}',[PostController::class,'destroy'])->name('post.destroy');
Route::get('post/{post}/edit',[PostController::class,'edit'])->name('post.edit');
Route::patch('post/{post}',[PostController::class,'update'])->name('post.update');
Route::get('post/show/{post}',[PostController::class,'show'])->name('post.show');

Route::post('post',[PostController::class,'store'])->name('post.store');
Route::get('post',[PostController::class,'index'])->name('post.index');

Route::get('post/create',[PostController::class,'create'])->name('post.create');
//>middleware(['auth','admin']);

Route::get('/test',[TestController::class,'test'])->name('test');

Route::get('/', function () {
    return view('welcome');
}); //追加site // 認証済みユーザーのみがアクセス可能


Route::get('/dashboard', function () {
   return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
