@extends('layouts/default')
@section('title', __('label.navigation.menu.account'))
@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <div class="card-tools">
              @if ($has_create)
                @include('partials.button.default', [
                    'action' => route('setting.account.add'),
                    'class' => 'btn-outline-primary',
                    'icon' => 'fas fa-plus-circle',
                    'label' => __('label.button.add'),
                ])
              @endif
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive table-app table-app-primary">
              <table class="table">
                <thead>
                  <tr>
                    <th>{{ __('label.account.table.no') }}</th>
                    <th>{{ __('label.account.table.account') }}</th>
                    <th>{{ __('label.account.table.email') }}</th>
                    <th>{{ __('label.account.table.status') }}</th>
                    <th>{{ __('label.account.table.last_login') }}</th>
                    <th>{{ __('label.account.table.updated_at') }}</th>
                    <th>{{ __('label.account.table.action') }}</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('partials.modal.delete')
  @include('partials.modal.intent', ['id' => 'modalForceLogout', 'title' => __('label.modal.forcelogout.title')])
@endsection
@section('push-js')
  <script>
    $('table').drawTable({
      url: "{{ route('setting.account.list') }}",
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'row_ID', orderable: false, searchable: false},
        {data: 'account', name: 'account', orderable: true, searchable: true},
        {data: 'email', name: 'email', orderable: true, searchable: true},
        {data: 'status', name: 'status', orderable: true, searchable: true},
        {data: 'last_login', name: 'last_login', orderable: true, searchable: true},
        {data: 'updated_at', name: 'updated_at', orderable: true, searchable: true},
        {data: 'action', name: 'action', orderable: false, searchable: false},
      ],
      onCompleteCallback: function() {
        $('.table').on('click', 'button[data-button="button-action"]', function() {
          $.fn.ButtonAction.call($(this))
        })
      }
    });
  </script>
@endsection
