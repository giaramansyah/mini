<div class="form-group row">
  <label class="col-sm-12 col-md-2 col-form-label">{{ $label }}{!! $required ? '<code>*</code>' : '' !!}</label>
  <div class="{{ $column_length }}">
    <div class="input-group input-group-sm">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <i class="fas fa-calendar-alt"></i>
        </div>
      </div>
      @if($is_range)
      <input type="hidden" name="{{ $name }}" class="start-date" value="{{ isset($value[0]) ? $value[0] : '' }}">
      <input type="hidden" name="{{ $name }}" class="end-date" value="{{ isset($value[1]) ? $value[1] : '' }}">
      @else
      <input type="hidden" name="{{ $name }}" class="single-date" value="{{ isset($value) ? $value : '' }}">
      @endif
      <input type="text" id="picker_{{ $name }}" name="picker_{{ $name }}" class="form-control form-control-sm {{ $class }}" readonly {{ $attribute }}>
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