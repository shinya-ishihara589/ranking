<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileFormRequest;

class ProfileController extends Controller
{
    /**
     * プロフィール画面に遷移する
     * @param String ユーザーID
     * @return Object プロフィール情報
     */
    public function index(string $userId): object
    {
        //ユーザーを取得する
        $userData = User::with(['profile'])->where('user_id', $userId)->first();

        //プロフィール情報を取得する
        $profileModel = new Profile;
        $profileData = $profileModel->getProfileData($userData->id);

        return view('profile.index', compact(['userData', 'profileData']));
    }

    /**
     * プロフィール画面に遷移する
     * @param Object プロフィール情報
     * @return Array プロフィール情報
     */
    public function update(ProfileFormRequest $request): array
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
     * プロフィールの追加情報を取得する
     * @param Object プロフィール取得情報
     * @param String ユーザーID
     * @return Array プロフィールの追加情報
     */
    public function get(Request $request, string $userId): array
    {
        //ユーザーを取得する
        $userData = User::with(['profile'])->where('user_id', $userId)->first();

        //プロフィールの追加情報を取得する
        $profileModel = new Profile;
        $profileData = $profileModel->getProfileData($userData->id, $request->offset);

        return compact(['profileData']);
    }
}
