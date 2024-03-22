<?php

use Illuminate\Support\Facades\Auth;

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

//ログイン
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'index']);
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

//ログアウト
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

//ユーザー登録
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

//ワンタイムパスワード発行
Route::post('/tmp_register', [App\Http\Controllers\Auth\RegisterController::class, 'tmpRegister']);

//以下ログインユーザーのみ実行可能
Auth::routes();

//ホーム
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
Route::post('/', [App\Http\Controllers\HomeController::class, 'get']);

//ランキング
Route::get('/ranking/{itemId?}', [App\Http\Controllers\RankingController::class, 'index'])->name('ranking.index');
Route::post('/ranking/{itemId?}', [App\Http\Controllers\RankingController::class, 'get']);
Route::post('/ranking/vote/{voteId?}', [App\Http\Controllers\RankingController::class, 'vote']);
Route::post('/item/add/{itemId?}', [App\Http\Controllers\ItemController::class, 'store']);
Route::post('/apply/send', [App\Http\Controllers\ApplyController::class, 'send']);

//検索
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search.index');
Route::post('/search', [App\Http\Controllers\SearchController::class, 'get']);

//通知
Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications', [App\Http\Controllers\NotificationController::class, 'get']);

//議論
Route::get('/discussions', [App\Http\Controllers\DiscussionController::class, 'index'])->name('discussions.index');
Route::get('/discussions/{discussionId}', [App\Http\Controllers\DiscussionController::class, 'detail'])->name('discussions.detail');

//プロフィール
Route::get('/profile/{userId}', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile/{userId}', [App\Http\Controllers\ProfileController::class, 'get']);
Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update']);
Route::get('/friends/{userId}', [App\Http\Controllers\FriendController::class, 'index']);

//設定
// Route::get('/setting', [App\Http\Controllers\SettingController::class, 'index'])->name('setting.index');
// Route::post('/setting', [App\Http\Controllers\SettingController::class, 'update']);

//コメント
Route::post('/comments/send/{parent_id?}', [App\Http\Controllers\CommentController::class, 'send']);
