@extends('layouts/default')
@section('title', __('label.navigation.home'))
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <h1>GIAR RAMANSAH</h1>
        </div>
      </div>
    </div>
    {{-- <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          {{ FormControl::date(
          'test_date',
          3,
          'Test Single Date',
          '2024-01-01',
          'Test Single Date',
          ['form-date'],
          []
          ) }}
          {{ FormControl::date(
          'test_range',
          3,
          'Test Range Date',
          ['2024-01-01', '2024-01-10'],
          'Test Range Date',
          ['form-date-range'],
          []
          ) }}
          {{ FormControl::checkbox(
          'test_checkbox',
          3,
          [['id' => 1, 'text' => 'First'], ['id' => 2, 'text' => 'Second'], ['id' => 3, 'text' => 'Third']],
          'Test Checkbox',
          [2],
          'Test Checkbox',
          [],
          []
          ) }}
          {{ FormControl::radiobox(
          'test_radiobox',
          3,
          [['id' => 1, 'text' => 'First'], ['id' => 2, 'text' => 'Second'], ['id' => 3, 'text' => 'Third']],
          'Test Radiobox',
          [2],
          'Test Radiobox',
          [],
          []
          ) }}
          {{ FormControl::file(
          'test_file',
          3,
          ['image/png', 'image/jpg'],
          'Test File',
          null,
          'Test File',
          [],
          []
          ) }}
          {{ FormControl::switch(
          'test_switch',
          3,
          'Test Switch',
          null,
          'Test Switch',
          [],
          []
          ) }}
        </div>
      </div>
    </div>
    <div class="col-sm-12">
      <form class="form-lazy-control" data-action="{{ route('home.post') }}" data-method="upload">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Test Upload File</h4>
          </div>
          <div class="card-body">
            {{ FormControl::text(
            'first_name',
            3,
            __('label.account.form.first_name'),
            isset($first_name) ? $first_name : null,
            __('label.account.tooltip.first_name'),
            [],
            ['maxlength' => 32],
            ) }}
            {{ FormControl::text(
            'last_name',
            3,
            __('label.account.form.last_name'),
            isset($last_name) ? $last_name : null,
            __('label.account.tooltip.last_name'),
            [],
            ['maxlength' => 32],
            ) }}
            {{ FormControl::file(
            'test_files',
            3,
            ['image/png', 'image/jpg'],
            'Test File',
            null,
            'Test File',
            [],
            []
            ) }}
            {{ FormControl::file(
            'test_files',
            3,
            ['image/png', 'image/jpg'],
            'Test File',
            null,
            'Test File',
            [],
            []
            ) }}
            {{ FormControl::file(
            'test_files',
            3,
            ['image/png', 'image/jpg'],
            'Test File',
            null,
            'Test File',
            [],
            []
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
    <div class="col-sm-12">
      <form class="form-lazy-control" data-action="{{ route('home.post') }}" data-method="post"
        data-validate="password">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Test Password Form</h4>
          </div>
          <div class="card-body">
            {{ FormControl::text(
            'username',
            3,
            __('label.account.form.username'),
            null,
            __('label.account.tooltip.username'),
            [],
            ['minlength' => 6, 'format' => 'alphanum'],
            ) }}
            {{ FormControl::password(
            'password',
            3,
            __('label.account.form.password'),
            null,
            __('label.account.tooltip.password'),
            [],
            ['minlength' => 8, 'password' => true],
            ) }}
            {{ FormControl::password(
            'confirm_password',
            3,
            __('label.account.form.confirm_password'),
            null,
            __('label.account.tooltip.confirm_password'),
            [],
            ['minlength' => 8, 'equal-to' => '#password'],
            ) }}
            {{ FormControl::file(
            'test_file_validate',
            10,
            ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel'],
            'Test File',
            null,
            'Test File',
            [],
            []
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
    </div> --}}
  </div>
</div>
@endsection