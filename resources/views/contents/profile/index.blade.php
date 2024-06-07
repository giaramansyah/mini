@extends('layouts/default')
@section('title', __('label.navigation.account'))
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
                @if($is_new)
                <small class="badge badge-info"><i class="fas fa-user"></i> {{ __('label.account.view.new') }}</small>
                @elseif($is_locked)
                <small class="badge badge-success"><i class="fas fa-lock"></i> {{ __('label.account.view.locked')
                  }}</small>
                @elseif(!$is_active)
                <small class="badge badge-danger"><i class="fas fa-ban"></i> {{ __('label.account.view.deactive')
                  }}</small>
                @else
                <small class="badge badge-success"><i class="fas fa-check"></i> {{ __('label.account.view.active')
                  }}</small>
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
          </ul>
        </div>
        <div class="card-footer">
          <div class="row justify-content-center">
            <div class="col-auto mb-2">
              @include('partials.button.default', [
              'action' => route('password'),
              'class' => 'btn-sm btn-block btn-outline-primary',
              'icon' => 'fas fa-key',
              'label' => __('label.button.changepass'),
              ])
            </div>
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
                @if(!empty($activities))
                @foreach($activities as $activity)
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
@endsection