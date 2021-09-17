<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FB Redirect - {{ $title }}</title>

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

<div class="layout">
    @include("layout.header")
    <div class="wrapper">
        @include("layout.sidebar")
        @include("layout.main")
    </div>
    @include("layout.footer")
</div>


<script src="/js/vue.min.js"></script>
<script src="/js/jquery-3.5.1.min.js"></script>
<script src="/js/app.js"></script>


@stack('scripts')
</body>
</html>

