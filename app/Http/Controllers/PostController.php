<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Models\Category;

class PostController extends Controller
{
    //
    public function map(){
        return view('maps.map');
    }
    
    public function create(Category $category){
        return view('posts.create')->with('categories',$category->get());
    }
    
    public function posts(){
        return view('maps.map');
    }
    
    public function store(PostRequest $request, Post $post){
        //写真以外をDBの項目に当てはめる
        $input_post=$request['post'];
        $post->title=$input_post['title'];
        $post->temple=$input_post['temple'];
        $post->comment=$input_post['comment'];
        //カテゴリーの処理
        $post_categories=$request->categories_array;
        
        //写真をstorage/uploadに保存、場所のurlを作成
        $image_url=$request->file('image')->storeAs('public/upload',$post->id.".jpg");
        //写真のurlをDBに保存
        $post->image=$image_url;
        
        
        $post->save();
        $post->categories()->attach($post_categories);
        //リダイレクト 後で書き直すこと('/posts/'.$post->id)
        return redirect('maps.map'); 
    }
}
