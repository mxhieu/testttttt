@php
    if (!isset($list)) {
        $list = [];
    }
@endphp
<div class="form-group">
    @isset($label) <label> {{$label}}</label> @endisset
    <select class="form-control custom-select" name="{{ isset($name) ? $name : 'config_id' }}">
        @isset($emptyOption)
            <option value=""> -- Chọn giá trị -- </option>
        @endisset
        @foreach($list as $item)
            <option
                    value="{{$item->id}}"
                    @if( isset($val) && $item->id == $val)
                    selected
                    @endif >
                {{$item->name}}
            </option>
        @endforeach
    </select>
</div>