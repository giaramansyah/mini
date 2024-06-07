@extends('layouts/default')
@section('title', __('label.navigation.menu.mailtrail'))
@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        {{ FormControl::text(
        'date',
        2,
        __('label.mailtrail.form.date'),
        date('Y-m-d'),
        __('label.mailtrail.tooltip.date'),
        ['form-date'],
        ['required' => true, 'max' => date('Y-m-d')],
        ) }}
      </div>
      <div class="card-body">
        <div class="table-responsive table-app table-app-primary">
          <table class="table">
            <thead>
              <tr>
                <th>{{ __('label.mailtrail.table.no') }}</th>
                <th>{{ __('label.mailtrail.table.timestamp') }}</th>
                <th>{{ __('label.mailtrail.table.agent') }}</th>
                <th>{{ __('label.mailtrail.table.target') }}</th>
                <th>{{ __('label.mailtrail.table.subject') }}</th>
                <th>{{ __('label.mailtrail.table.response') }}</th>
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
    url: "{{ route('applog.log.list', ['form' => 'MLRA']) }}",
    data: function ( d ) { 
      return $.extend(d, {date: $('input[name=date]').val()});
    },
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'DT_RowIndex', orderable: false, searchable: false},
      {data: 'timestamp', name: 'timestamp', orderable: true, searchable: true},
      {data: 'username', name: 'username', orderable: true, searchable: true},
      {data: 'target', name: 'target', orderable: true, searchable: true},
      {data: 'subject', name: 'subject', orderable: true, searchable: true},
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