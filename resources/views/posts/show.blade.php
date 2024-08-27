<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
 
 
    <body>
        <h1 class="title">{{ $post->title }}</h1>
        <div class="content">
             <!-- 寺院名表示 -->
            <div class="content_temple">
                <h3>寺院名</h3>
                <p>{{ $post->temple }}</p>    
            </div>
             <!-- 都道府県表示 -->
            <div class="content_place">
                <h3>都道府県</h3>
                <p>{{ $post->place->prefecture }}</p>  
                <p>{{ $post->place->area }}</p>
            </div>
             <!-- カテゴリー表示 -->
            <div class="content_post">
                <h3>カテゴリー</h3>
                <p>
                 @foreach($post->categories as $category)   
                    {{$category->name}}
                @endforeach
                </p>
                
             <!-- コメント表示 -->
            <div class="content_comment">
                <h3>コメント</h3>
                <p>{{ $post->comment }}</p> 
            </div>
             <!-- 写真表示 -->
            <div class="content_image">
                <img src="/{{ $post->image }}" alt="写真">    
            </div>
        </div>
        <div class="footer">
            <a href="/">戻る</a>
        
    </body>
</html>