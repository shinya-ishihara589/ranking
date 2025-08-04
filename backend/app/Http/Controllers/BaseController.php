<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;

abstract class BaseController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    private $event;

    function __construct(Request $request)
    {
        $action = Route::current()->getAction();
        $controller = $action['controller'] ?? null;

        if ($controller) {
            list($controllerName, $methodName) = explode('@', $controller);
            $controllerName = class_basename($controllerName);

            $this->event = [
                'controller' => $controllerName,
                'method' => $methodName,
            ];
        }
        $this->storeSessionLog($request);
    }

    /**
     * パスワードを生成する
     * @param Integer パスワードの文字数
     * @return String パスワード
     */
    protected function getPassword($num): string
    {
        //パスワードを生成する
        $password = Str::random($num);
        return $password;
    }

    /**
     * セッション処理を記録する
     * @param Object $request リクエスト情報
     */
    private function storeSessionLog(Request $request): void
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
        $session->event = $this->event['controller'] . ':' . $this->event['method'];
        $session->ip = $request->ip();
        $session->device = $deviceInfoString;
        $session->save();
    }
}
