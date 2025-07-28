<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * 投票に紐づく親項目をリレーションする
     * @return Database 投票に紐づく親項目
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
