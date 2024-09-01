<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use App\Models\Place;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function test(){
        return view('maps.test');
    }
    

    public function detail(){
        return view('maps.detail');
    }
    

    public function map(Post $post){
        return view('maps.map')->with(['posts'=>$post->getBylimit()]);
    }
    
    public function create(Category $category,  Place $place){
        return view('posts.create')->with(['categories'=>$category->get(),'places'=>$place->get() ]);
        
    }
    
    public function posts(){
        return view('maps.map');
    }
    
    public function show(Post $post){
         return view('posts.show')->with(['post'=>$post]);
    }
    
    public function store(PostRequest $request){
        //写真以外をDBの項目に当てはめる
        
        $input_post=$request['post'];
        $post = new Post;
        $post->title = $input_post['title'];
        $post->temple = $input_post['temple'];
        $post->comment = $input_post['comment'];
        $post->user_id = Auth::id();
        $post->place_id = $input_post['place_id'];
        
        //写真をstorage/uploadに保存、場所のurlを作成 やり方がわからない　相談事項
        $image_url=$request->file('image')->storeAs('public/upload',3 .".jpg");
        //写真のurlをDBに保存
        $post->image=str_replace('public/', 'storage/',$image_url);
        $post->save();
        //カテゴリーの処理
        $input_categories=$request->categories_array;
        $post->categories()->attach($input_categories);
        //リダイレクト 後で書き直すこと('/posts/'.$post->id)
        return redirect('/posts/' . $post->id); 
    }
}
