@php
    if (!isset($markets)) {
        $markets = \Modules\CRM\Helpers\CRMConfigHelper::getData(config('crm.config.common.market'));
    }
@endphp
<div class="form-group">
    <label>Thị trường</label>
    <select class="form-control custom-select" name="market_id">
        @isset($emptyOption)
            <option value=""> -- Chọn giá trị -- </option>
        @endisset
        @foreach($markets as $market)
            <option value="{{$market->id}}" @if( isset($val) && $market->id == $val)
            selected
                    @endif>{{$market->name}}</option>
        @endforeach
    </select>
</div>