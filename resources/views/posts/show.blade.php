<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Blog</title>
        <!--これコメントタグ下のコードはlinkタグでフォント指定 -->  
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>

    <body>
        <h1 class='title'>
            {{$post->title}}
        </h1>
        <div class='content'>
            <div class='content_post'>
                 <h3>本文</h3>
                 <p class='body'>{{$post->body}}</p>
             </div>
        <div class='footer'>
            <a href="/posts">戻る</a>
        </div>     
    </body>
</html>