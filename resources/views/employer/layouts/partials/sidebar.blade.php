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

            <!-- <li class="nav-item">
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
            </li> -->

            <!-- Requests end -->


            <!-- Branch -->

            <li class="nav-item {{ request()->is('employer/branch*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse"  href="#branch" role="button" aria-expanded="false" aria-controls="branch">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Branch</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse  {{ request()->is('employer/branch*') ? 'show' : '' }}" id="branch">
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

              <li class="nav-item {{ request()->is('employer/department*') ? 'active' : '' }}">
                <a class="nav-link"  data-toggle="collapse" href="#departments"  role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Departments</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/department*') ? 'show' : '' }}" id="departments">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('employer.department.create')}}"
                                class="nav-link {{ request()->is('employer/department/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('employer.department.index')}}"
                                class="nav-link {{ request()->is('employer/department') ? 'active' : '' }}">
                                List
                            </a>
                        </li>
                    </ul>
                </div>
                
            </li>

            <!-- Departments End -->

              <!-- Users -->

              <li class="nav-item {{ request()->is('employer/user*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#users" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Users</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/user*') ? 'show' : '' }}" id="users">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('employer.user.create') }}"
                                class="nav-link {{ request()->is('employer/user/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.user.index') }}"
                                class="nav-link {{ request()->is('employer/user') ? 'active' : '' }}">
                                List
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Users End -->

              <!-- Events -->

              <li class="nav-item {{ request()->is('employer/event*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#events" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Calender</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/event*') ? 'show' : '' }}" id="events">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('employer.event.create') }}"
                                class="nav-link {{ request()->is('employer/event/create') ? 'active' : '' }}">
                               Create Events
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.event.index') }}"
                                class="nav-link {{ request()->is('employer/event') ? 'active' : '' }}">
                                List Events
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Events End -->

             <!-- projects -->

             <li class="nav-item {{ request()->is('employer/project*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#project" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Projects</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/project*') ? 'show' : '' }}" id="project">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('employer.project.create') }}"
                                class="nav-link {{ request()->is('employer/project/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.project.index') }}"
                                class="nav-link {{ request()->is('employer/project') ? 'active' : '' }}">
                                List
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Projects End -->



               <!-- Roster -->

              <li class="nav-item  {{ request()->is('employer/roster*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#roster" role="button" aria-expanded="false"
                    aria-controls="requests">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Rosters</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/roster*') ? 'show' : '' }}" id="roster">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('employer.roster.create') }}"
                                class="nav-link {{ request()->is('employer/roster/create') ? 'active' : '' }}">
                                Create 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.roster.index') }}"
                                class="nav-link {{ request()->is('employer/roster') ? 'active' : '' }}">
                                List
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Roster End -->

            
               <!-- Deduction -->

               <li class="nav-item  {{ request()->is('employer/deduction*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#deduction" role="button" aria-expanded="false"
                    aria-controls="requests">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Deductions</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/deduction*') ? 'show' : '' }}" id="deduction">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('employer.deduction.create') }}"
                                class="nav-link {{ request()->is('employer/deduction/create') ? 'active' : '' }}">
                                Create 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.deduction.index') }}"
                                class="nav-link {{ request()->is('employer/deduction') ? 'active' : '' }}">
                                List
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Deduction End -->



              <!-- Calender -->

              <!-- <li class="nav-item">
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
            </li> -->

            <!-- Calender End -->

              <!-- Roster -->

              <!-- <li class="nav-item">
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
            </li> -->

            <!-- Roster End -->

              <!-- Chat -->

              <!-- <li class="nav-item">
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
            </li> -->

            <!-- Chat End -->

              <!-- Employee -->

              <!-- <li class="nav-item">
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
            </li> -->

            <!-- Employee End -->

          






        </ul>
    </div>
</nav>
