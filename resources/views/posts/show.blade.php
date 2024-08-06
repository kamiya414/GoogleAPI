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
            <h1>show.blade</h1>
            <div>{{$prompt}}</div>
            
          {{--  <div>{{$post['departure']}}</div>
           <div>{{$post['destination']}}</div> --}}
        </body>

</html>

