<?php

namespace App\Http\Controllers;

use App\Models\Apply;
use App\Http\Requests\ApplyFormRequest;
use Illuminate\Support\Facades\Auth;

class ApplyController extends Controller
{
    /**
     * 項目情報を追加する
     * @param Request 項目情報
     */
    public function send(ApplyFormRequest $request)
    {
        //ユーザーIDの取得する
        $userId = Auth::id();

        //申請を追加する
        $item = new Apply;
        $item->type = $request->send_apply_type;
        $item->user_id = $userId;
        $item->item_id = $request->item_id;
        $item->text = $request->send_apply_text;
        $item->ip = $request->ip();
        $item->save();
    }
}
