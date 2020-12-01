@php
    if (!isset($list)) {
        $list = \Modules\CRM\Helpers\CRMConfigHelper::getData(config('crm.config.common.status'));
    }
@endphp
<div class="form-group">
    <label>Trạng thái</label>
    <select class="form-control custom-select" name="status_id">
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