<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <div class="user-profile">
            {{-- <div class="profile-img"> <img src="../assets/images/users/1.jpg" alt="user" /> </div> --}}
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
                    <a href=""><i class="mdi mdi-gauge"></i><span class="hide-menu">Home</span></a>
                </li>
                <li>
                    <a href="{{route('event.event.index')}}"><i class="mdi mdi-gauge"></i><span class="hide-menu">Danh sách</span></a>
                </li>
                <li>
                    <a href=""><i class="mdi mdi-gauge"></i><span class="hide-menu">Lịch</span></a>
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