<?php

namespace App\Models;

use App\Models\Vote;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    use HasFactory;

    public $timestamps = false; //自動タイムスタンプをオフにする

    /**
     * 項目IDに紐づく親項目をリレーションする
     * @return Database 項目IDに紐づく親項目
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * 項目IDに紐づく投票情報を全て取得する
     * @return Database 項目IDに紐づく投票情報
     */
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
