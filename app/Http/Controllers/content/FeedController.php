<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    private $loggedUser;

    public function __construct()
    {
        $this->middleware('auth:api', );
        $this->loggedUser = auth()->user();
    }

    public function read()
    {
    }

    public function create()
    {
    }

    public function userFeed()
    {
    }
}
