<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile">
            <!-- User profile image -->
            <div class="profile-img"> <img src="../assets/images/users/1.jpg" alt="user" /> </div>
            <!-- User profile text-->
            <div class="profile-text"> <a href="#" class="dropdown-toggle link u-dropdown" data-toggle="dropdown"
                    role="button" aria-haspopup="true" aria-expanded="true">Markarn Doe
                    <span class="caret"></span></a>
                <div class="dropdown-menu animated flipInY">
                    <a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                    <a href="#" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a>
                    <a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                    <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"><i class="ti-settings"></i>
                        Account Setting</a>
                    <div class="dropdown-divider"></div> <a href="login.html" class="dropdown-item"><i
                            class="fa fa-power-off"></i> Logout</a>
                </div>
            </div>
        </div>
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <hr>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span
                            class="hide-menu">Doanh Nghiệp<span
                                class="label label-rounded label-success">1</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="cfg_home.html">Thông tin chung</a></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span
                            class="hide-menu">Khu vực<span class="label label-rounded label-success">1</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="cfg_zone_list.html">Danh sách</a></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span
                            class="hide-menu">CRM<span class="label label-rounded label-success">4</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="cfg_crm_customer_category.html">Loại khách hàng</a></li>
                        <li><a href="cfg_crm_customer_group.html">Nhóm khách hàng</a></li>
                        <li><a href="cfg_crm_relationship.html">Mối quan hệ</a></li>
                        <li><a href="cfg_crm_list.html">Danh Sách</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span
                            class="hide-menu">SCM <span class="label label-rounded label-success">4</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="cfg_scm_supplier_category.html">Loại NCC</a></li>
                        <li><a href="cfg_scm_supplier_group.html">Nhóm NCC</a></li>
                        <li><a href="cfg_scm_relationship.html">Mối quan hệ</a></li>
                        <li><a href="cfg_scm_list.html">Danh Sách</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span
                            class="hide-menu">Nhà sản xuất<span
                                class="label label-rounded label-success">4</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="cfg_producer_supplier_category.html">Loại NSX</a></li>
                        <li><a href="cfg_producer_supplier_group.html">Nhóm NSX</a></li>
                        <li><a href="cfg_producer_relationship.html">Mối quan hệ</a></li>
                        <li><a href="cfg_producer_list.html">Danh sách</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span
                            class="hide-menu">Kho<span class="label label-rounded label-success">3</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="cfg_stock_category.html">Loại Kho</a></li>
                        <li><a href="cfg_stock_standard.html">Tiêu chuẩn</a></li>
                        <li><a href="cfg_stock_status.html">Trạng thái</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span
                            class="hide-menu">Dự Án<span class="label label-rounded label-success">4</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="cfg_prj_category.html">Loại Dự Án</a></li>
                        <li><a href="cfg_prj_group.html">Nhóm Dự Án</a></li>
                        <li><a href="cfg_prj_priority.html">Độ ưu tiên</a></li>
                        <li><a href="cfg_prj_status.html">Trạng thái</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span
                            class="hide-menu">Công việc<span
                                class="label label-rounded label-success">4</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('config.taskcategory.index')}}">Danh mục công việc</a></li>
                        <li><a href="{{route('config.taskgroup.index')}}">Nhóm công việc</a></li>
                        <li><a href="{{route('config.tasktype.index')}}">Loại công việc</a></li>
                        <li><a href="{{route('config.taskpriority.index')}}">Độ ưu tiên</a></li>
                        <li><a href="{{route('config.taskphrase.index')}}">Giai đoạn công việc</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span
                            class="hide-menu">Sự kiện<span class="label label-rounded label-success">4</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('config.eventcategory.index')}}">Danh mục</a></li>
                        <li><a href="{{route('config.eventgroup.index')}}">Nhóm</a></li>
                        <li><a href="{{route('config.eventtype.index')}}">Loại</a></li>
                        <li><a href="{{route('config.eventpriority.index')}}">Độ ưu tiên</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span
                            class="hide-menu">Ticket<span class="label label-rounded label-success">4</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="cfg_ticket_category.html">Loại thẻ</a></li>
                        <li><a href="cfg_ticket_group.html">Nhóm thẻ</a></li>
                        <li><a href="cfg_ticket_priority.html">Độ ưu tiên</a></li>
                        <li><a href="cfg_ticket_status.html">Trạng thái</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span
                            class="hide-menu">Tài sản<span class="label label-rounded label-success">4</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="cfg_asset_category.html">Loại tài sản</a></li>
                        <li><a href="cfg_asset_group.html">Nhóm tài sản</a></li>
                        <li><a href="cfg_asset_priority.html">Độ ưu tiên</a></li>
                        <li><a href="cfg_asset_status.html">Trạng thái</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span
                            class="hide-menu">Thông tin<span
                                class="label label-rounded label-success">4</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="cfg_info_category.html">Loại thông tin</a></li>
                        <li><a href="cfg_info_group.html">Nhóm thông tin</a></li>
                        <li><a href="cfg_info_priority.html">Độ ưu tiên</a></li>
                        <li><a href="cfg_info_status.html">Trạng thái</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span
                            class="hide-menu">Tài chính</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('config.index', ['resource' => config('config.finance.moneyUnit')])}}">Đơn vị tiền tệ</a></li>
                        <li><a href="{{route('config.index', ['resource' => config('config.finance.bank')])}}">Ngân hàng</a></li>
                        <li><a href="{{route('config.index', ['resource' => config('config.finance.paymentType')])}}">HT Thanh toán</a></li>
                        <li><a href="{{route('config.index', ['resource' => config('config.finance.status')])}}">Trạng thái</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span
                            class="hide-menu">HRM<span class="label label-rounded label-success">4</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('config.department.index')}}">Phòng ban</a></li>
                        <li><a href="{{route('config.position.index')}}">Chức vụ</a></li>
                        <li><a href="{{route('config.employee.index')}}">Nhân sự</a></li>
                        <li><a href="{{route('config.employeegroup.index')}}">Nhóm nhân sự</a></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span
                            class="hide-menu">Sản phẩm</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('config.index', ['resource' => config('config.product.unit')])}}">Đơn vị</a></li>
                        <li><a href="{{route('config.index', ['resource' => config('config.product.group')])}}">Nhóm Sản Phẩm</a></li>
                        <li><a href="{{route('config.index', ['resource' => config('config.product.kind')])}}">Loại Sản Phẩm</a></li>
                        <li><a href="{{route('config.index', ['resource' => config('config.product.type')])}}">Kiểu Sản Phẩm</a></li>
                        <li><a href="{{route('config.index', ['resource' => config('config.product.quality')])}}">Chất lượng</a></li>
                        <li><a href="{{route('config.index', ['resource' => config('config.product.color')])}}">Màu</a></li>
                        <li><a href="{{route('config.index', ['resource' => config('config.product.size')])}}">Kích thước</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span
                            class="hide-menu">Dịch vụ<span class="label label-rounded label-success">4</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="cfg_service_unit.html">Đơn vị</a></li>
                        <li><a href="cfg_service_category.html">Chủng loại</a></li>
                        <li><a href="cfg_service_group.html">Nhóm</a></li>
                        <li><a href="cfg_service_list.html">Danh sách</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span
                            class="hide-menu">Cấu hình chung <span
                                class="label label-rounded label-success">3</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="cfg_system_usetime.html">Thời gian sử dụng</a></li>
                        <li><a href="cfg_system_module.html">Module</a></li>
                        <li><a href="cfg_system_account.html">Tài khoảng</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <div class="sidebar-footer">
        <!-- item-->
        <a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
        <!-- item-->
        <a href="" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
    </div>
    <!-- End Bottom points-->
</aside>