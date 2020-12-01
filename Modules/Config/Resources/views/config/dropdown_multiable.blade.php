@php
    if (!isset($list)) {
        $list = [];
    }
@endphp
<div class="form-group">
    @isset($label) <label> {{$label}}</label> @endisset
    <select class="select2 mb-2 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Choose" name="{{ isset($name) ? $name : 'config_id' }}">
        @foreach($list as $item)
            <option
                    value="{{$item->id}}"
                    @if( isset($val) && in_array($item->id, $val))
                    selected
                    @endif >
                {{$item->name}}
            </option>
        @endforeach
    </select>
</div>