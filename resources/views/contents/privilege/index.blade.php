@extends('layouts/default')
@section('title', __('label.navigation.menu.privilege'))
@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <div class="card-tools">
              @if ($has_create)
                @include('partials.button.default', [
                    'action' => route('setting.privilege.add'),
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
                    <th>{{ __('label.privilege.table.no') }}</th>
                    <th>{{ __('label.privilege.table.code') }}</th>
                    <th>{{ __('label.privilege.table.menu') }}</th>
                    <th>{{ __('label.privilege.table.modules') }}</th>
                    <th>{{ __('label.privilege.table.description') }}</th>
                    <th>{{ __('label.privilege.table.action') }}</th>
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
@endsection
@section('push-js')
  <script>
    $('table').drawTable({
      url: "{{ route('setting.privilege.list') }}",
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'row_ID', orderable: false, searchable: false},
        {data: 'code', name: 'code', orderable: true, searchable: true},
        {data: 'menu', name: 'menu', orderable: true, searchable: true},
        {data: 'module_desc', name: 'module_desc', orderable: true, searchable: true},
        {data: 'desc', name: 'desc', orderable: true, searchable: true},
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
