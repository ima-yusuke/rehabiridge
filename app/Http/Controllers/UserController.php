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
        $latestPost = Post::orderBy('updated_at', 'desc')->first();// 最新の更新日時を持つレコードを取得
        return view("index",compact("posts","categories","latestPost"));
    }

    public function ShowSelectedPage($id)
    {
        $selectedPost = Post::with('categories')->find($id);
        if (!$selectedPost) {
            return redirect()->route('ShowIndexPage')->with('error', 'Post not found.');
        }

        return view("selected-post",compact("selectedPost"));
    }

    public function SearchedPage($id)
    {
        $posts = Post::where('category', $id)
            ->where('is_enabled', 1)
            ->with('categories')
            ->get();
        $categories = Category::all(); // 全てのカテゴリを取得
        $latestPost = Post::orderBy('updated_at', 'desc')->first();// 最新の更新日時を持つレコードを取得
        $clear = true;
        return view("index",compact("posts","categories","latestPost","clear"));
    }
}
