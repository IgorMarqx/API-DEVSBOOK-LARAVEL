<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $loggedUser;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->loggedUser = auth()->user();
    }

    public function read()
    {
    }

    public function update()
    {
        $array = ['error' => ''];

        

        return $array;
    }

    public function updateAvatar()
    {
    }

    public function updateCover()
    {
    }
}
