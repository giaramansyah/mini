@extends('layouts/default')
@section('title', __('label.navigation.menu.privigroup'))
@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <div class="card-tools">
              @if ($has_create)
                @include('partials.button.default', [
                    'action' => route('setting.privigroup.add'),
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
                    <th>{{ __('label.privigroup.table.no') }}</th>
                    <th>{{ __('label.privigroup.table.name') }}</th>
                    <th>{{ __('label.privigroup.table.description') }}</th>
                    <th>{{ __('label.privigroup.table.updated_at') }}</th>
                    <th>{{ __('label.privigroup.table.action') }}</th>
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
      url: "{{ route('setting.privigroup.list') }}",
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'name', name: 'name', orderable: true, searchable: true},
        {data: 'description', name: 'description', orderable: true, searchable: true},
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
