<div class="form-group row">
  <label class="col-sm-12 col-md-2 col-form-label">{{ $label }}{!! $required ? '<code>*</code>' : '' !!}</label>
  <div class="{{ $column_length }}">
    <div class="input-group input-group-sm">
      <input type="password" id="{{ $name }}" name="{{ $name }}" class="form-control form-control-sm {{ $class }}" value="{{ isset($value) ? $value : '' }}" {{ $attribute }}>
      @if(isset($tooltip))
      <div class="input-group-tooltips">
        <span class="input-group-text" data-toggle="tooltip" data-placement="right" title="{{ $tooltip }}">
          <i class="fas fa-info-circle text-info"></i>
        </span>
      </div>
      @endif
    </div>
  </div>
</div>