<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name') }} | {{ __('label.login.login') }}</title>
  <link rel="shortcut icon" href="favicon.ico" />
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body class="hold-transition login-page text-sm bg-login">
  <div class="login-box landing-box">
    <div class="row h-100 m-0">
      <div class="col-12 offset-md-8 col-md-4 p-0">
        <div class="card card-login card-outline card-primary">
          <div class="card-body">
            <div class="row justify-content-center">
              <div class="col-auto">
                <img class="img-block" src="{{ asset('img/logo.png') }}" alt="{{ config('app.name') }}" height="64">
              </div>
            </div>
            <p class="login-box-msg">{{ __('label.login.title') }}</p>
            <form class="form-lazy-control" data-action="{{ route('auth.post') }}">
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
              <div class="input-group mb-3">
                <input type="text" name="username" class="form-control" placeholder="{{ __('label.login.username') }}"
                  required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" name="password" class="form-control"
                  placeholder="{{ __('label.login.password') }}" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-12 col-md-6 mb-2">
                  <div class="icheck-primary">
                    <input type="checkbox" id="remember" name="remember" value="1">
                    <label class="mb-0" for="remember">{{ __('label.login.remember') }}</label>
                  </div>
                </div>
                <div class="col-12 col-md-6 mb-2 text-right">
                  <a href="{{ route('password.forget') }}">{{ __('label.login.forget') }}</a>
                </div>
                <div class="col-12">
                  <div class="form-button">
                    <button type="submit" name="auth" value="1" class="btn btn-primary btn-block mb-2">{{
                      __('label.login.login') }}</button>
                  </div>
                  <div class="form-button">
                    @include('partials.button.default', [
                    'action' => route('register.index'),
                    'class' => 'btn btn-primary btn-block',
                    'icon' => '',
                    'label' => __('label.login.register'),
                    ])
                  </div>
                  <div class="form-loading">
                    <img src="{{ asset('img/loading.gif') }}" height="40">
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="card-footer bg-white">
            <p class="text-center font-weight-light mb-0">&copy;2023 BaseTemplate</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
  <script type="text/javascript" src="{{asset('locale/messages_'.App::getLocale().'.js')}}"></script>
</body>

</html>