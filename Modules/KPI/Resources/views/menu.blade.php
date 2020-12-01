<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <div class="user-profile">
            <div class="profile-text"> <a href="#" class="dropdown-toggle link u-dropdown" data-toggle="dropdown"
                    role="button" aria-haspopup="true" aria-expanded="true">Markarn Doe
                    <span class="caret"></span></a>
                <div class="dropdown-menu animated flipInY">
                    <a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                    <a href="#" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a>
                    <a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                    <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"><i class="ti-settings"></i>
                        Account Setting</a>
                    <div class="dropdown-divider"></div> <a href="login.html" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                </div>
            </div>
        </div>
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <hr>
                </li>
                <li>
                    <a href=""><i class="mdi mdi-gauge"></i><span class="hide-menu">Home</span></a>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span
                            class="hide-menu">Biểu mẫu<span class="label label-rounded label-success">3</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('kpi.form.index')}}">Danh sách</a></li>
                        <li><a href="{{route('kpi.form.index')}}">Form</a></li>
                        <li><a href="{{route('kpi.category.index')}}">Loại biểu mẫu</a></li>
                        <li><a href="{{route('kpi.group.index')}}">Nhóm biểu mẫu</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('kpi.periods.index')}}"><i class="mdi mdi-gauge"></i><span class="hide-menu">Kỳ đánh giá</span></a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="sidebar-footer">
        <a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
        <a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
        <a href="" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
    </div>
</aside>