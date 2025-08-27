<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileFormRequest;

class ProfileController extends BaseController
{
    /**
     * プロフィール画面に遷移する
     * @param String ユーザーID
     * @return Object プロフィール情報
     */
    public function show(string $userId): object
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
    public function update(ProfileFormRequest $request, int $userId): array
    {
        //ファイル情報を取得する
        $bannerFile = $request->file('banner_file');
        $iconFile = $request->file('icon_file');

        //ユーザーIDを取得する
        return $authUser = Auth::user();

        dd($authUser);


        //プロフィールを取得する
        $profileData = Profile::find($authUser->id);

        //プロフィールを更新する
        $profileData->name = $request->edit_profile_name;
        $profileData->self_introduction = $request->edit_profile_self_introduction;

        //バナーファイルを保存する
        if ($bannerFile) {
            $uniqId = uniqid();
            $beforeBannerPath = $profileData->banner_path;
            $afterBannerPath = "{$uniqId}.jpg";
            Storage::putFileAs("/public/users/{$authUser->user_id}/", $bannerFile, $afterBannerPath);
            Storage::delete("/public/users/{$authUser->user_id}/{$beforeBannerPath}");
            $profileData->banner_path = $afterBannerPath;
        }

        //アイコンファイルを保存する
        if ($iconFile) {
            $uniqId = uniqid();
            $beforeIconPath = $profileData->icon_path;
            $afterIconPath = "{$uniqId}.jpg";
            Storage::putFileAs("/public/users/{$authUser->user_id}/", $iconFile, $afterIconPath);
            Storage::delete("/public/users/{$authUser->user_id}/{$beforeIconPath}");
            $profileData->icon_path = $afterIconPath;
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
