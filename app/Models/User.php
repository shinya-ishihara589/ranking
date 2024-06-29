<?php

namespace App\Models;

use App\Constract;
use App\Models\Comment;
use App\Models\Friend;
use App\Models\Profile;
use App\Models\Status;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * ユーザーに紐づくフレンド情報を全て取得する
     * @return Object ユーザーに紐づくフレンド情報全て
     */
    public function friends(): object
    {
        return $this->hasMany(Friend::class, 'user_id', 'id');
    }

    /**
     * ユーザーに紐づくプロフィール情報を取得する
     * @return Object ユーザーに紐づくプロフィール情報
     */
    public function profile(): object
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    /**
     * ユーザーに紐づくステータス情報を取得する
     * @return Object ユーザーに紐づくステータス情報
     */
    public function status(): object
    {
        return $this->hasOne(Status::class, 'user_id', 'id');
    }

    /**
     * ユーザーに紐づく投票情報を全て取得する
     * @return Object ユーザーに紐づく投票情報
     */
    public function votes(): object
    {
        return $this->hasMany(Vote::class, 'user_id', 'id');
    }

    /**
     * ユーザーに紐づくコメント情報を全て取得する
     * @return Object ユーザーに紐づくコメント情報
     */
    public function comments(): object
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    /**
     * 管理者であることを確認する
     * @return Boolean 
     */
    public function isAdmin(): bool
    {
        return $this->role === Constract::ADMIN;
    }

    /**
     * ユーザーであることを確認する
     */
    public function isUser(): bool
    {
        return $this->role === Constract::USER;
    }
}
