<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>{{ config("app.name") }} | @yield('title')</title>
  <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" />
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  @yield('push-css')
  <script type="text/javascript">
    function disableBack() { window.history.forward(); }
    setTimeout("disableBack()", 0);
    window.onunload = function () { null };
    </script>
</head>

<body class="layout-fixed sidebar-mini text-sm">
  <div class="wrapper">
    @include('partials.nav.default-top')
    @include('partials.nav.default-side')
    <div class="content-wrapper">
      <div class="content-header">
        @include('partials.header.default')
      </div>
      <section class="content">
        @yield('content')
      </section>
    </div>
    @include('partials.footer.default')
  </div>
  <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
  <script type="text/javascript" src="{{asset('locale/messages_'.App::getLocale().'.js')}}"></script>
  @yield('push-js')
</body>

</html>