<div class="form-group row">
  <label class="col-sm-12 col-md-2 col-form-label">{{ $label }}{!! $required ? '<code>*</code>' : '' !!}</label>
  <div class="{{ $column_length }}">
    <div class="row">
      <div class="col-auto col-form-checkbox">
        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
          <input type="checkbox" class="custom-control-input {{ $class }}" id="{{ $name }}" name="{{ $name }}" value="1" {{ isset($value) && $value ? 'checked' : '' }} {{ $attribute }}>
          <label class="custom-control-label" for="{{ $name }}"></label>
        </div>
      </div>
      <div class="col-auto">
        @if(isset($tooltip))
        <button type="button" class="btn" data-toggle="tooltip" data-placement="right" title="{{ $tooltip }}">
          <i class="fas fa-info-circle text-info"></i>
        </button>
        @endif
      </div>
    </div>
  </div>
</div>