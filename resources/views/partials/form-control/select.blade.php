<div class="form-group row">
  <label class="col-sm-12 col-md-2 col-form-label">{{ $label }}{!! $required ? '<code>*</code>' : '' !!}</label>
  <div class="{{ $column_length }}">
    <div class="input-group input-group-sm">
      <select name="{{ $name }}" class="form-control form-control-sm {{ $class }}" {{ $attribute }}>
        <option value="">-- {{ __('label.static.select_option') }} --</option>
        @if($optgroup)
        @foreach ($items as $item)
        <optgroup label="{{ $item['text'] }}">
          @foreach ($item['items'] as $val)
          <option value="{{ $val['id'] }}" {{ isset($value) && $value==$val['id'] ? 'selected' : '' }}>{{ $val['text']
            }}</option>
          @endforeach
        </optgroup>
        @endforeach
        @else
        @foreach ($items as $item)
        <option value="{{ $item['id'] }}" {{ isset($value) && $value==$item['id'] ? 'selected' : '' }}>{{ $item['text']
          }}
        </option>
        @endforeach
        @endif
      </select>
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