<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\Home;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class HomeAPIController extends Controller
{
    public function test()
    {
        $test = ['test' => 'test'];
        $test = json_encode($test);
        return $test;
    }
}
