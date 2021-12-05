<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon"  href="/favicon.ico">
    <title>zheka13.net.ua - {{ $title }}</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .layout {
            overflow: hidden;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            height: 60px;
            border-bottom: 1px solid #dcdcdc;
        }

        .wrapper {
            flex-grow: 1;
            display: flex;
        }

        .sidebar {
            width: 250px;
            border-right: 1px solid #dcdcdc;
            margin-top: 10px;
        }

        .content {
            flex-grow: 1;
        }

        .footer {
            height: 60px;
            border-top: 1px solid #dcdcdc;
        }
    </style>
</head>
<body>
<div style="text-align: center;">
    <h2>zheka13.net.ua services</h2>
    <h2>Eheu fugaces! O tempora, o mores</h2>
</div>
<div style="padding: 10px">
    <table style="border :1px solid black;">
        <tr style="border :1px solid black;">
            <td style="padding: 10px">
                {{ __("Facebook Clickable Image with redirect") }}<br>
                Кликабельные картинки для Facebook
            </td>
            <td style="padding: 10px">
                <a href="{{ route("home") }}">{{ __("here") }}</a> <br>
                <a href="{{ route("home") }}">{{ __("тут") }}</a>
            </td>
        </tr>
    </table>
</div>

<script src="/js/vue.min.js"></script>
<script src="/js/jquery-3.5.1.min.js"></script>
<script src="/js/app.js"></script>


@stack('scripts')
</body>
</html>



