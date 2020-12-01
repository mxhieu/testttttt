@extends('layouts.master')
@section('content')
    @include('event::menu')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="loading">loading...</div>
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
@endsection
@push('style')
<link href="{{asset('assets/plugins/calendar/main.min.css')}}" rel="stylesheet" />
@endpush
@push('script')
<script src="{{asset('assets/plugins/moment/moment.js')}}"></script>

<script src="{{ Module::asset('event:js/calendar.js') }}"></script>
@endpush