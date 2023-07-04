<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function read()
    {
    }

    public function update()
    {
    }

    public function updateAvatar()
    {
    }

    public function updateCover()
    {
    }
}
