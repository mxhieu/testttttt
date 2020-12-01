@php
    if (!isset($list)) {
        $list = \App\User::all(['id', 'name']);
    }
@endphp
<div class="form-group">
    <label>Nhân viên</label>
    <select class="form-control custom-select" name="employee_id">
        @isset($emptyOption)
            <option value=""> -- Chọn giá trị -- </option>
        @endisset
        @foreach($list as $item)
            <option value="{{$item->id}}" @if( isset($val) && $item->id == $val)
            selected
                    @endif>{{$item->name}}</option>
        @endforeach
    </select>
</div>