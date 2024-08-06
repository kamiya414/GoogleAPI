<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;

use App\Models\Category;

class PostController extends Controller
{
     public function index()
    {
        
         return view('posts.index');
        // return view('posts.index')->with(['post' => $post->get]);  
        //getPaginateByLimit()はPost.phpで定義したメソッドです。
        
    }
    public function show(Request $request)
    {
        $input = $request->all();
        $post=$input['post'];
        
        $prompt=
        "旅行の概要
        テーマ： {$post['theme']}
        誰と： {$post['who']}
        日時:  {$post['starttime']}～ {$post['endtime']}
        出発地: {$post['departure']}
        目的地:{$post['destination']}
        人数: {$post['num_of_people']}人
        移動手段: {$post['transportation']}
        予算:{$post['minimum']} 円～{$post['max']}円
        出発時刻は{$post['starttime']}
        帰宅時刻は{$post['endtime']}";
        
        
        return view('posts.show')->with(['prompt' => $prompt]);  
        //getPaginateByLimit()はPost.phpで定義したメソッドです。
        
    }
}