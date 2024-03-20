<?php

namespace App\Http\ViewComposers;

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
        if (!empty(Auth::id())) {
            $view->with([
                'commons' => [
                    'users' => [
                        'id' => Auth::id(),
                        'user_id' => Auth::user()->user_id,
                    ],
                    'profiles' => [
                        'id' => isset(Auth::user()->profile->id) ? Auth::user()->profile->id : null,
                        'name' => isset(Auth::user()->profile->name) ? Auth::user()->profile->name : null,
                        'icon_path' => isset(Auth::user()->profile->icon_path) ? Auth::user()->profile->icon_path : null,
                    ],
                ],
            ]);
        }
    }
}
