<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">


        <title>error</title>

    </head>
    <body>
        <div class="flex-center position-ref full-height">
   

            <div class="content">
              {{$error}}
            </div>
        </div>
    </body>
</html>
