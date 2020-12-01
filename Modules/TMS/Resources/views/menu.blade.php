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
                <a href="{{route('tms.tasknoneproject.home')}}"><i class="mdi mdi-gauge"></i><span class="hide-menu">Home</span></a>
                </li>
                <li>
                    <a href="{{route('tms.tasknoneproject.ganttchart')}}"><i class="mdi mdi-gauge"></i><span class="hide-menu">Gantt Chart</span></a>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span
                            class="hide-menu">Cá nhân<span class="label label-rounded label-success">3</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('tms.tasknoneproject.index')}}">Không dự án</a></li>
                        {{-- <li><a href="tms_personal_non_prj.html">Không dự án</a></li> --}}
                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span
                            class="hide-menu">Phòng Ban<span
                                class="label label-rounded label-success">3</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="">Admin</a></li>
                        <li><a href="">Kinh Doanh</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span
                            class="hide-menu">Loại CV<span class="label label-rounded label-success">3</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="">Thiết kế</a></li>
                        <li><a href="">Thẩm Định</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span
                            class="hide-menu">Nhóm CV<span class="label label-rounded label-success">3</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="">Nhóm 1</a></li>
                        <li><a href="">Nhóm 2</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span
                            class="hide-menu">Trạng Thái CV<span
                                class="label label-rounded label-success">3</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="">Not start</a></li>
                        <li><a href="">Delay</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span
                            class="hide-menu">Độ Ưu Tiên CV<span
                                class="label label-rounded label-success">3</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="">Thấp</a></li>
                        <li><a href="">Cao</a></li>
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