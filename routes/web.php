<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);

//ホーム
Route::get('/home/{mode?}', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
Route::post('/home/{mode?}', [App\Http\Controllers\HomeController::class, 'acquisition']);

//ランキング
Route::get('/ranking/{mode}/{itemId?}', [App\Http\Controllers\RankingController::class, 'index'])->name('ranking.index');
Route::post('/ranking/{mode}/{itemId?}', [App\Http\Controllers\RankingController::class, 'acquisition']);
Route::post('/ranking/{mode}/{voteId}/{itemId?}', [App\Http\Controllers\RankingController::class, 'vote']);

Route::post('/item/add/{mode}/{itemId?}', [App\Http\Controllers\RankingController::class, 'store']);
Route::post('/apply/send', [App\Http\Controllers\ApplyController::class, 'send']);

//検索
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search.index');
Route::post('/search', [App\Http\Controllers\SearchController::class, 'acquisition']);

//通知
Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/{id}', [App\Http\Controllers\NotificationController::class, 'store']);

//議論
Route::get('/discussions', [App\Http\Controllers\DiscussionController::class, 'index'])->name('discussions.index');
Route::get('/discussions/{discussionId}', [App\Http\Controllers\DiscussionController::class, 'detail'])->name('discussions.detail');

//プロフィール
Route::get('/profile/{userId}', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update']);
Route::get('/friends/{userId}', [App\Http\Controllers\FriendController::class, 'index']);

//設定
Route::get('/setting', [App\Http\Controllers\SettingController::class, 'index'])->name('setting.index');
Route::post('/setting', [App\Http\Controllers\SettingController::class, 'update']);

//コメント
Route::post('/comments/send/{parent_id?}', [App\Http\Controllers\CommentController::class, 'send']);

//ログアウト
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
