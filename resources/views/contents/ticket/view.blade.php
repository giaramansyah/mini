@extends('layouts/default')
@section('title', __('label.navigation.menu.ticket'))
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12 col-md-4">
      <div class="card">
        <div class="card-body box-profile">
          <h3 class="profile-username text-center">{{ __('label.ticket.view.ticket_code') }}</h3>
          <p class="text-muted text-center">{{ $ticket_code }}</p>
          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              <b>{{ __('label.ticket.view.ticket_date') }}</b>
              <p class="float-right mb-0">{{ $ticket_date }}</p>
            </li>
            <li class="list-group-item">
              <b>{{ __('label.ticket.view.customer_id') }}</b>
              <p class="float-right mb-0">{{ $customer_id }}</p>
            </li>
            <li class="list-group-item">
              <b>{{ __('label.ticket.view.product_id') }}</b>
              <p class="float-right mb-0">{{ $product_id }}</p>
            </li>
            <li class="list-group-item">
              <b>{{ __('label.ticket.view.subject') }}</b>
              <p class="float-right mb-0">{{ $subject }}</p>
            </li>
            <li class="list-group-item">
              <b>{{ __('label.ticket.view.issue') }}</b>
              <p class="float-right mb-0">{{ $issue }}</p>
            </li>
          </ul>
        </div>
        <div class="card-footer">
          <div class="row justify-content-center">
            <div class="col-auto mb-2">
              @include('partials.button.default', [
              'action' => route('master.ticket.index'),
              'class' => 'btn-sm btn-block btn-outline-secondary',
              'icon' => 'fas fa-arrow-circle-left',
              'label' => __('label.button.back'),
              ])
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-8">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-sm-6">
              <h4 class="card-title mb-0 text-bold">{{ __('label.ticket.view.ticket_process') }}</h4>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive table-app table-app-primary">
            <table class="table">
              <thead>
                <tr>
                  <th class="text-center">{{ __('label.ticket.table.status') }}</th>
                  <th class="text-center">{{ __('label.ticket.table.user_id') }}</th>
                  <th class="text-center">{{ __('label.ticket.table.update_date') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($detail as $key => $value)
                <tr>
                  <td>{{ $value['status'] }}</td>
                  <td>{{ $value['user_id'] }}</td>
                  <td>{{ $value['update_date'] }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection