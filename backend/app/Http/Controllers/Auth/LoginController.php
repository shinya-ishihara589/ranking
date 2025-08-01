<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */


    /**
     * ログイン処理を行う
     * @param Object $request ログイン情報
     * @return Object ホーム画面 又は ログイン画面
     */
    public function showLoginForm(): object
    {
        return view('auth.login');
    }

    /**
     * ログイン処理を行う
     * @param Object $request ログイン情報
     * @return Object ホーム画面 又は ログイン画面
     */
    public function login(Request $request): object
    {
        // ログイン情報を取得する
        $credentials = $request->only('email', 'password');

        // ログインが正常に行われた場合はホーム画面に遷移する
        if (Auth::attempt($credentials)) {
            // セッション処理を登録する
            $this->storeSessionLog($request, 'LOGIN');
            return redirect('');
        }

        return redirect('/login');
    }

    /**
     * ログアウト処理を行う
     * @return Object $request ログイン画面
     */
    public function logout(Request $request): object
    {
        // セッション処理を登録する
        $this->storeSessionLog($request, 'LOGOUT');

        // ログアウト処理を行う
        Auth::logout();
        return redirect('/login');
    }

    /**
     * セッション処理を記録する
     * @param Object $request リクエスト情報
     * @param String $event イベント情報
     */
    private function storeSessionLog(Request $request, string $event): void
    {
        // デバイス情報を取得する
        $agent = new Agent;
        $agent->setUserAgent($request->header('User-Agent'));
        $deviceInfo = [
            'browser' => $agent->browser(),                             // ブラウザ名
            'browser_version' => $agent->version($agent->browser()),    // ブラウザのバージョン
            'platform' => $agent->platform(),                           // OS
            'platform_version' => $agent->version($agent->platform()),  // OSのバージョン
            'device' => $agent->device(),                               // デバイス名
            'is_mobile' => $agent->isMobile(),                          // モバイルデバイス
            'is_tablet' => $agent->isTablet(),                          // タブレット
            'is_desktop' => $agent->isDesktop(),                        // デスクトップ
        ];

        // デバイス情報をJson形式に変更する
        $deviceInfoString = json_encode($deviceInfo);

        // セッション情報を登録する
        $session = new Session;
        $session->user_id = Auth::id();
        $session->event = $event;
        $session->ip = $request->ip();
        $session->device = $deviceInfoString;
        $session->save();
    }
}
