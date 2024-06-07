<div class="form-group row">
  <label class="col-sm-12 col-md-2 col-form-label">{{ $label }}{!! $required ? '<code>*</code>' : '' !!}</label>
  <div class="{{ $column_length }}">
    <div class="row">
      <div class="col-auto col-form-radio">
        @foreach ($items as $item)
        <div class="form-check">
          <input class="form-check-input" type="radio" id="{{ $name }}_{{ $item['id'] }}" name="{{ $name }}"
            value="{{ $item['id'] }}" {{ in_array($item['id'], $value) ? 'checked' : '' }}>
          <label class="form-check-label">{{ $item['text'] }}</label>
        </div>
        @endforeach
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