@extends('layouts/default')
@section('title', __('label.navigation.menu.account'))
@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <form class="form-lazy-control" data-action="{{ $action }}">
          <div class="card">
            <div class="card-body">
              {{ FormControl::text(
                  'username',
                  3,
                  __('label.account.form.username'),
                  isset($username) ? $username : null,
                  __('label.account.tooltip.username'),
                  ['form-alphanum'],
                  ['maxlength' => 16, 'required' => $mandatory, 'readonly' => isset($username)],
              ) }}
              {{ FormControl::text(
                  'first_name',
                  3,
                  __('label.account.form.first_name'),
                  isset($first_name) ? $first_name : null,
                  __('label.account.tooltip.first_name'),
                  [],
                  ['maxlength' => 32, 'required' => $mandatory],
              ) }}
              {{ FormControl::text(
                  'last_name',
                  3,
                  __('label.account.form.last_name'),
                  isset($last_name) ? $last_name : null,
                  __('label.account.tooltip.last_name'),
                  [],
                  ['maxlength' => 32],
              ) }}
              {{ FormControl::text(
                  'email',
                  4,
                  __('label.account.form.email'),
                  isset($email) ? $email : null,
                  __('label.account.tooltip.email'),
                  ['form-email'],
                  ['maxlength' => 50, 'required' => $mandatory],
              ) }}
              {{ FormControl::select(
                  'privilege_group_id',
                  3,
                  false,
                  $privigroupArr,
                  __('label.account.form.privigroup'),
                  isset($privilege_group_id) ? $privilege_group_id : null,
                  __('label.account.tooltip.privigroup'),
                  ['select2'],
                  ['required' => $mandatory],
              ) }}
              <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">{{ __('label.account.form.author') }}</label>
                <div class="col-sm-12 col-md-3">
                  <div class="input-group input-group-sm mt-2">
                    <div class="input-group-append">
                      <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" id="customSwitch-author" name="is_author"
                          value="1"
                          {{ isset($is_author) && $is_author ? 'checked' : '' }}>
                        <label class="custom-control-label" for="customSwitch-author">&nbsp;</label>
                      </div>
                    </div>
                    <div class="input-group-tooltips">
                      <span class="input-group-text" data-toggle="tooltip" data-placement="right" title="{{ __('label.account.form.author') }}">
                        <i class="fas fa-info-circle text-info"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="form-button">
                <div class="row justify-content-center">
                  <div class="col-sm-1">
                    @include('partials.button.default', [
                        'action' => route('setting.account.index'),
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
