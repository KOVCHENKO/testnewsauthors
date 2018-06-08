<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>;
        </script>
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
        <title>Новости</title>  
    </head>
    <body>
    <div id="app">
        
        <router-view></router-view>
        
    </div>
        <script src="{{ url('js/app.js') }}"></script>
    </body>
</html>
