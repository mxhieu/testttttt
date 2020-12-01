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
        <div class="input-group">
          <span class="input-group-btn">
            <a id="{{$id}}" data-input="thumbnail-{{$id}}" data-preview="holder-{{$id}}" class="btn btn-primary text-white">
              <i class="fa fa-picture-o"></i> {{$label}}
            </a>
          </span>
            <input id="thumbnail-{{$id}}" class="form-control" type="hidden" name="{{$name}}" value="{{ is_array($value) ? implode(',', $value) : $value}}">
        </div>
    </div>
    <br>
    <div class="{{$wrapHolderClass}}">
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
        var lfm = function(id, type, options) {
            let button = document.getElementById(id);

            button.addEventListener('click', function () {
                var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
                var target_input = document.getElementById(button.getAttribute('data-input'));
                var target_preview = document.getElementById(button.getAttribute('data-preview'));

                window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
                window.SetUrl = function (items) {
                    var file_path = items.map(function (item) {
                        return item.url;
                    }).join(',');

                    // set the value of the desired input to image url
                    target_input.value = file_path;
                    target_input.dispatchEvent(new Event('change'));

                    // clear previous preview
                    target_preview.innerHtml = '';

                    // set or change the preview image src
                    items.forEach(function (item) {
                        let img = document.createElement('img')
                        img.setAttribute('style', 'height: 5rem');
                        var src = item.is_image ? item.thumb_url : '/assets/theme/images/file.png'
                        img.setAttribute('src', src)
                        target_preview.appendChild(img);
                    });

                    // trigger change event
                    target_preview.dispatchEvent(new Event('change'));
                };
            });
        };

        lfm('{{$id}}', 'file', {prefix: route_prefix});
    </script>
@endpush