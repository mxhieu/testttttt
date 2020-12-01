<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <hr />
                </li>
                <li>
                    <a href="{{route('crm.dashboard.index')}}">
                        <i class="mdi mdi-gauge"></i>
                        <span class="hide-menu">Tổng quan</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-settings"></i><span
                                class="hide-menu">Cấu hình</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('crm.config.index', ['resource' => config('crm.config.customer.kind')])}}">Loại khách hàng</a></li>
                        <li><a href="{{route('crm.config.index', ['resource' => config('crm.config.customer.group')])}}">Nhóm khách hàng</a></li>
                        <li><a href="{{route('crm.config.index', ['resource' => config('crm.config.customer.type')])}}">Kiểu khách hàng</a></li>
                        <li><a href="{{route('crm.config.index', ['resource' => config('crm.config.common.relation')])}}"
                            >Mối quan hệ</a></li>
                        <li><a href="{{route('crm.config.index', ['resource' => config('crm.config.common.business')])}}">Mảng kinh doanh</a></li>
                        <li><a href="{{route('crm.config.index', ['resource' => config('crm.config.common.department')])}}">Phòng ban</a></li>
                        <li><a href="{{route('crm.config.index', ['resource' => config('crm.config.common.position')])}}">Chức vụ</a></li>
                        {{--<li><a href="{{route('crm.config.index', ['resource' => config('crm.config.common.status')])}}">Trạng thái</a></li>--}}
                        <li><a href="{{route('crm.config.index', ['resource' => config('crm.config.sale.kind')])}}">Loại phiếu bán hàng</a></li>
                        <li><a href="{{route('crm.config.index', ['resource' => config('crm.config.activity.kind')])}}">Loại hoạt động</a></li>
                        <li><a href="{{route('crm.config.index', ['resource' => config('crm.config.activity.type')])}}">Kiểu hoạt động</a></li>
                        <li><a href="{{route('crm.config.index', ['resource' => config('crm.config.activity.group')])}}">Nhóm hoạt động</a></li>
                        <li><a href="{{route('crm.config.index', ['resource' => config('crm.config.marketing.kind')])}}">Loại Marketing</a></li>
                        <li><a href="{{route('crm.config.index', ['resource' => config('crm.config.marketing.type')])}}">Kiểu Marketing</a></li>
                        <li><a href="{{route('crm.config.index', ['resource' => config('crm.config.marketing.group')])}}">Nhóm Marketing</a></li>
                        <li><a href="{{route('crm.config.index', ['resource' => config('crm.config.common.market')])}}">Thị trường</a></li>
                        <li><a href="{{route('crm.config.index', ['resource' => config('crm.config.common.channel')])}}">Kênh</a></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span
                                class="hide-menu">Marketing</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('crm.marketing.index')}}">Danh sách</a></li>
                        <li><a href="{{route('crm.marketing.create')}}">Thêm mới</a></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-account-circle"></i><span
                                class="hide-menu">Khách Hàng</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('crm.customers.index')}}">Danh sách</a></li>
                        <li><a href="{{route('crm.customers.create')}}">Thêm mới</a></li>
                        <li><a href="{{route('crm.feedback.index')}}">Phản hồi</a></li>
                        <li><a href="{{route('crm.activities.index')}}">Hoạt động</a></li>
                        <li><a href="{{route('crm.contacts.index')}}">Liên hệ</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-pandora"></i><span
                                class="hide-menu">Sản phẩm</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('crm.products.index')}}">Danh sách</a></li>
                        <li><a href="{{route('crm.products.create')}}">Thêm mới</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-sale"></i><span
                                class="hide-menu">Phiếu bán hàng</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('crm.sales.index')}}">Danh sách</a></li>
                        <li><a href="{{route('crm.sales.create')}}">Thêm mới</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('crm.deliveries.index')}}">
                        <i class="mdi mdi-truck-delivery"></i>
                        <span class="hide-menu">Giao hàng</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('crm.payments.index')}}">
                        <i class="mdi mdi-currency-eur"></i>
                        <span class="hide-menu">Thanh toán</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('crm.activities.grantt')}}">
                        <i class="mdi mdi-currency-eur"></i>
                        <span class="hide-menu">Hoạt động</span>
                    </a>
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