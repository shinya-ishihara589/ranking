<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    public $timestamps = false; //自動タイムスタンプをオフにする
    
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'friend_id');
    }
}
