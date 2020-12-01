@php
    $color = optional($data)->color;
    $name = optional($data)->name;
@endphp
@if($color)
    <span class="label label-rounded" style="background-color: {{ $color  }}">{{ $name}}</span>
@else
    {{ $name}}
@endif
