@extends('layouts/default')
@section('title', __('label.navigation.menu.upload'))
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <form class="form-lazy-control" data-action="{{ $action }}" data-method="upload">
        <div class="card">
          <div class="card-header">
          </div>
          <div class="card-body">
            {{ FormControl::file(
            'file',
            10,
            ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel'],
            __('label.upload.form.file'),
            null,
            __('label.upload.tooltip.file'),
            [],
            ['required' => $mandatory]
            ) }}
          </div>
          <div class="card-footer">
            <div class="form-button">
              <div class="row justify-content-center">
                <div class="col-sm-1">
                  @include('partials.button.submit')
                </div>
              </div>
            </div>
            <div class="form-loading">
              <img src="{{ asset('img/loading.gif') }}" height="40">
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection