@extends('layouts.master')
@section('content')
    @include('tms::menu')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="scrolling-container">
                <div id="container"></div>
            </div>
        </div>
        <footer class="footer"> © 2019</footer>
    </div>
@endsection
@push('style')
@push('script')
<script type="text/javascript" src="{{asset('assets/plugins/daterangepicker/moment.min.js')}}"></script>
<script src="https://code.highcharts.com/gantt/highcharts-gantt.js"></script>
<script src="https://code.highcharts.com/gantt/modules/exporting.js"></script>
<script src="{{ Module::asset('tms:js/gantt-chart.js') }}"></script>
@endpush