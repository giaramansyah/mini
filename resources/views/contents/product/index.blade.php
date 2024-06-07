@extends('layouts/default')
@section('title', __('label.navigation.menu.product'))
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
                    <th>{{ __('label.product.table.name') }}</th>
                    <th>{{ __('label.product.table.weight') }}</th>
                    <th>{{ __('label.product.table.price_label') }}</th>
                    <th>{{ __('label.product.table.stock') }}</th>
                    <th>{{ __('label.product.table.sale_label') }}</th>
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
      url: "{{ route('master.product.list') }}",
      method: "POST",
      data: {_token : "{{ csrf_token() }}"},
      columns: [
        {data: 'name', name: 'name', orderable: true, searchable: true},
        {data: 'weight', name: 'weight', orderable: true, searchable: true},
        {data: 'price_label', name: 'price_label', orderable: true, searchable: true},
        {data: 'stock', name: 'stock', orderable: true, searchable: true},
        {data: 'sale_label', name: 'sale_label', orderable: true, searchable: true},
      ],
    });
  </script>
@endsection
