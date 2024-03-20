<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $timestamps = false; //自動タイムスタンプをオフにする

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
