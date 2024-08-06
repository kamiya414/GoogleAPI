<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use GeminiAPI\Client;
use GeminiAPI\Resources\Parts\TextPart;

use App\Models\Category;

class PostController extends Controller
{
     public function index() #条件を記載するページを表示
    {
       
         return view('posts.index');
   
        
    }
    
    
    
    public function show(Request $request) #geminiにデータを渡し返答を画面に表示する。
    {
        
        $input = $request->all();
        $post=$input['post'];
        
        #promptはgeminiに渡す文字列（#formに渡したデータを文字列に組み込む）
        $prompt=
        "おすすめの旅行の日程を作成してください。
        場所の名前を「」で囲って表示してください。
        信憑性の高い情報のみ利用して
        テーマ： {$post['theme']}
        誰と： {$post['who']}
        日時:  {$post['starttime']}～ {$post['endtime']}
        出発地: {$post['departure']}
        目的地:{$post['destination']}
        人数: {$post['num_of_people']}人
        移動手段: {$post['transportation']}
        予算:下限値{$post['minimum']} 円～上限値{$post['max']}円
        出発時刻は{$post['starttime']}
        帰宅時刻は{$post['endtime']}
        
        タイムスケジュール詳細にお願いします。
        営業時間や移動時間を考慮して時間はかなり多めに見積もって
        
        
        ";
        // dd($prompt);
        
         // geminiの回答を取得
        $client = new Client('AIzaSyDuLSB2pK_aBaDkNxhW4XjGccv_B9kGqv8'); #APIキーを渡す
        
       
        $response = $client->geminiPro()->generateContent(
        	new TextPart($prompt),
        );
        
        $response=$response->text();
        
         #*が文字列の中に入っているので削除する
        $response = str_replace('*', '', $response);
       
    	 		
    	#stringに含まれるURLをリンク化
        $pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
        $replace = '<a href="$1">$1</a>';
        $response    = preg_replace( $pattern, $replace, $response );
    // dd($response);
    
        #「」でキーワードを囲うよう指示済み。「」の中だけを$txrとして取得
        $txt=preg_match_all('/「(.*?)」/', $response, $matches);
        $txt=$matches[1];
        
        
        #同じ文字列は一つに絞る
        #Google画像検索apiにキーワードをそれぞれ渡し画像を表示
        #googleで公式サイトのurlを取得したい

        return view('posts.show')->with(['prompt' => $response,'text'=>$txt]);  
        //getPaginateByLimit()はPost.phpで定義したメソッドです。
        
    }
}