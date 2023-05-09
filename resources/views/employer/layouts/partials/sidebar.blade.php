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




            <!-- Request -->

            <!-- <li class="nav-item {{ request()->is('employer/leave-requests*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#requests" role="button" aria-expanded="false"
                    aria-controls="requests">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Leave</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/leave-requests*') ? 'show' : '' }}"  id="requests">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('employer.leave.requests') }}"
                                class="nav-link {{ request()->is('employer/leave-requests') ? 'active' : '' }}">
                                Leave Requests
                            </a>
                        </li>
                    </ul>
                </div>
            </li>  -->

            <!-- Request end -->


            <!-- Leave -->

            <li class="nav-item {{ request()->is('employer/leave-requests*') ? 'active' : '' }}">

                <a class="nav-link" data-toggle="collapse" href="#leave" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Leave</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/leave-requests*') ? 'show' : '' }}" id="leave">
                    <ul class="nav sub-menu">

                        <li class="nav-item {{ request()->is('employer/leave-type*') ? 'active' : '' }}">
                            <a class="nav-link" data-toggle="collapse" href="#leavetype" role="button" aria-expanded="false" aria-controls="requests">
                                <span>Leave Types</span>
                                <i class="link-arrow" data-feather="chevron-down"></i>
                            </a>
                            <div class="collapse {{ request()->is('employer/leave-type/*') ? 'show' : '' }}" id="leavetype">
                                <ul class="nav sub-menu">
                                    <li class="nav-item">
                                        <a href="{{route('employer.leave-type.create')}}" class="nav-link {{ request()->is('employer/leave-type/create') ? 'active' : '' }}">
                                            Create
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{route('employer.leave-type.index')}}" class="nav-link {{ request()->is('employer/leave_type') ? 'active' : '' }}">
                                            List
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="nav-item ">
                            <a href="{{ route('employer.leave.requests') }}" class="nav-link {{ request()->is('employer/leave-requests') ? 'active' : '' }}">

                                Leave Requests
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <!-- Leave end -->

            <!-- Holiday  start -->
            <li class="nav-item {{ request()->is('employer/holiday*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#holiday" role="button" aria-expanded="false" aria-controls="holiday">
                    <i class="link-icon" data-feather="briefcase"></i>
                    <span class="link-title">Holiday</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse  {{ request()->is('employer/holiday*') ? 'show' : '' }}" id="holiday">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('employer.holiday.create')}}" class="nav-link {{ request()->is('employer/business/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.holiday.index') }}" class="nav-link {{ request()->is('employer/business') ? 'active' : '' }}">
                                List
                            </a>
                        </li>
                    </ul>
                </div>

            </li>

            <!-- Holiday end -->

            <!-- Branch -->

            <li class="nav-item {{ request()->is('employer/business*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#business" role="button" aria-expanded="false" aria-controls="branch">
                    <i class="link-icon" data-feather="briefcase"></i>
                    <span class="link-title">Business</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse  {{ request()->is('employer/business*') ? 'show' : '' }}" id="business">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('employer.business.create')}}" class="nav-link {{ request()->is('employer/business/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.business.index') }}" class="nav-link {{ request()->is('employer/business') ? 'active' : '' }}">
                                List
                            </a>
                        </li>
                    </ul>
                </div>

            </li>

            <!-- Branch End -->


            <!-- Branch -->

            <li class="nav-item {{ request()->is('employer/branch*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#branch" role="button" aria-expanded="false" aria-controls="branch">
                    <i class="link-icon" data-feather="archive"></i>
                    <span class="link-title">Branch</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse  {{ request()->is('employer/branch*') ? 'show' : '' }}" id="branch">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('employer.branch.create')}}" class="nav-link {{ request()->is('employer/branch/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.branch.list') }}" class="nav-link {{ request()->is('employer/branch/list') ? 'active' : '' }}">
                                List
                            </a>
                        </li>
                    </ul>
                </div>

            </li>

            <!-- Branch End -->


            <!-- Departments -->

            <li class="nav-item {{ request()->is('employer/department*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#departments" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="layers"></i>
                    <span class="link-title">Departments</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/department*') ? 'show' : '' }}" id="departments">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('employer.department.create')}}" class="nav-link {{ request()->is('employer/department/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('employer.department.index')}}" class="nav-link {{ request()->is('employer/department') ? 'active' : '' }}">
                                List
                            </a>
                        </li>
                    </ul>
                </div>

            </li>

            <!-- Departments End -->

            <!-- Employees -->

            <li class="nav-item {{ request()->is('employer/user*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#users" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="user"></i>
                    <span class="link-title">Employees</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/user*') ? 'show' : '' }}" id="users">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('employer.user.create') }}" class="nav-link {{ request()->is('employer/user/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.user.index') }}" class="nav-link {{ request()->is('employer/user') ? 'active' : '' }}">
                                List
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Employees End -->

            <!-- Calendar -->

            <li class="nav-item {{ request()->is('employer/event*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#events" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">Calender</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/event*') ? 'show' : '' }}" id="events">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('employer.event.create') }}" class="nav-link {{ request()->is('employer/event/create') ? 'active' : '' }}">
                                Create Events
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.event.index') }}" class="nav-link {{ request()->is('employer/event') ? 'active' : '' }}">
                                List Events
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Calendar End -->

            <!-- projects -->

            <li class="nav-item {{ request()->is('employer/project*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#project" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="book"></i>
                    <span class="link-title">Projects</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/project*') ? 'show' : '' }}" id="project">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('employer.assign.create') }}" class="nav-link {{ request()->is('employer/project/assign/create') ? 'active' : '' }}">
                                Assign Project
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('employer.assign.index') }}" class="nav-link {{ request()->is('employer/project/assign') ? 'active' : '' }}">
                                List Assigned Projects
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.project.create') }}" class="nav-link {{ request()->is('employer/project/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.project.index') }}" class="nav-link {{ request()->is('employer/project') ? 'active' : '' }}">
                                List
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Projects End -->



            <!-- Roster -->

            <li class="nav-item  {{ request()->is('employer/roster*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#roster" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="clipboard"></i>
                    <span class="link-title">Rosters</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/roster*') ? 'show' : '' }}" id="roster">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('employer.roster.create') }}" class="nav-link {{ request()->is('employer/roster/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.roster.index') }}" class="nav-link {{ request()->is('employer/roster') ? 'active' : '' }}">
                                List
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Roster End -->

            <!-- Allowance -->

            <li class="nav-item  {{ request()->is('employer/allowance*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#allowance" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="user-plus"></i>
                    <span class="link-title">Allowances</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/allowance*') ? 'show' : '' }}" id="allowance">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('employer.allowance.create') }}" class="nav-link {{ request()->is('employer/allowance/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.allowance.index') }}" class="nav-link {{ request()->is('employer/allowance') ? 'active' : '' }}">
                                List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.assignallowance.index') }}" class="nav-link {{ request()->is('employer/allowance/assignallowance') ? 'active' : '' }}">
                                Assign
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- allowance End -->


            <!-- Deduction -->

            <li class="nav-item  {{ request()->is('employer/deduction*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#deduction" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="user-minus"></i>
                    <span class="link-title">Deductions</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/deduction*') ? 'show' : '' }}" id="deduction">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('employer.deduction.create') }}" class="nav-link {{ request()->is('employer/deduction/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.deduction.index') }}" class="nav-link {{ request()->is('employer/deduction') ? 'active' : '' }}">
                                List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.assigndeduction.index') }}" class="nav-link {{ request()->is('employer/deduction/assigndeduction') ? 'active' : '' }}">
                                Assign
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Deduction End -->

            <!-- Benefits -->

            <li class="nav-item {{ request()->is('employer/benefit*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#benefit" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="user-plus"></i>
                    <span class="link-title">Benefits</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/benefit*') ? 'show' : '' }}" id="benefit">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('employer.benefit.create')}}" class="nav-link {{ request()->is('employer/benefit/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('employer.benefit.index')}}" class="nav-link {{ request()->is('employer/benefit') ? 'active' : '' }}">
                                List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('employer.assignbenefit.index')}}" class="nav-link {{ request()->is('employer/benefit/assignbenefit') ? 'active' : '' }}">
                                Assign
                            </a>
                        </li>
                    </ul>
                </div>

            </li>

            <!-- Benefits End -->

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

            <!-- Payroll -->

            <li class="nav-item {{ request()->is('employer/payroll') ? 'active' : '' }}">

                <a class="nav-link" data-toggle="collapse" href="#payroll" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="dollar-sign"></i>
                    <span class="link-title">Payroll</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/payroll') ? 'show' : '' }}" id="payroll">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('employer.payroll.index') }}" class="nav-link {{ request()->is('employer/payroll') ? 'active' : '' }}">
                                List
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <!-- Payroll end -->
            <!-- Payroll budget -->

            <li class="nav-item  {{ request()->is('employer/payroll-budget*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#payroll-budget" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="user-plus"></i>
                    <span class="link-title">Payroll Budget</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/payroll-budget*') ? 'show' : '' }}" id="payroll-budget">
                    <ul class="nav sub-menu">

                        <li class="nav-item">
                            <a href="{{ route('employer.payroll-budget.create') }}" class="nav-link {{ request()->is('employer/payroll-budget/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.payroll-budget.index') }}" class="nav-link {{ request()->is('employer/payroll-budget') ? 'active' : '' }}">
                                List
                            </a>
                        </li>

                    </ul>
                </div>
            </li>


            <!-- Payroll budget end -->

            <!-- Uploads -->

            <li class="nav-item {{ request()->is('employer/uploads*') ? 'active' : '' }} {{ request()->is('employer/file_type*') ? 'active' : '' }}">

                <a class="nav-link" data-toggle="collapse" href="#uploads" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Uploads</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/upload*') ? 'show' : '' }} {{ request()->is('employer/file_type*') ? 'show' : '' }}" id="uploads">
                    <ul class="nav sub-menu">

                        <li class="nav-item {{ request()->is('employer/file_type*') ? 'active' : '' }}">
                            <a class="nav-link" data-toggle="collapse" href="#filetype" role="button" aria-expanded="false" aria-controls="requests">
                                <span>File Type</span>
                                <i class="link-arrow" data-feather="chevron-down"></i>
                            </a>
                            <div class="collapse {{ request()->is('employer/file_type*') ? 'show' : '' }}" id="filetype">
                                <ul class="nav sub-menu">
                                    <li class="nav-item">
                                        <a href="{{route('employer.file_type.create')}}" class="nav-link {{ request()->is('employer/file_type/create') ? 'active' : '' }}">
                                            Create
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{route('employer.file_type.index')}}" class="nav-link {{ request()->is('employer/file_type') ? 'active' : '' }}">
                                            List
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="nav-item ">
                            <a href="{{ route('employer.uploads.index') }}" class="nav-link {{ request()->is('employer/upload*') ? 'active' : '' }}">

                                Uploads
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <!-- Uploads end -->


            <!-- Attendance end -->

            <li class="nav-item  {{ request()->is('employer/attendance*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#attendance" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Attendance</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/attendance*') ? 'show' : '' }}" id="attendance">
                    <ul class="nav sub-menu">

                        <li class="nav-item">
                            <a href="{{ route('employer.attendance.create') }}" class="nav-link {{ request()->is('employer/attendance/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.attendance.index') }}" class="nav-link {{ request()->is('employer/attendance') ? 'active' : '' }}">
                                List
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="nav-item {{ request()->is('employer/support-tickets*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#supportticket" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="user-plus"></i>
                    <span class="link-title">Support Tickets</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/supportticket*') ? 'show' : '' }}" id="supportticket">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{route('employer.supportticket.create')}}" class="nav-link {{ request()->is('employer/supportticket/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('employer.supportticket.index')}}" class="nav-link {{ request()->is('employer/supportticket') ? 'active' : '' }}">
                                List
                            </a>
                        </li>
                    </ul>
                </div>

            </li>

            <!-- Support Tickets End -->

            <!-- Support Tickets End -->

            <!-- Attendance end -->

            <!-- Provident/Super Fund end -->

            <li class="nav-item  {{ request()->is('employer/providentfund*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#providentfund" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="user-plus"></i>
                    <span class="link-title">Provident Fund</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/providentfund*') ? 'show' : '' }}" id="providentfund">
                    <ul class="nav sub-menu">

                        <li class="nav-item">
                            <a href="{{ route('employer.providentfund.create') }}" class="nav-link {{ request()->is('employer/providentfund/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.providentfund.index') }}" class="nav-link {{ request()->is('employer/providentfund') ? 'active' : '' }}">
                                List
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <!--Provident/Super Fund end -->


            <!-- User Role -->

            <li class="nav-item  {{ request()->is('employer/userroles*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#userroles" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">User Role</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/userroles*') ? 'show' : '' }}" id="userroles">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('employer.userroles.create') }}" class="nav-link {{ request()->is('employer/user-role/create') ? 'active' : '' }}">
                               Create
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('employer.userroles.index') }}" class="nav-link {{ request()->is('employer/userroles') ? 'active' : '' }}">
                                List
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!--User Role end -->




            <!-- User Capability -->

            <li class="nav-item  {{ request()->is('employer/usercapabilities*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#capabilities" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">User Capabilities</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/usercapabilities*') ? 'show' : '' }}" id="capabilities">
                    <ul class="nav sub-menu">
                        <!-- <li class="nav-item">
                            <a href="{{ route('employer.usercapabilities.create') }}" class="nav-link {{ request()->is('employer/usercapabilities/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="{{ route('employer.usercapabilities.index') }}" class="nav-link {{ request()->is('employer/usercapabilities') ? 'active' : '' }}">
                                List
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <!--User Capability end -->


            <!-- Payroll Settings -->
            <li class="nav-item {{ request()->is('employer/payroll-settings') ? 'active' : '' }}">

                <a class="nav-link" data-toggle="collapse" href="#payroll-setting" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="settings"></i>
                    <span class="link-title">Payroll Settings</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/payroll-settings*') ? 'show' : '' }}" id="payroll-setting">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('employer.payroll-setting-hourly.index') }}" class="nav-link {{ request()->is('employer/payroll-settings') ? 'active' : '' }}">
                                Hourly
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
            <!--Payroll Settings End-->




            <!-- Payslip Settings -->
            <li class="nav-item {{ request()->is('employer/payslip') ? 'active' : '' }}">

                <a class="nav-link" data-toggle="collapse" href="#payslip" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="settings"></i>
                    <span class="link-title">Payslip Settings</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/payslip*') ? 'show' : '' }}" id="payslip">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('employer.payslip.show') }}" class="nav-link {{ request()->is('employer/payslip/show') ? 'active' : '' }}">
                                Template
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
            <!--Payslip Settings End-->


            <!-- Report -->
            <li class="nav-item {{ request()->is('employer/report') ? 'active' : '' }}">

                <a class="nav-link" data-toggle="collapse" href="#report" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="clipboard"></i>
                    <span class="link-title">Report</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/report*') ? 'show' : '' }}" id="report">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('employer.report.employee') }}" class="nav-link {{ request()->is('employer/report/employee') ? 'active' : '' }}">
                                Employees
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.report.attendance.search') }}" class="nav-link {{ request()->is('employer/report/attendance*') ? 'active' : '' }}">
                                Attendance
                           </a>
                       </li>
                       <li class="nav-item">
                        <a href="{{ route('employer.report.employment_period') }}"
                            class="nav-link {{ request()->is('employer/report/employment_period') ? 'active' : '' }}">
                             Employment Periods
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employer.report.status') }}"
                            class="nav-link {{ request()->is('employer/report/status') ? 'active' : '' }}">
                             Status Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employer.report.allowance') }}"
                            class="nav-link {{ request()->is('employer/report/allowance*') ? 'active' : '' }}">
                             Allowance/Bonus/Commission
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employer.report.deduction') }}"
                            class="nav-link {{ request()->is('employer/report/deduction*') ? 'active' : '' }}">
                             Deduction Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employer.report.payroll') }}"
                            class="nav-link {{ request()->is('employer/report/payroll*') ? 'active' : '' }}">
                             Payroll Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employer.report.providentfund') }}"
                            class="nav-link {{ request()->is('employer/report/providentfund*') ? 'active' : '' }}">
                            Provident Fund Report
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employer.report.tax') }}"
                            class="nav-link {{ request()->is('employer/report/tax*') ? 'active' : '' }}">
                            Tax Report
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employer.report.payslip') }}"
                            class="nav-link {{ request()->is('employer/report/payslip*') ? 'active' : '' }}">
                            Payslip Report
                        </a>
                    </li>
                       
                   </ul>
               </div>
           </li>
            <!--Report End-->


            <!-- Commission -->
            <li class="nav-item {{ request()->is('employer/commission*') ? 'active' : '' }}">
                <a href="{{ route('employer.commission.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="user-plus"></i>
                    <span class="link-title">Commission</span>
                </a>
            </li>

            <!-- bonus -->

            <li class="nav-item  {{ request()->is('employer/bonus*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#bonus" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="user-plus"></i>
                    <span class="link-title">Bonus</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/bonus*') ? 'show' : '' }}" id="bonus">
                    <ul class="nav sub-menu">

                        <li class="nav-item">
                            <a href="{{ route('employer.bonus.create') }}" class="nav-link {{ request()->is('employer/bonus/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.bonus.index') }}" class="nav-link {{ request()->is('employer/bonus') ? 'active' : '' }}">
                                List
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <!--bonus -->

            <!-- chat -->

            <li class="nav-item  {{ request()->is('employer/groupchat*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#chat" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Chat</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/groupchat*') ? 'show' : '' }}" id="chat">
                    <ul class="nav sub-menu">

                        <li class="nav-item">
                            <a href="{{ route('employer.groupchat.create') }}" class="nav-link {{ request()->is('employer/groupchat/create') ? 'active' : '' }}">
                                Create Group
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.groupchat.index') }}" class="nav-link {{ request()->is('employer/groupchat') ? 'active' : '' }}">
                                List Group
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.groupmember.create') }}" class="nav-link {{ request()->is('employer/groupmember/create') ? 'active' : '' }}">
                                Add Members
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employer.groupmember.index') }}" class="nav-link {{ request()->is('employer/groupmember') ? 'active' : '' }}">
                                List Members
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <!--chat -->

            {{-- <!-- Billing -->
            <li class="nav-item {{ request()->is('employer/billing*') ? 'active' : '' }}">
            <a href="{{ route('employer.commission.index') }}" class="nav-link">
                <i class="link-icon" data-feather="box"></i>
                <span class="link-title">Commission</span>
            </a>
            </li> --}}

            <!-- payment -->

            <li class="nav-item  {{ request()->is('employer/billing*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#payment" role="button" aria-expanded="false" aria-controls="requests">
                    <i class="link-icon" data-feather="dollar-sign"></i>
                    <span class="link-title">Payment</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('employer/billing*') ? 'show' : '' }}" id="payment">
                    <ul class="nav sub-menu">

                        <li class="nav-item">
                            <a href="{{ route('employer.billing.plan') }}" class="nav-link {{ request()->is('employer/billing/plan') ? 'active' : '' }}">
                                Plans
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('employer.bonus.index') }}"
                        class="nav-link {{ request()->is('employer/bonus') ? 'active' : '' }}">
                        List
                        </a>
            </li> --}}

        </ul>
    </div>
    </li>

    <!--payment -->

    <!--check in and check out time -->
    <li class="nav-item {{ request()->is('employer/check-in-out-time*') ? 'active' : '' }}">
        <a href="{{ route('employer.checkinout') }}" class="nav-link">
            <i class="link-icon" data-feather="clock"></i>
            <span class="link-title">Checkin-Checkout time</span>
        </a>
    </li>
    <!--check in and check out time end -->

    <!--Split Payment-->
    <li class="nav-item {{ request()->is('employer/split_payment*') ? 'active' : '' }}">
        <a href="{{ route('employer.split_payment.wallet') }}" class="nav-link">
            <i class="link-icon" data-feather="dollar-sign"></i>
            <span class="link-title">Split Payment</span>
        </a>
    </li>
    <!--Split Payment-->



    </ul>
    </div>
</nav>