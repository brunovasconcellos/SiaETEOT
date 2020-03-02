<!doctype html>
<html lang="pt-br">

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <link rel="stylesheet" href="{{asset('css/app.css')}}">
      <link rel="stylesheet" href="{{asset('css/sia-style.css')}}">

      <title>Sia eteot</title>
</head>

<body>


@hassection("body")
@yield("body")
@endif

@component("layouts.components.footer")
@endcomponent
      <script src="{{asset('js/app.js')}}"></script>
</body>

</html>