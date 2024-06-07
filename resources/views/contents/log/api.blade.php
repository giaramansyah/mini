@extends('layouts/default')
@section('title', __('label.navigation.menu.apitrail'))
@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        {{ FormControl::text(
        'date',
        2,
        __('label.apitrail.form.date'),
        date('Y-m-d'),
        __('label.apitrail.tooltip.date'),
        ['form-date'],
        ['required' => true, 'max' => date('Y-m-d')],
        ) }}
      </div>
      <div class="card-body">
        <div class="table-responsive table-app table-app-primary">
          <table class="table">
            <thead>
              <tr>
                <th>{{ __('label.apitrail.table.no') }}</th>
                <th>{{ __('label.apitrail.table.timestamp') }}</th>
                <th>{{ __('label.apitrail.table.privilege') }}</th>
                <th>{{ __('label.apitrail.table.description') }}</th>
                <th>{{ __('label.apitrail.table.ip') }}</th>
                <th>{{ __('label.apitrail.table.request') }}</th>
                <th>{{ __('label.apitrail.table.response') }}</th>
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
@endsection
@section('push-js')
<script>
  var table = $('table').drawTable({
    url: "{{ route('applog.log.list', ['form' => 'ATRA']) }}",
    data: function ( d ) { 
      return $.extend(d, {date: $('input[name=date]').val()});
    },
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'DT_RowIndex', orderable: false, searchable: false},
      {data: 'timestamp', name: 'timestamp', orderable: true, searchable: true},
      {data: 'privilege', name: 'privilege', orderable: true, searchable: true},
      {data: 'description', name: 'description', orderable: true, searchable: true},
      {data: 'ip_address', name: 'ip_address', orderable: true, searchable: true},
      {data: 'log_request', name: 'log_request', orderable: true, searchable: true},
      {data: 'log_response', name: 'log_response', orderable: true, searchable: true},
    ],
    onCompleteCallback: function() {
      $('.table').on('click', 'button[data-button="button-action"]', function() {
        $.fn.ButtonAction.call($(this))
      })
    }
  });

  $('input[name=date]').on('change', function() {
    table.ajax.reload();
  })
</script>
@endsection