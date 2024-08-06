<!DOCTYPE html>
<html lang="{{str_replace('_', '_', app()->getLocale())}}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/star.css">
        <script src="/js/star.js"></script>
    </head>
    <x-app-layout>
        <x-slot name="header">
            index
        </x-slot>
        <body>
           <div>
              <span class="star" id="1">★</span>
              <span class="star" id="2">★</span>
              <span class="star" id="3">★</span>
              <span class="star" id="4">★</span>
              <span class="star" id="5">★</span>
            </div>
            
        </body>
    </x-app-layout>
</html>

