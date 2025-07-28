<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmpUser extends Model
{
    use HasFactory;

    public $timestamps = false; //自動タイムスタンプをオフにする

    protected $fillable = ['id', 'tmp_user', 'tmp_email', 'onetime_password', 'datetime', 'ip'];
}
