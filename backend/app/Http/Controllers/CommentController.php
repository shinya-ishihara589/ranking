<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\CommentFormRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * コメント情報を追加する
     * @param Request コメント情報
     */
    public function send(CommentFormRequest $request, $parent_id = null)
    {
        //ユーザーIDの取得する
        $userId = Auth::id();

        //コメントを追加する
        $comment = new Comment;
        $comment->parent_id = $parent_id;
        $comment->user_id = $userId;
        $comment->comment = $request->send_comment_comment;
        $comment->ip = $request->ip();
        $comment->save();
    }
}
