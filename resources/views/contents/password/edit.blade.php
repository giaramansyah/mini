@extends('layouts/default')
@section('title', __('label.navigation.password'))
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <form class="form-lazy-control"
        data-action="{{ route('password.post', ['action' => config('global.action.password.edit'), 'id' => Secure::secure(Auth::user()->id)]) }}" data-validate="password">
        <div class="card">
          <div class="card-body">
            {{ FormControl::text('password', 3, __('label.password.current'), null,
            __('label.password.tooltip.current'), ['form-password'], ['required' => true]
            ) }}
            {{ FormControl::text('new_password', 3, __('label.password.password'), null,
            __('label.password.tooltip.password'), ['form-password'], ['required' => true]
            ) }}
            {{ FormControl::text('confirm_password', 3, __('label.password.retype'), null,
            __('label.password.tooltip.retype'), ['form-password'], ['required' => true]
            ) }}
          </div>
          <div class="card-footer">
            <div class="form-button">
              <div class="row justify-content-center">
                <div class="col-sm-1">
                  @include('partials.button.default', [
                    'action' => route('account'),
                    'class' => 'btn-sm btn-block btn-outline-secondary',
                    'icon' => 'fas fa-arrow-circle-left',
                    'label' => __('label.button.back'),
                ])
                </div>
                <div class="col-sm-1">
                  @include('partials.button.submit')
                </div>
              </div>
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
@endsection