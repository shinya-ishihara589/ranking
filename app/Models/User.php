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

    public function friends()
    {
        return $this->hasMany(Friend::class, 'user_id', 'id');
    }

    /**
     * ユーザーに紐づくプロフィールを取得する
     */
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    /**
     * ユーザーに紐づくプロフィールを取得する
     */
    public function status()
    {
        return $this->hasOne(Status::class, 'user_id', 'id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    /**
     * 管理者であることを確認する
     */
    public function isAdmin()
    {
        return $this->role === Constract::ADMIN;
    }

    /**
     * ユーザーであることを確認する
     */
    public function isUser()
    {
        return $this->role === Constract::USER;
    }
}
