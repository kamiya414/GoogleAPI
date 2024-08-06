<!DOCTYPE html>
<html lang="{{str_replace('_', '_', app()->getLocale())}}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/pagination.css') }}"/>
    </head>

        <x-slot name="header">
            index
        </x-slot>
        <body>
            <h1>index.blade</h1>
            <form action="/show" method="POST">
                @csrf
                <div>テーマ</div>
                <input name="post[theme]">
                <div>出発地</div>
                <input name="post[departure]">
                 <div>出発時間</div>
                <input name="post[starttime]" type="datetime-local">
                <div>目的地</div>
                <input name="post[destination]" >
                 <div>帰宅時間</div>
                <input name="post[endtime]" type="datetime-local">
                <div>予算</div>
                <input name="post[minimum]" type="number" placeholder="下限値">円～ <input name="post[max]" type="number" placeholder="上限値">円
                <div>誰と</div>
                    <select name="post[who]">
                        <option value="一人">一人</option>
                        <option value="家族">家族</option>
                        <option value="友達">友達</option>
                        <option value="同僚">同僚</option>
                        <option value="">指定なし</option>
                    </select>
                 
                 <div>人数</div>
                <input name="post[num_of_people]" type="number">人
                <div>移動手段</div>
                <select name="post[transportation]">
                    <option value="車">車</option>
                    <option value="公共機関">公共機関</option>
                </select>
                 <button class="w-12 h-12  bg-blue-400 text-lg text-white font-semibold rounded-full hover:bg-blue-500" type ="submit">検索</button>
            </form>
        </body>

</html>

