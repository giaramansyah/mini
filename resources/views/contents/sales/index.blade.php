@extends('layouts/default')
@section('title', __('label.navigation.menu.sales'))
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
                    <th>{{ __('label.sales.table.invoice_no') }}</th>
                    <th>{{ __('label.sales.table.total_weight') }}</th>
                    <th>{{ __('label.sales.table.shipping_fee_label') }}</th>
                    <th>{{ __('label.sales.table.total_price_label') }}</th>
                    <th>{{ __('label.sales.table.total_sale_label') }}</th>
                    <th>{{ __('label.sales.table.shipping_date') }}</th>
                    <th>{{ __('label.sales.table.shipping_type') }}</th>
                    <th>{{ __('label.sales.table.sales_date') }}</th>
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
      url: "{{ route('master.sales.list') }}",
      method: "POST",
      data: {_token : "{{ csrf_token() }}"},
      columns: [
        {data: 'invoice', name: 'invoice', orderable: true, searchable: true},
        {data: 'total_weight', name: 'total_weight', orderable: true, searchable: true},
        {data: 'shipping_fee_label', name: 'shipping_fee_label', orderable: true, searchable: true},
        {data: 'total_price_label', name: 'total_price_label', orderable: true, searchable: true},
        {data: 'total_sale_label', name: 'total_sale_label', orderable: true, searchable: true},
        {data: 'shipping_date', name: 'shipping_date', orderable: true, searchable: true},
        {data: 'shipping_type', name: 'shipping_type', orderable: true, searchable: true},
        {data: 'sales_date', name: 'sales_date', orderable: true, searchable: true},
      ],
    });
  </script>
@endsection
