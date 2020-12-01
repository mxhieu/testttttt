@extends('layouts.master')
@section('content')
<div class="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-lg-3 col-xlg-3">
                <a href="crm_home.html">
                <div class="card card-inverse card-info">
                    <div class="box bg-info text-center">
                        <h1 class="font-light text-white"><i class="fas fa-address-book"></i></h1>
                        <h6 class="text-white">CRM</h6>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3 col-xlg-3">
                <a href="scm_home.html">
                <div class="card card-primary card-inverse">
                    <div class="box text-center">
                        <h1 class="font-light text-white"><i class="fas fa-address-book"></i></h1>
                        <h6 class="text-white">SCM</h6>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3 col-xlg-3">
                <a href="wms_home.html">
                <div class="card card-inverse card-success">
                    <div class="box text-center">
                        <h1 class="font-light text-white"><i class="fas fa-address-book"></i></h1>
                        <h6 class="text-white">INVENTORY</h6>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3 col-xlg-3">
                <a href="pms_home.html">
                <div class="card card-inverse card-warning">
                    <div class="box text-center">
                        <h1 class="font-light text-white"><i class="fas fa-address-book"></i></h1>
                        <h6 class="text-white">PMS(nhóm) (khai báo,task-gantt,issue,file/image/deliverable)</h6>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3 col-xlg-3">
                <a href="{{route('tms.tasknoneproject.index')}}">
                <div class="card card-inverse card-info">
                    <div class="box bg-info text-center">
                        <h1 class="font-light text-white"><i class="fas fa-address-book"></i></h1>
                        <h6 class="text-white">TMS(nhóm)(nhóm)(Non Prj)</h6>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3 col-xlg-3">
                <a href="calendar_home.html">
                <div class="card card-primary card-inverse">
                    <div class="box text-center">
                        <h1 class="font-light text-white"><i class="fas fa-address-book"></i></h1>
                        <h6 class="text-white">Event(nhóm)(nhóm)</h6>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3 col-xlg-3">
                <a href="hrm_home.html">
                <div class="card card-inverse card-success">
                    <div class="box text-center">
                        <h1 class="font-light text-white"><i class="fas fa-address-book"></i></h1>
                        <h6 class="text-white">HRM (thông tin nhân viên/resource/skill sheet/lương và policy thưởng/submit nghỉ vắng)(low)</h6>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3 col-xlg-3">
                <a href="ticket_home.html">
                <div class="card card-inverse card-warning">
                    <div class="box text-center">
                        <h1 class="font-light text-white"><i class="fas fa-address-book"></i></h1>
                        <h6 class="text-white">Ticket(nhóm)(nhóm)</h6>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3 col-xlg-3">
                <a href="{{route('kpi.form.index')}}">
                <div class="card card-inverse card-info">
                    <div class="box text-center">
                        <h1 class="font-light text-white"><i class="fas fa-address-book"></i></h1>
                        <h6 class="text-white">KPI(nhóm)(nhóm)(tree)</h6>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3 col-xlg-3">
                <a href="info_home.html">
                <div class="card card-primary card-inverse">
                    <div class="box text-center">
                        <h1 class="font-light text-white"><i class="fas fa-address-book"></i></h1>
                        <h6 class="text-white">INFO(nhóm)(nhóm)(Annouce/policy/working flow)/Board</h6>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3 col-xlg-3">
                <a href="board_home.html">
                <div class="card card-inverse card-success">
                    <div class="box text-center">
                        <h1 class="font-light text-white"><i class="fas fa-address-book"></i></h1>
                        <h6 class="text-white">Drive(low priority)</h6>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3 col-xlg-3">
                <a href="fi_home.html">
                <div class="card card-inverse card-warning">
                    <div class="box text-center">
                        <h1 class="font-light text-white"><i class="fas fa-address-book"></i></h1>
                        <h6 class="text-white">Exam(nhóm)(nhóm)(trắc nghiệp đúng/sai)</h6>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3 col-xlg-3">
                <a href="kpi_home.html">
                <div class="card card-inverse card-info">
                    <div class="box text-center">
                        <h1 class="font-light text-white"><i class="fas fa-address-book"></i></h1>
                        <h6 class="text-white">Survey(nhóm)(nhóm)(khoảng giá trị)</h6>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3 col-xlg-3">
                <a href="info_home.html">
                <div class="card card-primary card-inverse">
                    <div class="box text-center">
                        <h1 class="font-light text-white"><i class="fas fa-address-book"></i></h1>
                        <h6 class="text-white">Checklist(nhóm)(nhóm)(click)</h6>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3 col-xlg-3">
                <a href="board_home.html">
                <div class="card card-inverse card-success">
                    <div class="box text-center">
                        <h1 class="font-light text-white"><i class="fas fa-address-book"></i></h1>
                        <h6 class="text-white"> Request form</h6>
                    </div>
                </div>
                </a>
            </div>

             <div class="col-md-6 col-lg-3 col-xlg-3">
                <a href="fi_home.html">
                <div class="card card-inverse card-warning">
                    <div class="box text-center">
                        <h1 class="font-light text-white"><i class="fas fa-address-book"></i></h1>
                        <h6 class="text-white">Minute(nhóm)(nhóm)(đối tượng)(and AI)</h6>
                    </div>
                </div>
                </a>
            </div>
            <!-- Column -->
            <div class="col-md-12 col-lg-12 col-xlg-12">
                <a href="{{route('config.company.index')}}">
                <div class="card card-inverse card-dark">
                    <div class="box text-center">
                        <h1 class="font-light text-white"><i class="fas fa-address-book"></i></h1>
                        <h6 class="text-white">CONFIG</h6>
                    </div>
                </div>
                </a>
            </div>
        </div>
        
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-6">
                                <h2 class="mb-0">Công việc hôm nay</h2>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover no-wrap">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>NAME</th>
                                    <th>STATUS</th>
                                    <th>DATE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td class="txt-oflo">Elite admin</td>
                                    <td><span class="label label-success label-rouded">ONTIME</span> </td>
                                    <td class="txt-oflo">April 18, 2019</td>
                                    
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td class="txt-oflo">Real Homes WP Theme</td>
                                    <td><span class="label label-danger label-rouded">Delay</span></td>
                                    <td class="txt-oflo">April 19, 2019</td>
                                   
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td class="txt-oflo">Ample Admin</td>
                                    <td><span class="label label-warning label-rouded">Advance</span></td>
                                    <td class="txt-oflo">April 19, 2019</td>
                                   
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-6">
                                <h2 class="mb-0">Sự kiện hôm nay</h2>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover no-wrap">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>NAME</th>
                                    <th>Category</th>
                                    <th>Thời gian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td class="txt-oflo">Elite admin</td>
                                    <td><span class="label label-success label-rouded">Sale meeting</span> </td>
                                    <td class="txt-oflo">10:00-11:00</td>
                                    
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td class="txt-oflo">Real Homes WP Theme</td>
                                    <td><span class="label label-info label-rouded">Design review</span></td>
                                    <td class="txt-oflo">11:00-12:00</td>
                                   
                                </tr>
                             
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Column -->
                            <div class="col-lg-6 col-md-12">
                                <h4 class="card-title">Các tin nhắn </h4>
                                
                                <div class="alert alert-danger alert-rounded"> <img src="{{asset('assets/theme/images/users/1.jpg')}}" width="30" class="img-circle" alt="img"> This is an example top alert. You can edit what u wish.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                <div class="alert alert-warning alert-rounded"> <img src="{{asset('assets/theme/images/users/1.jpg')}}" width="30" class="img-circle" alt="img"> This is an example top alert. You can edit what u wish.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                    
                            </div>
                            <!-- Column -->
                            <!-- Column -->
                            <div class="col-lg-6 col-md-12">
                                <h4 class="card-title">Thông báo</h4>
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                    <h3 class="text-success"><i class="fa fa-check-circle"></i> Success</h3> This is an example top alert. You can edit what u wish. Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.
                                </div>
                                <div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                    <h3 class="text-info"><i class="fa fa-exclamation-circle"></i> Information</h3> This is an example top alert. You can edit what u wish. Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.
                                </div>
                                <div class="alert alert-warning">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                    <h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Warning</h3> This is an example top alert. You can edit what u wish. Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.
                                </div>
                            </div>
                            <!-- Column -->
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @include('layouts.footer')
</div>
@endsection