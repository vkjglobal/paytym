<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('admin.home') }}" class="sidebar-brand">
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
            <li class="nav-item {{ request()->is('admin') ? 'active' : '' }}">
                <a href="{{ route('admin.home') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item nav-category">Menus</li>

            <!-- Employers -->
            <li class="nav-item {{ request()->is('admin/employers*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#employers" role="button" aria-expanded="false" aria-controls="employers">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Employers</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('admin/employers*') ? 'show' : '' }}" id="employers">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.employers.index') }}" class="nav-link {{ request()->is('admin/employers') ? 'active' : '' }}">
                                List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.employers.create') }}" class="nav-link {{ request()->is('admin/employers/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Employers end -->

             <!---Country--->
             <li class="nav-item {{ request()->is('admin/banner*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#country" role="button" aria-expanded="false" aria-controls="banner">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Country</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('admin/banner*') ? 'show' : '' }}" id="country">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.country.index') }}" class="nav-link {{ request()->is('admin/country') ? 'active' : '' }}">
                                List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.country.create') }}" class="nav-link {{ request()->is('admin/country/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li>
                    </ul>
                </div>
            </li> 

            <!----End Country----->

            <!---Subscriptions--->
            <li class="nav-item {{ request()->is('admin/subscriptions*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#subscriptions" role="button" aria-expanded="false" aria-controls="subscriptions">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Subscription</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('admin/subscriptions*') ? 'show' : '' }}" id="subscriptions">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.subscriptions.index') }}" class="nav-link {{ request()->is('admin/employers') ? 'active' : '' }}">
                                List
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="{{ route('admin.subscriptions.create') }}" class="nav-link {{ request()->is('admin/subscriptions/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li> -->
                    </ul>
                </div>
            </li>

            <!----End Subscription----->

            <!---Custom Subscriptions--->
            <li class="nav-item {{ request()->is('admin/custom_subscriptions*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#custom_subscriptions" role="button" aria-expanded="false" aria-controls="subscriptions">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Custom Subscription</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('admin/custom_subscriptions*') ? 'show' : '' }}" id="custom_subscriptions">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.custom_subscriptions.index') }}" class="nav-link {{ request()->is('admin/custom_subscriptions') ? 'active' : '' }}">
                                List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.custom_subscriptions.create') }}" class="nav-link {{ request()->is('admin/custom_subscriptions/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!----End Subscription----->

            <!---CMS--->
             <li class="nav-item {{ request()->is('admin/cms*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#cms" role="button" aria-expanded="false" aria-controls="cms">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Manage CMS</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('admin/cms*') ? 'show' : '' }}" id="cms">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.cms.index') }}" class="nav-link {{ request()->is('admin/cms') ? 'active' : '' }}">
                                List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.cms.create') }}" class="nav-link {{ request()->is('admin/cms/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li>
                    </ul>
                </div>
            </li> 

            <!----End CMS----->

             <!---Banner--->
             <li class="nav-item {{ request()->is('admin/banner*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#banner" role="button" aria-expanded="false" aria-controls="banner">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Manage Banners</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('admin/banner*') ? 'show' : '' }}" id="banner">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.banner.index') }}" class="nav-link {{ request()->is('admin/banner') ? 'active' : '' }}">
                                List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.banner.create') }}" class="nav-link {{ request()->is('admin/banner/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li>
                    </ul>
                </div>
            </li> 

            <!----End Banner----->


 <!-- Support Tickets -->
            <li class="nav-item {{ request()->is('admin/support-tickets') ? 'active' : '' }}">
                <a href="{{ route('admin.supportticket') }}" class="nav-link">
                    <i class="link-icon" data-feather="layers"></i>
                    <span class="link-title">Support Tickets</span>
                </a>
            </li>
            
            


            <!-- Contacts -->
            <li class="nav-item {{ request()->is('admin/contact') ? 'active' : '' }}">
                <a href="{{ route('admin.contact') }}" class="nav-link">
                    <i class="link-icon" data-feather="layers"></i>
                    <span class="link-title">Contacts</span>
                </a>
            </li>


            <!---Reports--->
            <li class="nav-item {{ request()->is('admin/reports*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#report" role="button" aria-expanded="false" aria-controls="banner">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Country</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('admin/report*') ? 'show' : '' }}" id="report">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.main_report') }}" class="nav-link {{ request()->is('admin/report/main_report') ? 'active' : '' }}">
                                Employers
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('admin.country.create') }}" class="nav-link {{ request()->is('admin/country/create') ? 'active' : '' }}">
                                Create
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </li> 

            <!----End Country----->

        </ul>
    </div>
</nav>