<div class="modal fade" id="modalDelete">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-lazy-control">
        <div class="modal-header p-2 justify-content-center">
          <h4 class="modal-title text-center">{{ __('label.modal.delete.title') }}</h4>
        </div>
        <div class="modal-body p-2">
          <div class="alert hidden" role="alert"></div>
          <div class="row"></div>
        </div>
        <div class="modal-footer p-2 d-block">
          <div class="form-button text-enter">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">{{ __('label.button.cancel') }}</button>
            <button type="submit" class="btn btn-outline-danger btn-sm">{{ __('label.button.proceed') }}</button>
          </div>
          <div class="form-loading">
            <img src="{{ asset('img/loading.gif') }}" height="40">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>