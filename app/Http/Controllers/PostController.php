<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    public function test(Post $test)//インポートしたPostをインスタンス化して$postとして使用。
    {
        return $test->get();//$postの中身を戻り値にする。
}
}
