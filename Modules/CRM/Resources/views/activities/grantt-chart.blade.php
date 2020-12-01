@extends('layouts.master')
@section('content')
    @include('crm::menu')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="card card-outline-info">
                <div class="card-body">
                    <form action="" class="form-horizontal">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tên</label>
                                        <input type="text" class="form-control" name="name" placeholder="Tên" value="{{Arr::get($filters, 'name')}}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    @include('crm::components.dropdown', [
                                        'list' => $customers,
                                        'name' => 'customer_id',
                                        'val' => Arr::get($filters, 'customer_id'),
                                        'label' => 'Khách hàng',
                                        'emptyOption' => true
                                    ])
                                </div>
                                <div class="col-md-4">
                                    @include('crm::config.status',[
                                        'list' => $statuses,
                                        'val' => Arr::get($filters, 'status_id'),
                                        'emptyOption' => true
                                    ])
                                </div>
                                <div class="col-md-4">
                                    @include('crm::config.activity_group', [
                                        'val' => Arr::get($filters, 'group_id'),
                                        'list' => $groups,
                                        'emptyOption' => true
                                    ])
                                </div>
                                <div class="col-md-4">
                                    @include('crm::config.activity_kind', [
                                        'val' => Arr::get($filters, 'kind_id'),
                                        'list' => $kinds,
                                        'emptyOption' => true
                                    ])
                                </div>
                                <div class="col-md-4">
                                    @include('crm::config.activity_type', [
                                        'val' => Arr::get($filters, 'type_id'),
                                        'list' => $types,
                                        'emptyOption' => true
                                    ])
                                </div>

                            </div>
                            <!--/row-->
                        </div>
                        <hr>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-success">Tìm kiếm</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6"> </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="scrolling-container">
                <div id="activity-gantt-container" data-route="{{route('crm.activities.grantt-data', $filters)}}"></div>
            </div>
        </div>
        <footer class="footer"> © 2019</footer>
    </div>
@endsection

@push('script')
    <script type="text/javascript" src="{{asset('assets/plugins/daterangepicker/moment.min.js')}}"></script>
    <script src="https://code.highcharts.com/gantt/highcharts-gantt.js"></script>
    <script src="https://code.highcharts.com/gantt/modules/exporting.js"></script>
    <script src="{{ mix('js/crm.js') }}"></script>
@endpush