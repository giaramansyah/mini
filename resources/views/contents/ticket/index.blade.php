@extends('layouts/default')
@section('title', __('label.navigation.menu.ticket'))
@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
          </div>
          <div class="card-body">
            <div class="table-responsive table-app table-app-primary">
              <table class="table">
                <thead>
                  <tr>
                    <th>{{ __('label.ticket.table.ticket_code') }}</th>
                    <th>{{ __('label.ticket.table.ticket_date') }}</th>
                    <th>{{ __('label.ticket.table.subject') }}</th>
                    <th>{{ __('label.ticket.table.issue') }}</th>
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
    $('table').drawTable({
      url: "{{ route('master.ticket.list') }}",
      method: "POST",
      data: {_token : "{{ csrf_token() }}"},
      columns: [
        {data: 'ticket', name: 'ticket', orderable: true, searchable: true},
        {data: 'ticket_date', name: 'ticket_date', orderable: true, searchable: true},
        {data: 'subject', name: 'subject', orderable: true, searchable: true},
        {data: 'issue', name: 'issue', orderable: true, searchable: true},
      ],
    });
  </script>
@endsection
