@php
    if (!isset($list)) {
        $list = \Modules\CRM\Helpers\CRMConfigHelper::getData(config('crm.config.customer.group'));
    }
@endphp
<div class="form-group">
    <label>Nhóm khách hàng</label>
    <select class="form-control custom-select" name="group_id">
        @isset($emptyOption)
            <option value=""> -- Chọn giá trị -- </option>
        @endisset
        @foreach($list as $item)
            <option value="{{$item->id}}"
                    @if( isset($val) && $item->id == $val)
            selected
                    @endif>{{$item->name}}</option>
        @endforeach
    </select>
</div>