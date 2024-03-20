<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * コメント情報を追加する
     * @param Request コメント情報
     */
    public function send(Request $request, $parent_id = null)
    {
        //ユーザーIDの取得する
        $userId = Auth::id();

        //コメントを追加する
        $comment = new Comment;
        $comment->parent_id = $parent_id;
        $comment->user_id = $userId;
        $comment->comment = $request->comment;
        $comment->ip = $request->ip();
        $comment->save();
    }
}
