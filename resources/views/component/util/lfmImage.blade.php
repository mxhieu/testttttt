@php
    $wrapContainerClass = isset($wrap_container_class) ? $wrap_container_class : '';
    $label = isset($label) ? $label : 'Name';
    $labelClass = isset($label_class) ? $label_class : 'col-md-4';
    $name = isset($name) ? $name : 'name';
    $wrapInputClass = isset($wrap_input_class) ? $wrap_input_class : 'col-md-12';
    $value = isset($value) ? $value : '';
    $attributes = isset($attributes) ? $attributes : [];
    $inputClass = 'form-control m-input admin-input';
    $inputClass = isset($class) ? $inputClass . ' ' . $class : $inputClass;
    $id = isset($id) ? $id : $name;
    $wrapHolderClass = isset($wrap_input_class) ? $wrap_input_class : 'col-md-12';
@endphp
<div class="form-group m-form__group row {{$wrapContainerClass}}">
    <div class="custom-file wrapper-input {{$wrapInputClass}}">
        <div class="input-group text-center" style="display: block">
          <span class="input-group-btn">
            <a id="{{$id}}" data-input="thumbnail-{{$id}}" data-preview="holder-{{$id}}" class="btn btn-primary text-white">
              <i class="fa fa-picture-o"></i> {{$label}}
            </a>
          </span>
            <input id="thumbnail-{{$id}}" class="form-control" type="hidden" name="{{$name}}" value="{{ is_array($value) ? implode(',', $value) : $value}}">
        </div>
    </div>
    <br>
    <div class="{{$wrapHolderClass}} text-center">
        <div id="holder-{{$id}}" class="lfm-display">
            @if($value)
                @if(is_array($value))
                    @foreach($value as $val)
                        <img src="{{$val}}" style="height: 5rem;">
                    @endforeach
                @else
                <img src="{{$value}}" style="height: 5rem;">
                @endif
            @endif
        </div>
    </div>
</div>
@push('script')
    <script>
        {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js')) !!}
    </script>
    <script>
        $('#{{$id}}').filemanager('image', {prefix: route_prefix});
    </script>
@endpush