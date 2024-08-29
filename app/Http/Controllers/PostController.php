<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use GeminiAPI\Client;
use GeminiAPI\Resources\Parts\TextPart;




 class PostController extends Controller
{   
    
    public function Gemini(Request $request)
       {
        $input = $request->all();
        $post=$input['post'];
        
        
        #promptはgeminiに渡す文字列（#formに渡したデータを文字列に組み込む）
        $prompt=
        "おすすめの旅行プランを考えて
        テーマ：{$post['thema']}
        出発地：{$post['departure']}
        出発時間：{$post['departuredate']}/{$post['departuretime']}
        目的地：{$post['arrival']}
        帰宅時間：{$post['arrivaldate']}/{$post['hometime']}
        予算：{$post['upper']}～{$post['lower']}
        誰と：{$post['who']}
        人数：{$post['number']}
        移動手段：{$post['way']}
        時刻付きでタイムスケジュールを詳細に
        場所の名前を「」で囲って
        ";
        
       
        // dd($prompt);
        
         // geminiの回答を取得
        $client = new Client('AIzaSyB1jbTdH71Dle9q90Vopm8sugWF7AZkGxA'); #APIキーを渡す
        
       
        $response = $client->geminiPro()->generateContent(
        	new TextPart($prompt),
        );

        $response=$response->text(); //Geminiのレスポンス
        $response = str_replace('*', '', $response);
        
        $txts=preg_match_all('/「(.*?)」/', $response, $matches);
        $txts=$matches[1];
        
        
       
       return view('posts.Gemini')->with(['post' => $post,'response' => $response,'txts' => $txts]);
       }
      
    
    
    
    
    public function index(Post $post)
    {
       return view('posts.index')->with(['posts' => $post->getPaginateByLimit(1)]); 
    }
    public function show(Post $post)
    {
       return view('posts.show')->with(['post' => $post]);
    }
     
    public function create()
    {
    return view('posts.create');
    }
    public function store(PostRequest $request, Post $post)
    {
    $input = $request['post'];
    $post->fill($input)->save();
    return redirect('/posts/' . $post->id);
    }

    public function edit(Post $post)
    {
        return view('posts.edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
}


