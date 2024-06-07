@extends('layouts/default')
@section('title', __('label.navigation.menu.general'))
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <form class="form-lazy-control" data-action="{{ $action }}" data-method="upload">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12 col-md-3">
                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist">
                  <a class="nav-link font-weight-bold active" id="vert-tabs-api-tab" data-toggle="pill" href="#vert-tabs-api" role="tab">{{
                    __('label.general.form.api') }}</a>
                </div>
              </div>
              <div class="col-sm-12 col-md-9">
                <div class="tab-content" id="vert-tabs-tabContent">
                  <div class="tab-pane text-left fade show active" id="vert-tabs-api" role="tabpanel">
                    <div class="form-group row">
                      <label class="col-sm-12 col-md-2 col-form-label">{{ __('label.general.form.api_key')
                        }}<code>*</code></label>
                      <div class="col-sm-12 col-md-8">
                        <div class="input-group input-group-sm">
                          <input type="text" id="api_key" name="api_key" class="form-control form-control-sm"
                            value="{{ isset($api_key) ? $api_key : '' }}" readonly required>
                          <div class="input-group-tooltips">
                            <span class="input-group-text" data-toggle="tooltip" data-placement="right"
                              title="{{ __('label.general.tooltip.api_key') }}">
                              <i class="fas fa-info-circle text-info"></i>
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-2">
                        <button type="button" name="copy" class="btn btn-sm btn-outline-secondary">
                          <i class="fas fa-copy"></i>
                        </button>
                        <button type="button" name="generate" class="btn btn-sm btn-outline-primary">
                          <i class="fas fa-rotate"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="form-button">
              <div class="row justify-content-center">
                <div class="col-sm-1">
                  @include('partials.button.default', [
                  'action' => route('account'),
                  'class' => 'btn-sm btn-block btn-outline-secondary',
                  'icon' => 'fas fa-arrow-circle-left',
                  'label' => __('label.button.back'),
                  ])
                </div>
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
<div class="modal fade" id="modalAuth">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-lazy-control" data-action="{{ route('setting.general.generate') }}">
        <div class="modal-header p-2 justify-content-center">
          <h4 class="modal-title text-center">{{ __('label.modal.auth.title') }}</h4>
        </div>
        <div class="modal-body p-2">
          <div class="alert hidden" role="alert"></div>
          <div class="row">
            <div class="col-sm-12">
              <div class="input-group mb-2">
                <input type="text" name="username" class="form-control" placeholder="{{ __('label.login.username') }}"
                  required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="input-group">
                <input type="password" name="password" class="form-control"
                  placeholder="{{ __('label.login.password') }}" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer p-2 d-block">
          <div class="form-button text-enter">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">{{
              __('label.button.cancel') }}</button>
            <button type="submit" class="btn btn-outline-success btn-sm">{{ __('label.button.proceed') }}</button>
          </div>
          <div class="form-loading">
            <img src="{{ asset('img/loading.gif') }}" height="40">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('push-js')
<script>
  bsCustomFileInput.init();

  $('input[name=image]').on('change', function(e) {
    let file = this.files[0];
    if (file) {
      let reader = new FileReader();
      reader.onload = function(event) {
        $("#img-preview").attr("src", event.target.result);
      };
      reader.readAsDataURL(file);
    }
  });
    
  $('button[name=generate]').on('click', function(){
    $('#modalAuth').modal({ backdrop: "static", keyboard: false, });
  })

  $('button[name=copy]').on('click', function(){
    var parent = $(this).closest('div.form-group');
    var $temp = $("<input>");
    var toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
    });

    $("body").append($temp);
    $temp.val(parent.find('input').val()).select();
    document.execCommand("copy");
    $temp.remove()
    toast.fire({
      icon: 'info',
      text: "{{ __('label.general.form.copied', ['id' => 'API Key']) }}",
    })
  })
</script>
@endsection