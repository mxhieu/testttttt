@php
    if (!isset($list)) {
        $list = [];
    }
@endphp
<div class="form-group">
    <label>{{ isset($label) ? $label : 'Cấu hình' }}</label>
    <select class="form-control custom-select" name="{{ isset($name) ? $name : 'config_id' }}">
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