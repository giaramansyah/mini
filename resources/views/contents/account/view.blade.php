@extends('layouts/default')
@section('title', __('label.navigation.menu.account'))
@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-4">
        <div class="card">
          <div class="card-body box-profile">
            <h3 class="profile-username text-center">{{ $fullname }}</h3>
            <p class="text-muted text-center">{{ $username }}</p>
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>{{ __('label.account.view.email') }}</b>
                <p class="float-right mb-0">{{ $email }}</p>
              </li>
              <li class="list-group-item">
                <b>{{ __('label.account.view.status') }}</b>
                <p class="float-right mb-0">
                  @if ($is_new)
                    <small class="badge badge-info"><i class="fas fa-user"></i> {{ __('label.account.view.new') }}</small>
                  @elseif($is_locked)
                    <small class="badge badge-success"><i class="fas fa-lock"></i>
                      {{ __('label.account.view.locked') }}</small>
                  @elseif(!$is_active)
                    <small class="badge badge-danger"><i class="fas fa-ban"></i>
                      {{ __('label.account.view.deactive') }}</small>
                  @else
                    <small class="badge badge-success"><i class="fas fa-check"></i>
                      {{ __('label.account.view.active') }}</small>
                  @endif
                </p>
              </li>
              <li class="list-group-item">
                <b>{{ __('label.account.view.last_login') }}</b>
                <p class="float-right mb-0">{{ $last_login }}</p>
              </li>
              <li class="list-group-item">
                <b>{{ __('label.account.view.updated_by') }}</b>
                <p class="float-right mb-0">
                  {{ __('label.account.view.updated_at', ['user' => $updated_by, 'date' => $updated_at]) }}</p>
              </li>
              <li class="list-group-item">
                <b>{{ __('label.account.view.author') }}</b>
                <p class="float-right mb-0">
                  @if (!$is_author)
                    <small class="badge badge-danger"><i class="fas fa-time"></i></small>
                  @else
                    <small class="badge badge-success"><i class="fas fa-check"></i></small>
                  @endif
              </li>
            </ul>
          </div>
          <div class="card-footer">
            <div class="row justify-content-center">
              <div class="col-auto mb-2">
                @include('partials.button.default', [
                    'action' => route('setting.account.index'),
                    'class' => 'btn-sm btn-block btn-outline-secondary',
                    'icon' => 'fas fa-arrow-circle-left',
                    'label' => __('label.button.back'),
                ])
              </div>
              @if ($has_update)
                <div class="col-auto mb-2">
                  @include('partials.button.default', [
                      'action' => route('setting.account.edit', ['id' => Secure::secure($id)]),
                      'class' => 'btn-sm btn-block btn-outline-info',
                      'icon' => 'fas fa-pen',
                      'label' => __('label.button.edit'),
                  ])
                </div>
              @endif
              @if ($has_delete)
                <div class="col-auto mb-2">
                  @include('partials.button.delete', [
                      'action' => route('setting.account.post', [
                          'action' => config('global.action.form.delete'),
                          'id' => Secure::secure($id),
                      ]),
                      'class' => 'btn-sm btn-block',
                      'source' => 'database',
                      'label' => __('label.button.delete'),
                  ])
                </div>
              @endif
              <div class="col-auto mb-2">
                <button type="button" class="btn btn-lazy-control btn-sm btn-block btn-outline-primary"
                  data-button="button-action"
                  data-action="{{ route('password.post', ['action' => config('global.action.password.resend'), 'id' => Secure::secure($id)]) }}"
                  data-method="view" data-dial="form" data-source="database" data-intent="#modalResetPass">
                  <i class="fas fa-key"></i> {{ __('label.button.resetpass') }}
                </button>
              </div>
              @if ($is_login)
                <div class="col-auto mb-2">
                  <button type="button" class="btn btn-lazy-control btn-sm btn-block btn-primary"
                    data-button="button-action"
                    data-action="{{ route('setting.account.post', ['action' => config('global.action.form.logout'), 'id' => Secure::secure($id)]) }}"
                    data-method="view" data-dial="form" data-source="database" data-intent="#modalForceLogout">
                    <i class="fas fa-power-off"></i> {{ __('label.button.logout') }}
                  </button>
                </div>
              @endif
              @if ($has_update)
                @if ($is_locked)
                  <div class="col-auto mb-2">
                    <button type="button" class="btn btn-lazy-control btn-sm btn-block btn-info"
                      data-button="button-action"
                      data-action="{{ route('setting.account.post', ['action' => config('global.action.form.lock'), 'id' => Secure::secure($id)]) }}"
                      data-method="view" data-dial="form" data-source="database" data-intent="#modalUnlock">
                      <i class="fas fa-lock-open"></i> {{ __('label.button.unlock') }}
                    </button>
                  </div>
                @else
                  <div class="col-auto mb-2">
                    <button type="button" class="btn btn-lazy-control btn-sm btn-block btn-warning"
                      data-button="button-action"
                      data-action="{{ route('setting.account.post', ['action' => config('global.action.form.lock'), 'id' => Secure::secure($id)]) }}"
                      data-method="view" data-dial="form" data-source="database" data-intent="#modalLock">
                      <i class="fas fa-lock"></i> {{ __('label.button.lock') }}
                    </button>
                  </div>
                @endif
                @if ($is_active)
                  <div class="col-auto mb-2">
                    <button type="button" class="btn btn-lazy-control btn-sm btn-block btn-danger"
                      data-button="button-action"
                      data-action="{{ route('setting.account.post', ['action' => config('global.action.form.able'), 'id' => Secure::secure($id)]) }}"
                      data-method="view" data-dial="form" data-source="database" data-intent="#modalDeactive">
                      <i class="fas fa-ban"></i> {{ __('label.button.deactive') }}
                    </button>
                  </div>
                @else
                  <div class="col-auto mb-2">
                    <button type="button" class="btn btn-lazy-control btn-sm btn-block btn-success"
                      data-button="button-action"
                      data-action="{{ route('setting.account.post', ['action' => config('global.action.form.able'), 'id' => Secure::secure($id)]) }}"
                      data-method="view" data-dial="form" data-source="database" data-intent="#modalActive">
                      <i class="fas fa-check"></i> {{ __('label.button.active') }}
                    </button>
                  </div>
                @endif
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-8">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-sm-6">
                <h4 class="card-title mb-0 text-bold">{{ __('label.account.view.privilege') }}</h4>
              </div>
              <div class="col-sm-6 text-right">
                <h5 class="mb-0 text-bold">{{ $group_name }}</h5>
                <p class="mb-0">{{ $group_desc }}</p>
              </div>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-sm" width="100%">
              <thead>
                <tr>
                  <th class="text-center">{{ __('label.account.view.module') }}</th>
                  @foreach ($modulesArr as $value)
                    <th class="text-center">{{ __($value) }}</th>
                  @endforeach
                </tr>
              </thead>
              <tbody>
                @foreach ($privilegeArr as $key => $value)
                  <tr>
                    <td colspan="{{ count($modulesArr) + 1 }}" class="text-bold">{{ $value['text'] }}</td>
                  </tr>
                  @foreach ($value['menus'] as $k => $val)
                    <tr>
                      <td>{{ __($val['text']) }}</td>
                      @foreach ($val['privileges'] as $index => $v)
                        <td class="text-center">
                          @if (isset($v) && in_array($v, $privileges))
                            <i class="fas fa-check-circle text-success"></i>
                          @endif
                        </td>
                      @endforeach
                    </tr>
                  @endforeach
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-sm-6">
                <h4 class="card-title mb-0 text-bold">{{ __('label.account.view.activity') }}</h4>
              </div>
              <div class="col-sm-6 text-right">
                <p class="mb-0">{{ __('label.account.view.last_activity') }}</p>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive table-app table-app-primary">
              <table class="table">
                <thead>
                  <tr>
                    <th>{{ __('label.account.table.timestamp') }}</th>
                    <th>{{ __('label.account.table.privilege') }}</th>
                    <th>{{ __('label.account.table.description') }}</th>
                    <th>{{ __('label.account.table.ip_address') }}</th>
                    <th>{{ __('label.account.table.request') }}</th>
                    <th>{{ __('label.account.table.response') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @if (!empty($activities))
                    @foreach ($activities as $activity)
                      <tr>
                        <td>{{ $activity['timestamp'] }}</td>
                        <td>{{ $activity['privilege'] }}</td>
                        <td>{{ $activity['description'] }}</td>
                        <td>{{ $activity['ip_address'] }}</td>
                        <td>{{ $activity['log_request'] }}</td>
                        <td>{{ $activity['log_response'] }}</td>
                      </tr>
                    @endforeach
                  @else
                    <tr>
                      <td colspan="6" class="text-center">{{ __('label.static.empty_table') }}</td>
                    </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('partials.modal.delete')
  @include('partials.modal.intent', [
      'id' => 'modalForceLogout',
      'title' => __('label.modal.forcelogout.title'),
  ])
  @include('partials.modal.intent', [
      'id' => 'modalResetPass',
      'title' => __('label.modal.resetpass.title'),
  ])
  @include('partials.modal.intent', ['id' => 'modalLock', 'title' => __('label.modal.lock.title')])
  @include('partials.modal.intent', ['id' => 'modalUnlock', 'title' => __('label.modal.unlock.title')])
  @include('partials.modal.intent', ['id' => 'modalActive', 'title' => __('label.modal.active.title')])
  @include('partials.modal.intent', ['id' => 'modalDeactive', 'title' => __('label.modal.deactive.title')])
@endsection
