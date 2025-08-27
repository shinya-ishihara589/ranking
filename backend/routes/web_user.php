<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\TmpRegisterController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ApplyController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

// 認証前
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login'); // ログイン画面
    Route::post('/login', [LoginController::class, 'login']);                       // ログイン処理
    Route::post('/tmp_register', [TmpRegisterController::class, 'tmpRegister']);    // 仮登録処理
    Route::post('/register', [RegisterController::class, 'register']);              // 登録処理
});

// 認証後
Route::middleware('auth')->group(function () {

    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout'); // ログイン画面
    // ホーム
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::post('/', [HomeController::class, 'get']);

    // ランキング
    Route::get('/ranking/{itemId?}', [RankingController::class, 'index'])->name('ranking.index');
    Route::post('/ranking/{itemId?}', [RankingController::class, 'get']);
    Route::post('/ranking/vote/{voteId?}', [RankingController::class, 'vote']);
    Route::post('/item/{itemId?}', [ItemController::class, 'store']);
    Route::post('/apply/send', [ApplyController::class, 'send']);

    // 検索
    Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search.index');
    Route::post('/search', [App\Http\Controllers\SearchController::class, 'get']);

    // 通知
    Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications', [App\Http\Controllers\NotificationController::class, 'get']);

    // 議論
    Route::get('/discussions', [App\Http\Controllers\DiscussionController::class, 'index'])->name('discussions.index');
    Route::get('/discussions/{discussionId}', [App\Http\Controllers\DiscussionController::class, 'detail'])->name('discussions.detail');

    // プロフィール
    Route::get('/profile/{userId}', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/{userId}', [App\Http\Controllers\ProfileController::class, 'get']);
    Route::post('/profile/{userId}', [App\Http\Controllers\ProfileController::class, 'update']);
    Route::get('/friends/{userId}', [App\Http\Controllers\FriendController::class, 'index']);

    // 設定
    // Route::get('/setting', [App\Http\Controllers\SettingController::class, 'index'])->name('setting.index');
    // Route::post('/setting', [App\Http\Controllers\SettingController::class, 'update']);

    // コメント
    Route::post('/comments/send/{parent_id?}', [App\Http\Controllers\CommentController::class, 'send']);
});
