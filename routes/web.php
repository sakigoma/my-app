<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// トップページ
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/article', [ArticleController::class, 'index'])->name('article');

// 投稿作成
Route::get('post/create', [PostController::class, 'create'])->middleware(['auth', 'admin']);

// 投稿データ保存
Route::post('post', [PostController::class, 'store'])->name('post.store');

// 一覧画面
Route::get('post', [PostController::class, 'index']);

// 個別投稿表示
Route::get('post/show/{post}', [PostController::class, 'show'])->name('post.show');

// 編集画面表示
Route::get('post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');

// 更新
Route::patch('post/{post}', [PostController::class, 'update'])->name('post.update');

// Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

// Language Switcher Route 言語切替用ルート
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);

    return redirect()->back();
});
