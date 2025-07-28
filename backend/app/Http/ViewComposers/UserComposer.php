<?php

namespace App\Http\ViewComposers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class UserComposer
 * @package App\Http\ViewComposers
 */
class UserComposer
{
    /**
     * Bind data to the view.
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        // ユーザーIDが存在する場合はユーザー情報を取得する
        if (!empty(Auth::id())) {
            // 90日前の日付を取得する
            $now = Carbon::now();
            $ninetyDaysAgo = $now->subDays(90);

            $view->with([
                'commons' => [
                    'user_id' => isset(Auth::user()->user_id) ? Auth::user()->user_id : null,
                    'name' => isset(Auth::user()->profile->name) ? Auth::user()->profile->name : null,
                    'is_change_password' => Auth::user()->password_set_at == null || isset(Auth::user()->password_set_at) && Auth::user()->password_set_at < $ninetyDaysAgo,
                ],
            ]);
        }
    }
}
