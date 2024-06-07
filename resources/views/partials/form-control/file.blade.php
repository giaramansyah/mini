<div class="form-group row">
  <label class="col-sm-12 col-md-2 col-form-label">{{ $label }}{!! $required ? '<code>*</code>' : '' !!}</label>
  <div class="{{ $column_length }}">
    <div class="input-group input-group-sm">
      <div class="custom-file custom-file-sm">
        <input type="file" class="custom-file-input {{ $class }}" id="{{ $name }}" name="{{ $name }}" {!! $filetypes !!} {{ $attribute }}>
        <label class="custom-file-label" for="{{ $name }}">{{ __('label.static.file') }}</label>
      </div>
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