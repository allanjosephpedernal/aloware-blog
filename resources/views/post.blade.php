<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Stylesheet -->
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <div id="app" class="container pt-3 pb-3">
            <post></post>
        </div>
    </body>
    <script type="text/javascript" src="/js/vue_global_event.js"></script>
    <script type="text/javascript" src="/js/app.js"></script>
</html>
