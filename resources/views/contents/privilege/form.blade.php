@extends('layouts/default')
@section('title', __('label.navigation.menu.privilege'))
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <form class="form-lazy-control" data-action="{{ $action }}">
        <div class="card">
          <div class="card-body">
            {{ FormControl::text('code', 1, __('label.privilege.form.code'), (isset($code) ? $code : null),
            __('label.privilege.tooltip.code'), ['form-alphanum text-uppercase'], ['maxlength' => 4, 'required' => $mandatory,
            'readonly' => isset($code)]
            ) }}
            {{ FormControl::select('menu_id', 2, true, $menuArr, __('label.privilege.form.menu'), isset($menu_id) ? $menu_id : null,
            __('label.privilege.tooltip.menu'), ['select2'], ['required' => $mandatory]
            ) }}
            {{ FormControl::select('modules', 2, false, $modulesArr, __('label.privilege.form.modules'), isset($modules) ? $modules : null,
            __('label.privilege.tooltip.modules'), ['select2'], ['required' => $mandatory]
            ) }}
            {{ FormControl::text('desc', 6, __('label.privilege.form.description'), (isset($desc) ? $desc : null),
            __('label.privilege.tooltip.description'), [], []
            ) }}
          </div>
          <div class="card-footer">
            <div class="form-button">
              <div class="row justify-content-center">
                <div class="col-sm-1">
                  @include('partials.button.default', [
                    'action' => route('setting.privilege.index'),
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