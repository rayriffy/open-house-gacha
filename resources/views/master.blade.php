<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script>
    window.Laravel = { csrfToken: '{{ csrf_token() }}' }
  </script>
  <title>@yield('title') | MUICT Open House Gacha</title>
  <link type="text/css" rel="stylesheet" href="/css/app.css" media="screen, projection, print"/>
</head>
<body>
  @include('module.navbar')
  <div class="container">
    @yield('content')
    @include('module.footer')
  </div>
  <script src="/js/app.js"></script>
</body>
</html>