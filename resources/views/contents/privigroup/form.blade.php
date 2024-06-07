@extends('layouts/default')
@section('title', __('label.navigation.menu.privigroup'))
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <form class="form-lazy-control" data-action="{{ $action }}">
        <div class="card">
          <div class="card-body">
            {{ FormControl::text('name', 3, __('label.privigroup.form.name'), (isset($name) ? $name : null),
            __('label.privigroup.tooltip.name'), [], ['required' => $mandatory]
            ) }}
            {{ FormControl::text('description', 6, __('label.privigroup.form.description'), (isset($description) ?
            $description : null),
            __('label.privigroup.tooltip.description'), [], []
            ) }}
            <div class="form-group row">
              <label class="col-sm-12 col-md-2 col-form-label">{{ __('label.privigroup.form.privilege')
                }}<code>*</code></label>
              <div class="col-sm-12 col-md-10">
                <div class="row">
                  <div class="col-11 table-responsive table-app">
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="text-center">{{ __('label.privigroup.table.modules') }}</th>
                          @foreach ($modulesArr as $value)
                          <th class="text-center">{{ __($value) }}</th>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($privilegeArr as $value)
                        <tr>
                          <td colspan="{{ (count($modulesArr) + 1) }}" class="text-bold">
                            {{ $value['text'] }}
                          </td>
                        </tr>
                        @foreach ($value['menus'] as $key => $val)
                        <tr>
                          <td>{{ $val['text'] }}</td>
                          @foreach ($val['privileges'] as $index => $v)
                          <td class="text-center">
                            @if($v !== null)
                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                              <input type="checkbox" class="custom-control-input" id="customSwitch-{{ $v }}"
                                name="privilege_id" value="{{ $v }}" {{ isset($privileges) && in_array($v, $privileges)
                                ? 'checked' : '' }}>
                              <label class="custom-control-label" for="customSwitch-{{ $v }}">&nbsp;</label>
                            </div>
                            @endif
                          </td>
                          @endforeach
                        </tr>
                        @endforeach
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="col-1">
                    <button type="button" class="btn" data-toggle="tooltip" data-placement="right"
                      title="{{ __('label.privigroup.tooltip.privilege') }}">
                      <i class="fas fa-info-circle text-info"></i>
                    </button>
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
                  'action' => route('setting.privigroup.index'),
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