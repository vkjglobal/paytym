<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('employer.home') }}" class="sidebar-brand">
            Paytym
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>

            <!-- Dashboard -->
            <li class="nav-item {{ request()->is('employer') ? 'active' : '' }}">
                <a href="{{ route('employer.home') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item nav-category">Menus</li>

            <!-- Requests -->

            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#requests" role="button" aria-expanded="false"
                    aria-controls="requests">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Requests</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="requests">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('employer.leave.requests') }}"
                                class="nav-link {{ request()->is('employer/leave-requests') ? 'active' : '' }}">
                                Leave Requests
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.payment.requests') }}"
                                class="nav-link {{ request()->is('employer/payment-requests') ? 'active' : '' }}">
                                Payment Requests
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Requests end -->


            <!-- Branch -->

            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse"  href="#branch" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Branch</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="branch">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('employer.branch.create')}}"
                                class="nav-link {{ request()->is('employer/branch/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.branch.list') }}"
                                class="nav-link {{ request()->is('employer/branch/list') ? 'active' : '' }}">
                                List
                            </a>
            </li>
            </ul>
                </div>
                
            </li>

            <!-- Branch End -->


              <!-- Departments -->

              <li class="nav-item">
                <a class="nav-link"  data-toggle="collapse" href="#departments"  role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Departments</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="departments">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('employer.department.create')}}"
                                class="nav-link {{ request()->is('employer/departments') ? 'active' : '' }}">
                                Create
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('employer.department.index')}}"
                                class="nav-link {{ request()->is('employer/departments/list') ? 'active' : '' }}">
                                List
                            </a>
                        </li>
                    </ul>
                </div>
                
            </li>

            <!-- Departments End -->

              <!-- Users -->

              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#users" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Users</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="users">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('employer.user.create') }}"
                                class="nav-link {{ request()->is('employer/leave-requests') ? 'active' : '' }}">
                                Add Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.payment.requests') }}"
                                class="nav-link {{ request()->is('employer/payment-requests') ? 'active' : '' }}">
                                Payment Requests
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Users End -->

              <!-- Calender -->

              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#calender" role="button" aria-expanded="false"
                    aria-controls="requests">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Calender</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="calender">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('employer.leave.requests') }}"
                                class="nav-link {{ request()->is('employer/leave-requests') ? 'active' : '' }}">
                                Leave Requests
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.payment.requests') }}"
                                class="nav-link {{ request()->is('employer/payment-requests') ? 'active' : '' }}">
                                Payment Requests
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Calender End -->

              <!-- Roster -->

              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#roster" role="button" aria-expanded="false"
                    aria-controls="requests">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Roster</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="roster">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('employer.leave.requests') }}"
                                class="nav-link {{ request()->is('employer/leave-requests') ? 'active' : '' }}">
                                Leave Requests
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.payment.requests') }}"
                                class="nav-link {{ request()->is('employer/payment-requests') ? 'active' : '' }}">
                                Payment Requests
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Roster End -->

              <!-- Chat -->

              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#chat" role="button" aria-expanded="false"
                    aria-controls="requests">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Chat</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="chat">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('employer.leave.requests') }}"
                                class="nav-link {{ request()->is('employer/leave-requests') ? 'active' : '' }}">
                                Leave Requests
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.payment.requests') }}"
                                class="nav-link {{ request()->is('employer/payment-requests') ? 'active' : '' }}">
                                Payment Requests
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Chat End -->

              <!-- Employee -->

              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#employee" role="button" aria-expanded="false"
                    aria-controls="requests">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Employee</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="employee">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('employer.leave.requests') }}"
                                class="nav-link {{ request()->is('employer/leave-requests') ? 'active' : '' }}">
                                Leave Requests
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.payment.requests') }}"
                                class="nav-link {{ request()->is('employer/payment-requests') ? 'active' : '' }}">
                                Payment Requests
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Employee End -->

          






        </ul>
    </div>
</nav>
