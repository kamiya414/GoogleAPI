<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Geminiを使って旅行計画を手助け！！</h1>
        
        <form action="/gemini" method="POST">
        @csrf
        
        <div>テーマ</div>
        <div 
        class="posts">
            <input type="text" name="post[thema]" placeholder="例：温泉旅行がしたい" />
        </div>
       
        <div>出発地</div>
        <div 
        class="posts">
            <input type="text" name="post[departure]" placeholder="例：大阪" />
        </div>
        
        <div>出発時間</div>
        <div 
             class="posts">
             <input type="date" name="post[departuredate]" placeholder="" />
        </div>
        <div
             class="posts">
             <input type="time" name="post[departuretime]" placeholder="" />
        </div>
        
        <div>目的地</div>
        <div 
             class="posts">
             <input type="text" name="post[arrival]" placeholder="例：東京、箱根、高尾" />
             
        </div>
        
        <div>帰宅時間</div>
        <div 
            class="posts">
            <input type="date" name="post[arrivaldate]" placeholder="" />
        </div>
        <div
            class="posts">
            <input type="time" name="post[hometime]" placeholder="" />
        </div>
        
        <div>予算</div>
        <div 
            class="posts">
            <input type="text" name="post[upper]" placeholder="下限" />円～ 
        </div>
        <div
            class="posts">
            <input type="text" name="post[lower]" placeholder="上限" />円
        </div>
        
        <div>誰と</div>
        <div 
        class="posts">
            <input type="text" name="post[who]" placeholder="例：友達"/>
        </div>
        
        <div>人数</div>
        <div 
        class="posts">
            <input type="text" name="post[number]" placeholder="例：4人" />
        </div>
        
        <div>移動手段</div>
        <div 
        class="posts">
           <select name="post[way]">
           <option value='car'>車</option>
           <option value='public'>公共交通機関</option>
           <option value='bus'>バス</option>
           <option value='train'>電車</option>
           <option value='ship'>船</option>
           <option value='plane'>飛行機</option>
           </select>
        </div>
        
        <button type="submit">検索</button>
        </form>
        <br><br>
        <div id="response"></div>
        <script src="script.js"></script>
        
        
        
        
        
        <a href='/posts/create'>create</a>
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                    <a href="/posts/{{ $post->id }}"><h2 class='title'>{{ $post->title }}</h2></a>
                    <p class='body'>{{ $post->body }}</p>
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                    @csrf
                    @method('DELETE')
                       <button type="button" onclick="deletePost({{ $post->id }})">delete</button> 
                </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
       <script>
         function deletePost(id) {
            'use strict'

             if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
             }
         }
       </script>
    </body>
</html>