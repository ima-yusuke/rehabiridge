<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class UserController extends Controller
{

    public $data =[
        ["id"=>1,"title"=>"Studio Mie Website","category"=>"Web Site","image"=>"pic-01.jpg"],
        ["id"=>2,"title"=>"Studio Mie Website","category"=>"Web Site","image"=>"pic-02.jpg"],
        ["id"=>3,"title"=>"Studio Mie Website","category"=>"Web Site","image"=>"pic-03.jpg"],
        ["id"=>4,"title"=>"Studio Mie Website","category"=>"Web Site","image"=>"pic-04.jpg"],
        ["id"=>5,"title"=>"Studio Mie Website","category"=>"Web Site","image"=>"pic-05.jpg"],
        ["id"=>6,"title"=>"Studio Mie Website","category"=>"Web Site","image"=>"pic-06.jpg"],
        ["id"=>7,"title"=>"Studio Mie Website","category"=>"Web Site","image"=>"pic-07.jpg"],
        ["id"=>8,"title"=>"Studio Mie Website","category"=>"Web Site","image"=>"pic-08.jpg"],
    ];

    public function ShowIndexPage()
    {
        $posts = Post::where('is_enabled', 1)->get();;
//        $data = $this->data;
        return view("index",compact("posts"));
    }
}
