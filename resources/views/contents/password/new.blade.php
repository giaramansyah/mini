<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name') }} | {{ __('label.password.new') }}</title>
  <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" />
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body class="login-page bg-login">
  <div class="login-box password-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <h1 class="h1">{{ __('label.password.new') }}</h1>
      </div>
      <div class="card-body">
        <p class="login-box-msg">{{ __('label.password.new_message') }}</p>
        <form class="form-lazy-control"
          data-action="{{ route('password.post', ['action' => config('global.action.password.add'), 'id' => $id]) }}"
          data-validate="password">
          <div class="form-group row justify-content-center">
            <div class="col-auto">
              <div class="btn-group">
                @foreach ($languagesArr as $value)
                <button type="button" class="btn btn-lazy-control btn-outline-primary btn-sm {{ $value['active'] }}"
                  title="{{ $value['title'] }}" data-action="{{ route('locale.index', ['id' => $value['code']]) }}">
                  {{ $value['label'] }}
                </button>
                @endforeach
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>{{ __('label.password.password') }}</label>
            <input type="password" name="new_password" id="new_password" class="form-control"
              placeholder="{{ __('label.password.password') }}" required>
          </div>
          <div class="form-group">
            <label>{{ __('label.password.retype') }}</label>
            <input type="password" name="confirm_password" class="form-control"
              placeholder="{{ __('label.password.retype') }}" required>
          </div>
          <div class="form-group row">
            <div class="col-12 col-md-12">
              <div class="form-button">
                @include('partials.button.submit')
              </div>
              <div class="form-loading">
                <img src="{{ asset('img/loading.gif') }}" height="40">
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
  <script type="text/javascript" src="{{asset('locale/messages_'.App::getLocale().'.js')}}"></script>
</body>

</html>