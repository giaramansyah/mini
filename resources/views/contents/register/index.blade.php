<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} | {{ __('label.register.new') }}</title>
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
              <p class="login-box-msg">{{ __('label.register.title') }}</p>
              <form class="form-lazy-control" data-action="{{ route('register.post', ['action' => config('global.action.form.add')]) }}">
                <div class="form-group row justify-content-center">
                  <div class="col-auto">
                    <div class="btn-group">
                      @foreach ($languagesArr as $value)
												<button type="button" class="btn btn-lazy-control btn-outline-primary btn-sm {{ $value['active'] }}" title="{{ $value['title'] }}" data-action="{{ route('locale.index', ['id' => $value['code']]) }}">
													{{ $value['label'] }}
												</button>
											@endforeach
                    </div>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <input type="text" name="username" class="form-control" placeholder="{{ __('label.register.username') }}" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <input type="text" name="first_name" class="form-control" placeholder="{{ __('label.register.first_name') }}" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-f"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <input type="text" name="last_name" class="form-control" placeholder="{{ __('label.register.last_name') }}">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-l"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <input type="email" name="email" class="form-control" placeholder="{{ __('label.register.email') }}" required>
                  <input type="hidden" name="privilege_group_id" value="2">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-12 col-md-6 mb-2">
                    <a href="{{ route('auth.index') }}">{{ __('label.register.login') }}</a>
                  </div>
                  <div class="col-12 offset-md-6 col-md-6">
                    <div class="form-button">
                      <button type="submit" name="auth" value="1" class="btn btn-primary btn-block">{{ __('label.register.new') }}</button>
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