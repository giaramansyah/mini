@extends('layouts/default')
@section('title', __('label.navigation.menu.sales'))
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12 col-md-4">
      <div class="card">
        <div class="card-body box-profile">
          <h3 class="profile-username text-center">{{ __('label.sales.view.id') }}</h3>
          <p class="text-muted text-center">{{ $id }}</p>
          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              <b>{{ __('label.sales.view.invoice_no') }}</b>
              <p class="float-right mb-0">{{ $invoice_no }}</p>
            </li>
            <li class="list-group-item">
              <b>{{ __('label.sales.view.total_weight') }}</b>
              <p class="float-right mb-0">{{ $total_weight }}</p>
            </li>
            <li class="list-group-item">
              <b>{{ __('label.sales.view.shipping_fee') }}</b>
              <p class="float-right mb-0">Rp {{ $shipping_fee }}</p>
            </li>
            <li class="list-group-item">
              <b>{{ __('label.sales.view.total_price') }}</b>
              <p class="float-right mb-0">Rp {{ $total_price }}</p>
            </li>
            <li class="list-group-item">
              <b>{{ __('label.sales.view.total_sale') }}</b>
              <p class="float-right mb-0">{{ $total_sale }}</p>
            </li>
            <li class="list-group-item">
              <b>{{ __('label.sales.view.user_code') }}</b>
              <p class="float-right mb-0">{{ $user_code }}</p>
            </li>
            <li class="list-group-item">
              <b>{{ __('label.sales.view.shipping_address') }}</b>
              <p class="float-right mb-0">{{ $shipping_address }}</p>
            </li>
            <li class="list-group-item">
              <b>{{ __('label.sales.view.shipping_date') }}</b>
              <p class="float-right mb-0">{{ $shipping_date }}</p>
            </li>
            <li class="list-group-item">
              <b>{{ __('label.sales.view.expedition_id') }}</b>
              <p class="float-right mb-0">{{ $expedition_id }}</p>
            </li>
            <li class="list-group-item">
              <b>{{ __('label.sales.view.shipping_type') }}</b>
              <p class="float-right mb-0">{{ $shipping_type }}</p>
            </li>
            <li class="list-group-item">
              <b>{{ __('label.sales.view.sales_date') }}</b>
              <p class="float-right mb-0">{{ $sales_date }}</p>
            </li>
          </ul>
        </div>
        <div class="card-footer">
          <div class="row justify-content-center">
            <div class="col-auto mb-2">
              @include('partials.button.default', [
              'action' => route('master.sales.index'),
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
              <h4 class="card-title mb-0 text-bold">{{ __('label.sales.view.sales_detail') }}</h4>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive table-app table-app-primary">
            <table class="table">
              <thead>
                <tr>
                  <th class="text-center">{{ __('label.sales.table.product_id') }}</th>
                  <th class="text-center">{{ __('label.sales.table.qty') }}</th>
                  <th class="text-center">{{ __('label.sales.table.weight') }}</th>
                  <th class="text-center">{{ __('label.sales.table.unit_price') }}</th>
                  <th class="text-center">{{ __('label.sales.table.discount') }}</th>
                  <th class="text-center">{{ __('label.sales.table.price') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($detail as $key => $value)
                <tr>
                  <td>{{ $value['product_id'] }}</td>
                  <td>{{ $value['qty'] }}</td>
                  <td>{{ $value['weight'] }}</td>
                  <td>Rp {{ $value['unit_price'] }}</td>
                  <td>{{ ($value['discount']*100) }}%</td>
                  <td>Rp {{ $value['price'] }}</td>
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