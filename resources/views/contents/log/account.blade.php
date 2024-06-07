@extends('layouts/default')
@section('title', __('label.navigation.menu.accactivity'))
@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        {{ FormControl::text(
        'date',
        2,
        __('label.accactivity.form.date'),
        date('Y-m-d'),
        __('label.accactivity.tooltip.date'),
        ['form-date'],
        ['required' => true, 'max' => date('Y-m-d')],
        ) }}
      </div>
      <div class="card-body">
        <div class="table-responsive table-app table-app-primary">
          <table class="table">
            <thead>
              <tr>
                <th>{{ __('label.accactivity.table.no') }}</th>
                <th>{{ __('label.accactivity.table.timestamp') }}</th>
                <th>{{ __('label.accactivity.table.username') }}</th>
                <th>{{ __('label.accactivity.table.privilege') }}</th>
                <th>{{ __('label.accactivity.table.description') }}</th>
                <th>{{ __('label.accactivity.table.ip') }}</th>
                <th>{{ __('label.accactivity.table.agent') }}</th>
                <th>{{ __('label.accactivity.table.request') }}</th>
                <th>{{ __('label.accactivity.table.response') }}</th>
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
    url: "{{ route('applog.log.list', ['form' => 'AARA']) }}",
    method: "POST",
    data: function ( d ) { 
      return $.extend(d, {date: $('input[name=date]').val(), _token : "{{ csrf_token() }}"});
    },
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'DT_RowIndex', orderable: false, searchable: false},
      {data: 'timestamp', name: 'timestamp', orderable: true, searchable: true},
      {data: 'username', name: 'username', orderable: true, searchable: true},
      {data: 'privilege', name: 'privilege', orderable: true, searchable: true},
      {data: 'description', name: 'description', orderable: true, searchable: true},
      {data: 'ip_address', name: 'ip_address', orderable: true, searchable: true},
      {data: 'agent', name: 'agent', orderable: true, searchable: true},
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