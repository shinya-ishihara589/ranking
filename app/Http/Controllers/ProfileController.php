<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * プロフィール画面に遷移する
     * @param Integer ユーザーID
     * @return Object プロフィール情報
     */
    public function index(int $userId): object
    {
        //ユーザーを取得する
        $userData = User::with(['profile'])->find($userId);

        //プロフィール情報を取得する
        $profileModel = new Profile;
        $profileData = $profileModel->getProfileData($userId, 0);

        return view('profile.index', compact(['userData', 'profileData']));
    }

    /**
     * プロフィール画面に遷移する
     * @param Object プロフィール情報
     * @return Array プロフィール情報
     */
    public function update(Request $request): array
    {
        //ファイル情報を取得する
        $bannerFile = $request->file('banner_file');
        $iconFile = $request->file('icon_file');

        //ユーザーIDを取得する
        $authUser = Auth::user();

        //プロフィールを取得する
        $profileData = Profile::find($authUser->id);

        //プロフィールを更新する
        $profileData->name = $request->name;
        $profileData->self_introduction = $request->self_introduction;

        //バナーファイルを保存する
        if ($bannerFile) {
            $profileData->banner_path = 'banner.jpg';
            Storage::putFileAs("/public/users/{$authUser->user_id}/", $bannerFile, 'banner.jpg');
        }

        //アイコンファイルを保存する
        if ($iconFile) {
            $profileData->icon_path = 'icon.jpg';
            Storage::putFileAs("/public/users/{$authUser->user_id}/", $iconFile, 'icon.jpg');
        }
        $profileData->save();

        return compact(['profileData']);
    }

    /**
     * ホームの追加情報を取得する
     * @param Object ホーム取得情報
     * @param String 画面の種類
     * @return Array ホームの追加情報
     */
    public function acquisition(Request $request, $userId): array
    {
        //プロフィールの追加情報を取得する
        $profileModel = new Profile;
        $profileData = $profileModel->getProfileData($request->offset);

        return compact(['profileData']);
    }
}
