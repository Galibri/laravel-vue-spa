<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>My Own SPA</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>
    <body>
        <div id="app">
            <app-header class="mb-3"></app-header>
            <router-view></router-view>
        </div>
    </body>

    <script src="{{ asset('js/app.js') }}"></script>
</html>