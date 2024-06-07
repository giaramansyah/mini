<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name') }} | {{ __('label.404.name') }}</title>
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
    <div class="lockscreen-logo text-primary mb-0" style="font-size:100px">
      404
    </div>
    <div class="lockscreen-name">
      <h3><i class="fas fa-exclamation-triangle text-primary"></i> {{ __('label.404.title') }}</h3>
    </div>
    <div class="help-block text-center mb-2">
      {{ __('label.404.message') }}
    </div>
    <div class="text-center">
      <a class="btn btn-primary" href="{{ route('home') }}">{{ __('label.404.return') }}</a>
    </div>
    <div class="lockscreen-footer text-center">
      <strong>{{ config('app.name') }}</strong><br>
      <b>{{ __('label.footer.version') }}</b> {{ env('APP_VERSION') }}
    </div>
  </div>
</body>

</html>
