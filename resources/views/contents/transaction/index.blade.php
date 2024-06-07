@extends('layouts/default')
@section('title', __('label.navigation.menu.transaction'))
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
                    <th>{{ __('label.transaction.table.invoice_no') }}</th>
                    <th>{{ __('label.transaction.table.total_weight') }}</th>
                    <th>{{ __('label.transaction.table.shipping_fee_label') }}</th>
                    <th>{{ __('label.transaction.table.total_price_label') }}</th>
                    <th>{{ __('label.transaction.table.shipping_date') }}</th>
                    <th>{{ __('label.transaction.table.shipping_type') }}</th>
                    <th>{{ __('label.transaction.table.transaction_date') }}</th>
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
      url: "{{ route('master.transaction.list') }}",
      method: "POST",
      data: {_token : "{{ csrf_token() }}"},
      columns: [
        {data: 'invoice_no', name: 'invoice_no', orderable: true, searchable: true},
        {data: 'total_weight', name: 'total_weight', orderable: true, searchable: true},
        {data: 'shipping_fee_label', name: 'shipping_fee_label', orderable: true, searchable: true},
        {data: 'total_price_label', name: 'total_price_label', orderable: true, searchable: true},
        {data: 'shipping_date', name: 'shipping_date', orderable: true, searchable: true},
        {data: 'shipping_type', name: 'shipping_type', orderable: true, searchable: true},
        {data: 'transaction_date', name: 'transaction_date', orderable: true, searchable: true},
      ],
    });
  </script>
@endsection
