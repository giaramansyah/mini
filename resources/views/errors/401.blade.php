<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name') }} | {{ __('label.401.name') }}</title>
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('push-css')
    <script type="text/javascript">
      window.history.forward();

      function noBack() {
        window.history.forward();
      }
    </script>
  </head>

<body class="hold-transition lockscreen">
  <div class="lockscreen-wrapper">
    <div class="lockscreen-logo text-warning mb-0" style="font-size:100px">
        <i class="fas fa-ban text-warning"></i>
    </div>
    <div class="lockscreen-name">
      <h3>{{ __('label.401.title') }}</h3>
    </div>
    <div class="help-block text-center mb-2">
      {{ __('label.401.message') }}
    </div>
    <div class="text-center">
      <a class="btn btn-warning" href="{{ route('home') }}">{{ __('label.401.return') }}</a>
    </div>
    <div class="lockscreen-footer text-center">
      <strong>{{ config('app.name') }}</strong><br>
      <b>{{ __('label.footer.version') }}</b> {{ env('APP_VERSION') }}
    </div>
  </div>
</body>

</html>
