<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;

class UserController extends Controller
{

    public function ShowIndexPage()
    {
        $posts = Post::where('is_enabled', 1)->with('categories')->get();
        $categories = Category::all(); // 全てのカテゴリを取得
        return view("index",compact("posts","categories"));
    }
}
