<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <a href="/posts/create">投稿</a>
    <link rel="stylesheet" type="text/css" href="{{ asset('/build/assets/map-CN376zLE.css') }}"> 
</head>


    <body>
        <input
            id="pac-input"
            class="controls"
            type="text"
            placeholder="Search Box"
        />
        <div id="map" style="width:800px; height:800px; margin: auto">
            <script src="{{ asset('/build/assets/map.js') }}"></script>
            <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config("services.google-map.apikey") }}&callback=initAutocomplete&libraries=places&v=weekly"defer></script>
        </div>
    </body>
