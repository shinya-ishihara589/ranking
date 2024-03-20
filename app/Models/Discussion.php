<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;

    public $timestamps = false; //自動タイムスタンプをオフにする

    /**
     * 議論に紐づくコメントを全て取得する
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }

    /**
     * 議論に紐づくコメントを全て取得する
     */
    public function item()
    {
        return $this->hasOne(Item::class, 'id', 'item_id');
    }

    public static function search($request)
    {
        $discussions = Discussion::get();
        return $discussions;
    }
}
