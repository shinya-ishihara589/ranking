<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Onetime extends Model
{
    use HasFactory;

    public $timestamps = false; //自動タイムスタンプをオフにする

    protected $fillable = ['id', 'user_id', 'onetime_password', 'datetime', 'ip'];
}
