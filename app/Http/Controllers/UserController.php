<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class UserController extends Controller
{

    public function ShowIndexPage()
    {
        $posts = Post::where('is_enabled', 1)->get();;
        return view("index",compact("posts"));
    }
}
