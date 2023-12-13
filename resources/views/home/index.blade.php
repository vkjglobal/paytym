<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paytym</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Montserrat:ital,wght@0,200;0,300;0,700;0,800;1,200;1,300;1,500;1,600;1,700;1,800;1,900&family=Oswald:wght@200;300&family=Poppins:ital,wght@0,100;0,300;0,400;1,300;1,400;1,500;1,600&family=Urbanist:wght@300&display=swap" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('home_assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('home_assets/css/owl.theme.default.min.css')}}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('home_assets/images/favicon.png')}}" type="">
    <link rel="stylesheet" href="{{asset('home_assets/css/style.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>

    <!-- header-section -->
    <header class="header">
        <div class="top-navigation">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light pl-0 pr-0">
                            <a class="navbar-brand" href="#">
                                <h1 class="m-0 p-0"><img src="{{asset('home_assets/images/logo.png')}}" alt="" srcset=""></h1>
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon">
                                    <i class="fa-solid fa-bars" id="nav-btns" style="display: inline-block;"></i>
                                </span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarText">
                                <ul class="navbar-nav mr-auto ml-auto">

                                    <li class="nav-item">
                                        <a class="nav-link" href="#home">Home</a>
                                    </li>
                                    <!--  @foreach($cms as $count => $cms)
                                    <li class="nav-item"> -->
                                    <!-- <a class="nav-link" href="#tab-{{ $cms->id }}" aria-controls="#tab-{{ $cms->id }}" role="tab" data-toggle="tab">{{ $cms->cms_type }}</a> -->
                                    <!-- <a class="nav-link" href="#{{ $cms->id }}" >{{ $cms->cms_type }}</a>
                                    </li>

@endforeach -->

                                    <!--<li class="nav-item">
                                        <a class="nav-link" href="#about">About</a>
                                    </li>-->
                                    <li class="nav-item">
                                        <a class="nav-link" href="#ForEmployers">Employers</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#ForEmployees">Employees</a>
                                    </li>
                                   <!--  <li class="nav-item">
                                        <a class="nav-link" href="#HowItWork">Registration Process</a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="#pricing">Pricing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#why-paytym">Why Paytym</a>
                                    </li>
                                </ul>
                                <span class="download">
                                    <a href="{{Route('employer.login')}}" class="btn btn-typ2">Login</a>
                                    <a href="#footer" class="btn btn-typ2">Download</a>
                                </span>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <a href="" class="sticky-button"><img src="{{asset('home_assets/images/logo-jobtym.png')}}" alt=""></a>
    </header>


    <!-- Banner Section -->

    <section class="header-section hero-section" id="home">
        <div class="container">
            <div class="row justify-content-center">
               <!-- <div class="col-md-6 text-white  " data-aos="fade-up" data-aos-duration="2000">
                    <div class="text">-->
                        <!-- <h1 class="first-text">Creative <br>Solutions to</h1>
                        <h1 class="sub-text"> Improve your <br>Business.</h1> -->
                       <!-- <div class="banner-txt">
                            Are you looking for an advanced and
                            innovative <strong class="fw-600"> HR management and
                                Payroll software system?</strong>
                            If YES, then we have the perfect
                            solution for you!
                        </div>
                    </div>

                </div>-->
                <div class="col-xl-5 col-lg-6 col-md-8 text-white py-md-0 py-3" data-aos="fade-up" data-aos-duration="2000">
                    <div class="text d-flex flex-column justify-content-center align-items-start">
                        <!-- <h1 class="first-text">Creative <br>Solutions to</h1>
                        <h1 class="sub-text"> Improve your <br>Business.</h1> -->
                        <h3 class="fw-600 mb-4">
                            Transform Your Business with <br class="d-lg-block d-none">Paytym's Powerful HR and Payroll Automation Platform.
                        </h3>
                        <!-- <br class="d-lg-block d-none"> -->
                        <p class="mb-4 pr-4">
                            Unlock stress-free payroll processing with Paytym. Save time, costs, and eliminate errors. Hire, pay, and manage your team effortlessly, all in one place!
                        </p>
                        <a href="{{ route('employer.register') }}" class="btn-typ4 btn-typ-3d px-3 py-2 mx-auto mb-3">Register Now - Pay later</a>
                        <p class="small mx-auto">On-board Employees and Start Processing!</p>
                    </div>

                </div>
                <!-- <div class="col-md-6 pt-3"> -->
                <div class="col-xl-5 col-lg-6 col-md-4 d-flex h-100 align-items-end align-self-end justify-content-md-end justify-content-center">
                    <div class="right-img" data-aos="fade-down" data-aos-duration="2000">
                        @if($bannercount == 0)
                        <img src="{{asset('home_assets/images/banner-bg1.png')}}" alt="" srcset="">
                        @else
                        <img src="{{ asset('storage/' . $banner[0]->image) }}" alt="" srcset="">
                        @endif

                    </div>
                </div>
            </div>
    </section>

    <!-- Banner End -->


    <!-- about-section -->
    <section class="about-section" id="about">
        <div class="container">
            <div class="about-title pt-5 text-center">
                @if(is_null($about))
                <h3>About Paytym</h3>
                <p>Paytym is a cloud-based web and mobile HR management and Payroll software application platform for
                    employers and employees. It greatly reduces manual work and errors and saves time and resources,
                    both for employers and employees, in managing time & attendance and the entire payroll process.
                    Paytym also provides in-app chat and push notifications and automates the statutory filing requirements.
                    Employers can simply <a href="register.html" class="lnk-typ1">Sign Up</a> and commence on-boarding employees.</p>
                @else
                <h3>{{$about->cms_type}}</h3>
                <p>{{ $about->content}}</p>
                @endif

            </div>
        </div>
    </section>
    <!-- about End -->

    <!-- employers-section -->
    <section class="forEmployers-section" id="ForEmployers">
        <div class="container">
            <div class="about-title pt-5 text-center">
                @if(is_null($foremployers))
                <h3> For Employers </h3>
                <p> As an employer, the Paytym app allows you to easily manage your employees and their salaries and
                    payments by country, business, branch and projects and also schedule shifts & meetings. With just a
                    few clicks you can manage attendance, process payroll, track time worked, view leaves due, chat with
                    employees and auto-generate reports. Say goodbye to tedious manual calculations and paperwork, and
                    effortlessly manage all your HR work online.
                </p>
                @else
                <h3>{{$foremployers->cms_type}}</h3>
                <p>{{$foremployers->content}}</p>
                @endif

            </div>
            <div class="feature-wrp position-relative">
                <div class="sub-title text-center pl-md-5 pr-md-5">
                    @if(is_null($empwebfeatures))
                    <h4>Employer Web Features</h4>
                    <p>Easily manage your employees and payroll
                        and maximize your time and resources with
                        our online Paytym portal. Paytym is
                        convenient and user-friendly. Chat with
                        employees directly or their superiors and
                        broadcast and push notifications to their
                        mobile app. View reports and analyse
                        Payroll Budget at a click. Paytym is a next-gen
                        HRMS platform with powerful features
                        suitable for businesses of all sizes.</p>
                    @else
                    <h4>{{$empwebfeatures->cms_type}}</h4>
                    <p>{{$empwebfeatures->content}}</h4>
                        @endif

                </div>
                <div class="row pt-3 justify-content-center" data-aos="zoom-in-up" data-aos-duration="2000">
                    <div class="col-md-4 mb-md-4 mb-3 d-flex">
                        <div class="card-about card1   pb-3">
                            <span class="icon-back  " class="px-2 py-2">
                                <svg width="45" height="46" viewBox="0 0 45 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18.9118 20.5882C16.8758 20.5882 14.8856 19.9845 13.1927 18.8533C11.4998 17.7222 10.1804 16.1145 9.40128 14.2335C8.62214 12.3525 8.41828 10.2827 8.81549 8.28583C9.21269 6.28897 10.1931 4.45474 11.6328 3.01508C13.0724 1.57542 14.9067 0.595003 16.9035 0.197803C18.9004 -0.199397 20.9702 0.00446026 22.8512 0.783597C24.7322 1.56273 26.3399 2.88215 27.471 4.57501C28.6022 6.26787 29.2059 8.25813 29.2059 10.2941C29.2059 13.0243 28.1213 15.6426 26.1908 17.5731C24.2603 19.5037 21.642 20.5882 18.9118 20.5882ZM18.9118 3.05883C17.4575 3.05883 16.0359 3.49007 14.8267 4.29802C13.6175 5.10597 12.6751 6.25434 12.1186 7.59791C11.562 8.94149 11.4164 10.4199 11.7001 11.8462C11.9839 13.2726 12.6842 14.5827 13.7125 15.6111C14.7408 16.6394 16.051 17.3397 17.4773 17.6234C18.9036 17.9071 20.3821 17.7615 21.7256 17.205C23.0692 16.6485 24.2176 15.706 25.0255 14.4968C25.8335 13.2876 26.2647 11.866 26.2647 10.4118C26.2647 9.44616 26.0745 8.49001 25.705 7.59791C25.3355 6.70581 24.7939 5.89523 24.1111 5.21245C23.4283 4.52967 22.6177 3.98805 21.7256 3.61853C20.8335 3.24901 19.8774 3.05883 18.9118 3.05883ZM27.103 22.3676C19.1448 20.5769 10.8192 21.4394 3.3971 24.8235C2.37636 25.3111 1.51514 26.0786 0.913724 27.0367C0.312309 27.9948 -0.00454854 29.1041 4.93372e-05 30.2353V38.9853C4.93331e-05 39.1784 0.0380874 39.3696 0.111991 39.548C0.185895 39.7264 0.294218 39.8886 0.430774 40.0251C0.567331 40.1617 0.729447 40.27 0.907867 40.3439C1.08629 40.4178 1.27752 40.4558 1.47064 40.4558C1.66376 40.4558 1.85499 40.4178 2.03341 40.3439C2.21182 40.27 2.37394 40.1617 2.5105 40.0251C2.64705 39.8886 2.75538 39.7264 2.82928 39.548C2.90318 39.3696 2.94122 39.1784 2.94122 38.9853V30.2353C2.92842 29.6628 3.08302 29.099 3.38604 28.6131C3.68907 28.1272 4.12735 27.7403 4.6471 27.5C9.11808 25.4356 13.9873 24.3764 18.9118 24.397C21.6711 24.3935 24.4209 24.7194 27.103 25.3676V22.3676ZM27.3088 36.3529H36.3382V38.4117H27.3088V36.3529Z" fill="white" />
                                    <path d="M43.5294 27.6176H35.9265V30.5588H42.0588V42.8676H21.2206V30.5588H30.4853V31.1764C30.4853 31.5665 30.6402 31.9405 30.916 32.2163C31.1918 32.4921 31.5658 32.647 31.9559 32.647C32.3459 32.647 32.7199 32.4921 32.9957 32.2163C33.2715 31.9405 33.4265 31.5665 33.4265 31.1764V25.4559C33.4265 25.0658 33.2715 24.6918 32.9957 24.416C32.7199 24.1402 32.3459 23.9853 31.9559 23.9853C31.5658 23.9853 31.1918 24.1402 30.916 24.416C30.6402 24.6918 30.4853 25.0658 30.4853 25.4559V27.6176H19.75C19.36 27.6176 18.9859 27.7726 18.7101 28.0484C18.4344 28.3241 18.2794 28.6982 18.2794 29.0882V44.3382C18.2794 44.7282 18.4344 45.1023 18.7101 45.3781C18.9859 45.6538 19.36 45.8088 19.75 45.8088H43.5294C43.9194 45.8088 44.2935 45.6538 44.5693 45.3781C44.845 45.1023 45 44.7282 45 44.3382V29.0882C45 28.6982 44.845 28.3241 44.5693 28.0484C44.2935 27.7726 43.9194 27.6176 43.5294 27.6176Z" fill="white" />
                                </svg>
                            </span>
                            <div class="card-body pt-3 px-0">
                                @if(is_null($employee_management))
                                <h5 class="card-title pt-2 ">Employee Management</h5>
                                <p class="card-text pt-3 ">On-board new employees, track and manage their information and benefits, time and attendance,
                                    shifts and time off. Show scheduled meetings in calendar.</p>
                                @else
                                <h5 class="card-title pt-2 ">{{ $employee_management->cms_type}}</h5>
                                <p class="card-text pt-3 ">{{ $employee_management->content}}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-md-4 mb-3 d-flex">
                        <div class="card-about card2   pb-3">
                            <span class="icon-back  " class="px-2 py-2">
                                <svg width="39" height="49" viewBox="0 0 39 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 29.5L27 14.5M13.25 15.75H13.275M25.75 28.25H25.775M37 47V7C37 5.67392 36.4732 4.40215 35.5355 3.46447C34.5979 2.52678 33.3261 2 32 2H7C5.67392 2 4.40215 2.52678 3.46447 3.46447C2.52678 4.40215 2 5.67392 2 7V47L10.75 42L19.5 47L28.25 42L37 47ZM14.5 15.75C14.5 16.0815 14.3683 16.3995 14.1339 16.6339C13.8995 16.8683 13.5815 17 13.25 17C12.9185 17 12.6005 16.8683 12.3661 16.6339C12.1317 16.3995 12 16.0815 12 15.75C12 15.4185 12.1317 15.1005 12.3661 14.8661C12.6005 14.6317 12.9185 14.5 13.25 14.5C13.5815 14.5 13.8995 14.6317 14.1339 14.8661C14.3683 15.1005 14.5 15.4185 14.5 15.75ZM27 28.25C27 28.5815 26.8683 28.8995 26.6339 29.1339C26.3995 29.3683 26.0815 29.5 25.75 29.5C25.4185 29.5 25.1005 29.3683 24.8661 29.1339C24.6317 28.8995 24.5 28.5815 24.5 28.25C24.5 27.9185 24.6317 27.6005 24.8661 27.3661C25.1005 27.1317 25.4185 27 25.75 27C26.0815 27 26.3995 27.1317 26.6339 27.3661C26.8683 27.6005 27 27.9185 27 28.25Z" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <div class="card-body pt-3 px-0">
                                @if(is_null($payroll_management))
                                <h5 class="card-title pt-2 ">Payroll Tax and Contribution</h5>
                                <p class="card-text pt-3 ">Automatically calculate and process employee salaries and benefits, such as vacation and leaves, tax
                                    deductions, and other deductions.</p>
                                @else
                                <h5 class="card-title pt-2 ">{{ $payroll_management->cms_type}}</h5>
                                <p class="card-text pt-3 ">{{ $payroll_management->content}}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-md-4 mb-3 d-flex">
                        <div class="card-about card3   pb-3">
                            <span class="icon-back  " class="px-2 py-2">
                                <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M41.6667 4.16666H16.6667C15.5616 4.16666 14.5018 4.60565 13.7204 5.38705C12.939 6.16845 12.5 7.22826 12.5 8.33333V33.3333C12.5 34.4384 12.939 35.4982 13.7204 36.2796C14.5018 37.061 15.5616 37.5 16.6667 37.5H41.6667C42.7717 37.5 43.8315 37.061 44.6129 36.2796C45.3943 35.4982 45.8333 34.4384 45.8333 33.3333V8.33333C45.8333 7.22826 45.3943 6.16845 44.6129 5.38705C43.8315 4.60565 42.7717 4.16666 41.6667 4.16666ZM29.1667 9.375C30.548 9.375 31.8728 9.92373 32.8495 10.9005C33.8263 11.8772 34.375 13.202 34.375 14.5833C34.375 15.9647 33.8263 17.2894 32.8495 18.2662C31.8728 19.2429 30.548 19.7917 29.1667 19.7917C27.7853 19.7917 26.4606 19.2429 25.4838 18.2662C24.5071 17.2894 23.9583 15.9647 23.9583 14.5833C23.9583 13.202 24.5071 11.8772 25.4838 10.9005C26.4606 9.92373 27.7853 9.375 29.1667 9.375ZM39.5833 31.25H18.75V30.7292C18.75 26.8771 23.4458 22.9167 29.1667 22.9167C34.8875 22.9167 39.5833 26.8771 39.5833 30.7292V31.25Z" fill="white" />
                                    <path d="M8.33341 16.6667H4.16675V41.6667C4.16675 43.9646 6.0355 45.8333 8.33341 45.8333H33.3334V41.6667H8.33341V16.6667Z" fill="white" />
                                </svg>
                            </span>
                            <div class="card-body pt-3 px-0">
                                @if(is_null($deposit))
                                <h5 class="card-title pt-2 ">Direct Deposits to Employee Accounts</h5>
                                <p class="card-text pt-3 ">Offer employees the option to split salary and receive payments into multiple accounts as per
                                    channels available in the platform.
                                </p>
                                @else
                                <h5 class="card-title pt-2 ">{{ $deposit->cms_type}}</h5>
                                <p class="card-text pt-3 ">{{ $deposit->content}}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-md-4 mb-3 d-flex">
                        <div class="card-about card4   pb-3">
                            <span class="icon-back  " class="px-2 py-2">
                                <svg width="45" height="46" viewBox="0 0 45 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M23.0907 20.3625C21.509 20.3459 19.9677 19.8617 18.6607 18.9708C17.3536 18.08 16.3394 16.8224 15.7456 15.3564C15.1519 13.8903 15.0051 12.2814 15.3239 10.7321C15.6426 9.18279 16.4126 7.76245 17.5369 6.64987C18.6612 5.53729 20.0895 4.78221 21.6421 4.4797C23.1946 4.1772 24.8019 4.34078 26.2617 4.94987C27.7214 5.55895 28.9683 6.5863 29.8454 7.90258C30.7225 9.21885 31.1906 10.7652 31.1907 12.3469C31.1758 14.4828 30.315 16.5258 28.7967 18.0282C27.2785 19.5306 25.2266 20.37 23.0907 20.3625ZM23.0907 7.1438C22.0654 7.16043 21.0678 7.47966 20.2233 8.06141C19.3788 8.64315 18.7251 9.46145 18.3442 10.4135C17.9633 11.3656 17.8722 12.4091 18.0824 13.4127C18.2926 14.4164 18.7947 15.3356 19.5256 16.0549C20.2565 16.7741 21.1837 17.2614 22.1906 17.4554C23.1975 17.6494 24.2394 17.5416 25.1852 17.1454C26.131 16.7492 26.9387 16.0824 27.5068 15.2287C28.0749 14.3749 28.378 13.3724 28.3782 12.3469C28.3633 10.9569 27.7988 9.62936 26.808 8.65437C25.8172 7.67938 24.4807 7.13629 23.0907 7.1438Z" fill="white" />
                                    <path d="M23.0907 20.3625C21.5091 20.3459 19.9677 19.8617 18.6607 18.9708C17.3537 18.08 16.3395 16.8224 15.7457 15.3564C15.1519 13.8903 15.0052 12.2814 15.3239 10.7321C15.6427 9.18279 16.4127 7.76245 17.537 6.64987C18.6613 5.53729 20.0896 4.78221 21.6421 4.4797C23.1947 4.1772 24.802 4.34078 26.2617 4.94987C27.7215 5.55895 28.9684 6.5863 29.8455 7.90258C30.7226 9.21885 31.1907 10.7652 31.1907 12.3469C31.1759 14.4828 30.315 16.5258 28.7968 18.0282C27.2785 19.5306 25.2267 20.37 23.0907 20.3625ZM23.0907 7.1438C22.0654 7.16043 21.0679 7.47966 20.2234 8.06141C19.3789 8.64315 18.7252 9.46145 18.3443 10.4135C17.9634 11.3656 17.8723 12.4091 18.0825 13.4127C18.2927 14.4164 18.7947 15.3356 19.5257 16.0549C20.2566 16.7741 21.1837 17.2614 22.1907 17.4554C23.1976 17.6494 24.2394 17.5416 25.1853 17.1454C26.1311 16.7492 26.9388 16.0824 27.5069 15.2287C28.075 14.3749 28.3781 13.3724 28.3782 12.3469C28.3634 10.9569 27.7989 9.62936 26.8081 8.65437C25.8173 7.67938 24.4808 7.13629 23.0907 7.1438ZM27.9986 22.2469C21.7612 21.1616 15.34 22.1494 9.71731 25.0594C9.31818 25.281 8.98768 25.6082 8.76198 26.005C8.53628 26.4018 8.42407 26.8531 8.43762 27.3094V32.3157C8.43762 32.6886 8.58578 33.0463 8.8495 33.31C9.11322 33.5738 9.47091 33.7219 9.84387 33.7219C10.2168 33.7219 10.5745 33.5738 10.8382 33.31C11.102 33.0463 11.2501 32.6886 11.2501 32.3157V27.4922C16.464 24.8761 22.3932 24.046 28.1251 25.1297L27.9986 22.2469Z" fill="white" />
                                    <path d="M43.5937 28.3641H34.1719V26.2828C34.1719 25.9099 34.0237 25.5522 33.76 25.2885C33.4963 25.0247 33.1386 24.8766 32.7656 24.8766C32.3927 24.8766 32.035 25.0247 31.7713 25.2885C31.5075 25.5522 31.3594 25.9099 31.3594 26.2828V28.3641H21.0937C20.7208 28.3641 20.3631 28.5122 20.0994 28.776C19.8357 29.0397 19.6875 29.3974 19.6875 29.7703V43.8328C19.6875 44.2058 19.8357 44.5635 20.0994 44.8272C20.3631 45.0909 20.7208 45.2391 21.0937 45.2391H43.5937C43.9667 45.2391 44.3244 45.0909 44.5881 44.8272C44.8518 44.5635 45 44.2058 45 43.8328V29.7703C45 29.3974 44.8518 29.0397 44.5881 28.776C44.3244 28.5122 43.9667 28.3641 43.5937 28.3641ZM42.1875 42.4266H22.5V31.1766H31.3594V31.7531C31.3594 32.1261 31.5075 32.4838 31.7713 32.7475C32.035 33.0112 32.3927 33.1594 32.7656 33.1594C33.1386 33.1594 33.4963 33.0112 33.76 32.7475C34.0237 32.4838 34.1719 32.1261 34.1719 31.7531V31.1766H42.1875V42.4266Z" fill="white" />
                                    <path d="M27.8578 35.986H36.2391V37.9547H27.8578V35.986ZM12.4312 14.6391C8.53797 14.7043 4.7122 15.6667 1.25156 17.4516C0.875197 17.6504 0.559937 17.9478 0.33949 18.3119C0.119042 18.676 0.00169713 19.0932 0 19.5188V23.8782C0 24.2511 0.148158 24.6088 0.411881 24.8725C0.675604 25.1363 1.03329 25.2844 1.40625 25.2844C1.77921 25.2844 2.1369 25.1363 2.40062 24.8725C2.66434 24.6088 2.8125 24.2511 2.8125 23.8782V19.8001C6.11901 18.1542 9.77985 17.3477 13.4719 17.4516C12.9888 16.5703 12.6382 15.6226 12.4312 14.6391ZM43.7484 17.4376C40.6446 15.8094 37.2335 14.8512 33.7359 14.6251C33.53 15.6068 33.1843 16.554 32.7094 17.4376C36.0043 17.5164 39.241 18.3232 42.1875 19.8001V23.8782C42.1875 24.2511 42.3357 24.6088 42.5994 24.8725C42.8631 25.1363 43.2208 25.2844 43.5937 25.2844C43.9667 25.2844 44.3244 25.1363 44.5881 24.8725C44.8518 24.6088 45 24.2511 45 23.8782V19.5188C45.0009 19.0908 44.8847 18.6707 44.6641 18.3038C44.4435 17.937 44.1269 17.6375 43.7484 17.4376ZM12.1781 12.3469V11.4047C11.0765 11.2573 10.0742 10.6907 9.37979 9.82284C8.68541 8.95499 8.3525 7.85277 8.45035 6.74563C8.54819 5.6385 9.06927 4.61175 9.90509 3.87913C10.7409 3.14652 11.8271 2.76448 12.9375 2.81256C14.0925 2.81046 15.2026 3.25956 16.0312 4.06412C16.7624 3.46109 17.5653 2.95096 18.4219 2.54537C17.4651 1.4452 16.1974 0.660766 14.7859 0.295467C13.3743 -0.0698327 11.8852 0.00114677 10.5149 0.49905C9.14449 0.996953 7.95715 1.89841 7.10934 3.0846C6.26152 4.27079 5.79304 5.68604 5.76562 7.14381C5.79514 8.92799 6.48872 10.6371 7.71089 11.9373C8.93307 13.2375 10.596 14.0353 12.375 14.1751C12.2557 13.5727 12.1898 12.9609 12.1781 12.3469ZM32.0203 5.63571e-05C31.0539 0.000269104 30.0973 0.193143 29.2063 0.5674C28.3153 0.941658 27.5079 1.48979 26.8312 2.17974C27.7819 2.52423 28.6809 2.99738 29.5031 3.58599C30.1596 3.13027 30.9275 2.86126 31.7249 2.80765C32.5223 2.75403 33.3192 2.91783 34.0308 3.28157C34.7424 3.64531 35.342 4.19536 35.7655 4.87306C36.1891 5.55076 36.4208 6.33071 36.4359 7.12974C36.4271 7.95048 36.186 8.75193 35.7405 9.44131C35.295 10.1307 34.6634 10.6798 33.9187 11.0251C33.9753 11.4587 34.0035 11.8956 34.0031 12.3329C33.9994 12.8981 33.9523 13.4623 33.8625 14.0204C35.3945 13.6265 36.7532 12.7373 37.7273 11.491C38.7014 10.2448 39.2362 8.71147 39.2484 7.12974C39.2299 5.22751 38.4593 3.40993 37.1049 2.07405C35.7506 0.738157 33.9226 -0.00746514 32.0203 5.63571e-05Z" fill="white" />
                                </svg>
                            </span>
                            <div class="card-body pt-3 px-0">
                                @if(is_null($payroll_tax))
                                <h5 class="card-title pt-2  ">Payroll Tax and Contribution</h5>
                                <p class="card-text pt-3 ">Manage and view payroll summaries, trends, comparisons, employee breakdowns and tax
                                    compliance reports at a click.</p>
                                @else
                                <h5 class="card-title pt-2 ">{{ $payroll_tax->cms_type}}</h5>
                                <p class="card-text pt-3 ">{{ $payroll_tax->content}}</p>
                                @endif
                            </div>


                        </div>
                    </div>

                    <div class="col-md-4 mb-md-4 mb-3 d-flex">
                        <div class="card-about card5   pb-3">
                            <span class="icon-back  " class="px-2 py-2">
                                <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.5555 15.3333H8.66663M8.66663 8.66667H15.3333M35.3333 35.3333L25.3333 28.6667L19.7777 33.1111L8.66663 24.2222M29.7777 19.7778C28.3043 19.7778 26.8912 19.1925 25.8494 18.1506C24.8075 17.1087 24.2222 15.6957 24.2222 14.2222C24.2222 12.7488 24.8075 11.3357 25.8494 10.2939C26.8912 9.25199 28.3043 8.66667 29.7777 8.66667C31.2512 8.66667 32.6642 9.25199 33.7061 10.2939C34.748 11.3357 35.3333 12.7488 35.3333 14.2222C35.3333 15.6957 34.748 17.1087 33.7061 18.1506C32.6642 19.1925 31.2512 19.7778 29.7777 19.7778Z" stroke="white" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M2 40.6667V3.33333C2 2.97971 2.14048 2.64057 2.39052 2.39052C2.64057 2.14048 2.97971 2 3.33333 2H40.6667C41.0203 2 41.3594 2.14048 41.6095 2.39052C41.8595 2.64057 42 2.97971 42 3.33333V40.6667C42 41.0203 41.8595 41.3594 41.6095 41.6095C41.3594 41.8595 41.0203 42 40.6667 42H3.33333C2.97971 42 2.64057 41.8595 2.39052 41.6095C2.14048 41.3594 2 41.0203 2 40.6667Z" stroke="white" stroke-width="3.5" />
                                </svg>
                            </span>
                            <div class="card-body pt-3 px-0">
                                @if(is_null($analytics_report))
                                <h5 class="card-title pt-2  ">Analytics and Report</h5>
                                <p class="card-text pt-3 ">Manage and view payroll summaries, trends, comparisons, employee breakdowns and tax
                                    compliance reports at a click.</p>
                                @else
                                <h5 class="card-title pt-2 ">{{ $analytics_report->cms_type}}</h5>
                                <p class="card-text pt-3 ">{{ $analytics_report->content}}</p>
                                @endif
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4 mb-md-4 mb-3 d-flex">
                        <div class="card-about card6  pb-3">
                            <span class="icon-back  " class="px-2 py-2">
                                <svg width="45" height="51" viewBox="0 0 45 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.2613 44.1262L16.455 46.7775C6.07125 45.8587 0 38.775 0 31.875V30C0 28.5082 0.592632 27.0774 1.64752 26.0225C2.70242 24.9676 4.13316 24.375 5.625 24.375H22.65C21.1875 25.4062 19.9012 26.6737 18.855 28.125H5.625C5.12772 28.125 4.65081 28.3225 4.29918 28.6742C3.94754 29.0258 3.75 29.5027 3.75 30V31.875C3.75 36.8925 8.40375 42.3187 16.815 43.0425C16.95 43.41 17.1 43.77 17.2613 44.1262ZM18.75 0C21.485 0 24.1081 1.08649 26.042 3.02046C27.976 4.95443 29.0625 7.57745 29.0625 10.3125C29.0625 13.0475 27.976 15.6706 26.042 17.6045C24.1081 19.5385 21.485 20.625 18.75 20.625C16.015 20.625 13.3919 19.5385 11.458 17.6045C9.52399 15.6706 8.4375 13.0475 8.4375 10.3125C8.4375 7.57745 9.52399 4.95443 11.458 3.02046C13.3919 1.08649 16.015 0 18.75 0ZM18.75 3.75C17.0095 3.75 15.3403 4.4414 14.1096 5.67211C12.8789 6.90282 12.1875 8.57202 12.1875 10.3125C12.1875 12.053 12.8789 13.7222 14.1096 14.9529C15.3403 16.1836 17.0095 16.875 18.75 16.875C20.4905 16.875 22.1597 16.1836 23.3904 14.9529C24.6211 13.7222 25.3125 12.053 25.3125 10.3125C25.3125 8.57202 24.6211 6.90282 23.3904 5.67211C22.1597 4.4414 20.4905 3.75 18.75 3.75ZM45 37.5C45.0006 39.7849 44.4047 42.0303 43.2713 44.0142C42.1379 45.9981 40.5062 47.6518 38.5376 48.8116C36.569 49.9715 34.3318 50.5974 32.0471 50.6273C29.7625 50.6573 27.5096 50.0903 25.5113 48.9825L20.2913 50.5687C20.0844 50.6319 19.8642 50.6376 19.6543 50.5852C19.4444 50.5329 19.2528 50.4244 19.0998 50.2715C18.9468 50.1185 18.8384 49.9268 18.786 49.7169C18.7336 49.5071 18.7393 49.2869 18.8025 49.08L20.3925 43.8637C19.4223 42.1114 18.866 40.1602 18.7663 38.1597C18.6666 36.1592 19.026 34.1624 19.8172 32.3222C20.6083 30.4821 21.8101 28.8474 23.3305 27.5434C24.8509 26.2395 26.6496 25.3008 28.5889 24.7993C30.5281 24.2978 32.5563 24.2468 34.5183 24.6502C36.4803 25.0536 38.3239 25.9007 39.9079 27.1266C41.492 28.3525 42.7744 29.9247 43.657 31.7227C44.5397 33.5208 44.999 35.497 45 37.5ZM28.125 31.875C27.6277 31.875 27.1508 32.0725 26.7992 32.4242C26.4475 32.7758 26.25 33.2527 26.25 33.75C26.25 34.2473 26.4475 34.7242 26.7992 35.0758C27.1508 35.4275 27.6277 35.625 28.125 35.625H35.625C36.1223 35.625 36.5992 35.4275 36.9508 35.0758C37.3025 34.7242 37.5 34.2473 37.5 33.75C37.5 33.2527 37.3025 32.7758 36.9508 32.4242C36.5992 32.0725 36.1223 31.875 35.625 31.875H28.125ZM26.25 41.25C26.25 41.7473 26.4475 42.2242 26.7992 42.5758C27.1508 42.9275 27.6277 43.125 28.125 43.125H31.875C32.3723 43.125 32.8492 42.9275 33.2008 42.5758C33.5525 42.2242 33.75 41.7473 33.75 41.25C33.75 40.7527 33.5525 40.2758 33.2008 39.9242C32.8492 39.5725 32.3723 39.375 31.875 39.375H28.125C27.6277 39.375 27.1508 39.5725 26.7992 39.9242C26.4475 40.2758 26.25 40.7527 26.25 41.25Z" fill="white" />
                                </svg>
                            </span>
                            <div class="card-body pt-3 px-0">
                                @if(is_null($chat))
                                <h5 class="card-title pt-2 ">Chat</h5>
                                <p class="card-text pt-3 ">Create chat groups by company, business, branch, department or custom and chat with employees in
                                    the relevant groups.</p>
                                @else
                                <h5 class="card-title pt-2 ">{{ $chat->cms_type}}</h5>
                                <p class="card-text pt-3 ">{{ $chat->content}}</p>

                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center my-3">
                    <a class="btn btn-typ4 btn-typ-3d flex-column px-3" href="{{ route('employer.register') }}"><strong>Register Now - Pay Later</strong> <span  class="small">Onboard Employees and Start Processing Payroll</span></a>
                </div>
                <button class="fixed-btn btn-typ2-3d">
                    <span class="small">Up to 9 <br> employees</span>
                    <strong>Pay $39 only</strong>
                    <span class="small">For all features!</span>
                </button>
            </div>
        </div>
    </section>

    <section class="forEmployees-section" id="ForEmployees">
        <div class="container">
            <div class="about-title pt-5 text-center">
                @if(is_null($foremployees))
                <h3>For Employees</h3>
                <p>As an employee, the Paytym
                    app lets you check-in and
                    check-out directly from the
                    mobile app, have access to
                    your pay slips, salary and time
                    worked. You can chat within
                    the groups created by your
                    superiors, view your shift
                    roster, scheduled meetings
                    and employment benefits.
                    You can also update your
                    profile and payment
                    accounts, request leaves and
                    time off, view attendance and
                    work history and receive
                    documents and notifications.
                </p>
                @else
                <h3>{{$foremployees->cms_type}}</h3>
                <p>{{$foremployees->content}}</p>
                @endif

            </div>
            <div class="row pt-3 align-items-stretch">
                <div class="col-lg-6 col-12" data-aos="zoom-in-down" data-aos-duration="2000">
                    <div class="text-content">
                        <h3>Employee App Features</h3>
                        <!-- <p class="black-txt fs-14"> Lorem Ipsum is simply dummy text of the printing us. disciplined rid so rational muff the
                            project.</p> -->
                    </div>
                    <!-- <ul class="row ml-4 mt-md-5 mt-4 list-style-custom-dash">
                        <li class="col-12 mb-3">
                            View Pay Slips
                        </li>
                        <li class="col-12 mb-3">
                            Requests Leaves and Time Off
                        </li>
                        <li class="col-12 mb-3">
                            Update Personal Information
                        </li>
                        <li class="col-12 mb-3">
                            View Benefits
                        </li>
                        <li class="col-12 mb-3">
                            Set up Direct Deposit Accounts
                        </li>
                        <li class="col-12 mb-3">
                            View Scheduled Meetings and Shift
                        </li>
                        <li class="col-12 mb-3">
                            Chat with Superiors and Designated Groups
                        </li>
                    </ul> -->
                    <ul class="row about-table">
                        <li class="col-md-6 col-12 mb-md-5 mb-3">
                       
                            <div class="d-flex">
                            @if(is_null($payslips))
                                <div class="about-icons"><img src="{{asset('home_assets/images/about-icons/Group 1.png')}}" alt="" srcset="">
                                </div>
                                <div class="text-table">
                               
                                    <strong class="d-block mb-2 black-txt">Pay Slips</strong>
                                    <p class="grey-txt">view and download payslips for each pay.</p>
                                                                     
                                </div> 
                                @else
                                @if(is_null($payslips->img))
                                <div class="about-icons"><img src="{{asset('home_assets/images/about-icons/Group 1.png')}}" alt="" srcset="">
                                </div>
                                @else
                                <div class="about-icons"><img src="{{asset('uploads/cms/'.$payslips->img)}}" alt="" srcset="">
                                </div>
                                @endif
                              
                                <div class="text-table">
                               
                                    <strong class="d-block mb-2 black-txt">{{$payslips->cms_type}}</strong>
                                    <p class="grey-txt">{{$payslips->content}}</p>
                            </div>
                            @endif
                            </div>
                           
                        </li>
                        <li class="col-md-6 col-12 mb-md-5 mb-3">
                            <div class="d-flex">
                            @if(is_null($leaves))
                                <div class="about-icons"><img src="{{asset('home_assets/images/about-icons/Group 2.png')}}" alt="" srcset="">
                                </div>
                                <div class="text-table">
                                    <strong class="d-block mb-2 black-txt">Leaves and Time Off</strong>
                                    <p class="grey-txt">apply for leaves and view approvals.</p>
                                </div>
                                @else
                                @if(is_null($leaves->img))
                                <div class="about-icons"><img src="{{asset('home_assets/images/about-icons/Group 2.png')}}" alt="" srcset="">
                                </div>
                                @else
                                <div class="about-icons"><img src="{{asset('uploads/cms/'.$leaves->img)}}" alt="" srcset="">
                                </div>
                                @endif
                               
                                <div class="text-table">
                               
                                    <strong class="d-block mb-2 black-txt">{{$leaves->cms_type}}</strong>
                                    <p class="grey-txt">{{$leaves->content}}</p>
                            </div>
                            @endif
                            </div>
                        </li>
                        <li class="col-md-6 col-12 mb-md-5 mb-3">
                            <div class="d-flex">
                                @if(is_null($personalprofile))
                                <div class="about-icons"><img src="{{asset('home_assets/images/about-icons/Group 3.png')}}" alt="" srcset="">
                                </div>
                                <div class="text-table">
                                    <strong class="d-block mb-2 black-txt">Personal Profile</strong>
                                    <p class="grey-txt">update your personal profile at any time.</p>
                                </div>
                                @else
                                @if(is_null($personalprofile->img))
                                <div class="about-icons"><img src="{{asset('home_assets/images/about-icons/Group 3.png')}}" alt="" srcset="">
                                </div>
                                @else
                                <div class="about-icons"><img src="{{asset('uploads/cms/'.$personalprofile->img)}}" alt="" srcset="">
                                </div>
                                @endif
                                <div class="text-table">
                               
                                    <strong class="d-block mb-2 black-txt">{{$personalprofile->cms_type}}</strong>
                                    <p class="grey-txt">{{$personalprofile->content}}</p>
                            </div>
                            @endif
                            </div>
                        </li>
                        <li class="col-md-6 col-12 mb-md-5 mb-3">
                            <div class="d-flex">
                            @if(is_null($depositaccounts))
                                <div class="about-icons"><img src="{{asset('home_assets/images/about-icons/Group 4.png')}}" alt="" srcset="">
                                </div>
                                <div class="text-table">
                                    <strong class="d-block mb-2 black-txt">Deposit Accounts</strong>
                                    <p class="grey-txt">update your payment accounts at any time.</p>
                                </div>
                                @else
                                @if(is_null($depositaccounts->img))
                                <div class="about-icons"><img src="{{asset('home_assets/images/about-icons/Group 4.png')}}" alt="" srcset="">
                                </div>
                                @else
                                <div class="about-icons"><img src="{{asset('uploads/cms/'.$depositaccounts->img)}}" alt="" srcset="">
                                </div>
                                @endif
                               
                                <div class="text-table">
                               
                                    <strong class="d-block mb-2 black-txt">{{$depositaccounts->cms_type}}</strong>
                                    <p class="grey-txt">{{$depositaccounts->content}}</p>
                            </div>
                            @endif
                            </div>
                        </li>
                        <li class="col-md-6 col-12 mb-md-5 mb-3">
                            <div class="d-flex">
                            @if(is_null($shiftroster))
                                <div class="about-icons"><img src="{{asset('home_assets/images/about-icons/Group 4.png')}}" alt="" srcset="">
                                </div>
                                <div class="text-table">
                                    <strong class="d-block mb-2 black-txt">Shift Roster</strong>
                                    <p class="grey-txt">view shifts and scheduled meetings.</p>
                                </div>
                                @else
                                @if(is_null($shiftroster->img))
                                <div class="about-icons"><img src="{{asset('home_assets/images/about-icons/Group 4.png')}}" alt="" srcset="">
                                </div>
                                @else
                                <div class="about-icons"><img src="{{asset('uploads/cms/'.$shiftroster->img)}}" alt="" srcset="">
                                </div>
                                @endif
                                
                                <div class="text-table">
                               
                                    <strong class="d-block mb-2 black-txt">{{$shiftroster->cms_type}}</strong>
                                    <p class="grey-txt">{{$shiftroster->content}}</p>
                            </div>
                            @endif
                            </div>
                        </li>
                        <li class="col-md-6 col-12 mb-md-5 mb-0">
                            <div class="d-flex">
                            @if(is_null($appchat))
                                <div class="about-icons"><img src="{{asset('home_assets/images/about-icons/Group 4.png')}}" alt="" srcset="">
                                </div>
                                <div class="text-table">
                                    <strong class="d-block mb-2 black-txt">Chat</strong>
                                    <p class="grey-txt">conveniently chat within designated groups.</p>
                                </div>
                                @else
                                @if(is_null($appchat->img))
                                <div class="about-icons"><img src="{{asset('home_assets/images/about-icons/Group 4.png')}}" alt="" srcset="">
                                </div>
                                @else
                                <div class="about-icons"><img src="{{asset('uploads/cms/'.$appchat->img)}}" alt="" srcset="">
                                </div>
                                @endif
                               
                                <div class="text-table">
                               
                                    <strong class="d-block mb-2 black-txt">{{$appchat->cms_type}}</strong>
                                    <p class="grey-txt">{{$appchat->content}}</p>
                            </div>
                            @endif
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <div class="img-right " data-aos="fade-down" data-aos-duration="2000">
                        <img src="{{asset('home_assets/images/Group 48.png')}}" alt="" srcset="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- showcase-section -->
    <section class="showcase-section mt-4">
        <div class="container">
            <div class="show-title pt-5 text-center">
                @if(is_null($showcase))
                <h3>Showcase</h3>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when
                    looking at its layout.</p>
                @else
                <h3>{{$showcase->cms_type}}</h3>
                <p>{{$showcase->content}}</p>
                @endif
            </div>
            <div class="row" data-aos="fade-down" data-aos-duration="2000">
                <div class="col-md-2 pt-2">
                    <img src="{{asset('home_assets/images/showcase/showcase-img1.jpg')}}" alt="" srcset="">
                </div>
                <div class="col-md-2 pt-2 ">
                    <img src="{{asset('home_assets/images/showcase/showcase-img2.jpg')}}" alt="" srcset="">
                </div>
                <div class="col-md-2 pt-2">
                    <img src="{{asset('home_assets/images/showcase/showcase-img3.jpg')}}" alt="" srcset="">
                </div>
                <div class="col-md-2 pt-2">
                    <img src="{{asset('home_assets/images/showcase/showcase-img4.jpg')}}" alt="" srcset="">
                </div>
                <div class="col-md-2 pt-2">
                    <img src="{{asset('home_assets/images/showcase/showcase-img5.jpg')}}" alt="" srcset="">
                </div>
                <div class="col-md-2 pt-2">
                    <img src="{{asset('home_assets/images/showcase/showcase-img6.jpg')}}" alt="" srcset="">
                </div>
            </div>
        </div>
    </section>

    <section class="downloadApp-section" id="downloadApp">
        <div class="container">
            <div class="about-title pt-5 text-center">
                <h3>Download App</h3>
            </div>
            <div class="row align-items-center justify-content-center mt-md-4 mt-3" data-aos="fade-down" data-aos-duration="2000">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6 pt-2">
                            <div class="d-flex align-items-center justify-content-center justify-content-md-end">
                                <a href="https://drive.google.com/file/d/1ajueOBPr2k2tohOKSS_J8DldqQxiQSTM/view">
                                    <img src="{{asset('home_assets/images/footer/1 1.png')}}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 pt-2 ">
                            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                <a href="" onclick="alert('Under construction');return false;">
                                    <img src="{{asset('home_assets/images/footer/2 1.png')}}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- howwork-section -->
    <!-- howwork-section -->
    <section class="howwork-section" id="HowItWork">
        <div class="container about-title pt-5 text-center">
            @if(is_null($howitworks))
            <h3 class="light-blue-text">Registration Process</h3>
            <p>Simply register your business and start on-boarding and managing your employees while automating your Payroll.</p>
            @else
            <h3 class="light-blue-text">{{$howitworks->cms_type}}</h3>
            <p>{{$howitworks->content}}</p>
            @endif

        </div>
        <div class="container" data-aos="zoom-in" data-aos-duration="2000">
            <div class="row justify-content-center">
                <div class="col-md-4 col-sm-6">
                    <div class="card-work text-center">
                        <div class="work-img-wrp">
                            <img src="{{asset('home_assets/images/svg/1.svg')}}" alt="">
                        </div>
                        <div class="title-wrp">
                            Employer visits
                            <strong>Website and Registers</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="card-work text-center">
                        <div class="work-img-wrp">
                            <img src="{{asset('home_assets/images/svg/2.svg')}}" alt="">
                        </div>
                        <div class="title-wrp">
                            Employer on-boards
                            <strong>Employees</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 line-right">
                    <div class="card-work text-center">
                        <div class="work-img-wrp">
                            <img src="{{asset('home_assets/images/svg/3.svg')}}" alt="">
                        </div>
                        <div class="title-wrp">
                            Login details shared with
                            <strong>Employees</strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <hr class="dashed-border col-md-12 pl-0 pr-0">
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4 col-sm-6 line-left">
                    <div class="card-work text-center">
                        <div class="work-img-wrp">
                            <img src="{{asset('home_assets/images/svg/4.svg')}}" alt="">
                        </div>
                        <div class="title-wrp">
                            Employee downloads
                            <strong>Paytym Mobile App</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="card-work text-center">
                        <div class="work-img-wrp">
                            <img src="{{asset('home_assets/images/svg/5.svg')}}" alt="">
                        </div>
                        <div class="title-wrp">
                            Employee
                            <strong>Signs In</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="card-work text-center">
                        <div class="work-img-wrp">
                            <img src="{{asset('home_assets/images/svg/6.svg')}}" alt="">
                        </div>
                        <div class="title-wrp">
                            Paytym syncs
                            <strong>Employer & Employee</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="reg-now-section text-center py-5 mt-5">
        <div class="container">
            <h4 class="fw-600 mb-3">Why Paytym should be your preferred HR and Payroll Platform?</h4>
            <div class="fw-600 h5 mb-4">Get started for free and find out for yourself.</div>
            <a href="{{ route('employer.register') }}" class="d-inline-flex btn-typ3 btn-typ2-3d fw-600 px-3 py-1 ml-0 mr-auto mb-2">Register Now - Pay later</a>
            <p class="small mb-0">(No credit card details required at sign up)</p>
        </div>
    </section>
   
    <!-- pricing-plan section -->
    <section class="pricing-plan" id="pricing">
        <div class="container about-title pt-5 text-center">

            @if(is_null($pricing))
            <h3>Pricing</h3>
            <p>Start streamlining your Payroll
                processes and simplifying your HR
                management now!
            </p>
            @else
            <h3>{{$pricing->cms_type}}</h3>
            <p>{{$pricing->content}}</p>
            @endif
        </div>
        <div class="container" data-aos="fade-up" data-aos-duration="2000">
            <div class="form-row justify-content-center pt-2" style="width:auto">
                @foreach ($subscription as $sub)
                @if($sub->plan == 'MICRO')
                <div class="col">
                    <div class="card-price-blue white-bg rounded border mt-3">
                        <div class="p-lg-4 p-3">
                            <h3 class="text-center fw-600">{{ $sub->plan }}</h3>
                            <hr>
                            <h4 class="text-center d-flex flex-column align-items-center">
                                <strong>$<span>{{ $sub->rate_per_month }} </span></strong>
                                <span class="small-text">Per Month</span>
                            </h4>
                            <hr>
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center justify-content-center mb-md-4 mb-1">
                                    <strong> Up to {{ $sub->range_to }}</strong>
                                    <span>employees</span>
                                    <!--  <span>Free</span> -->
                                    <span>${{ $sub->rate_per_employee }}/employee</span>
                                </div>
                                <!-- <div class="btn-started text-center">
                                    <button class="btn" type="button" onclick="window.location='{{ route('paytym.home.subplan', $sub->id) }}'">Get Started </button>


                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                @elseif($sub->plan == 'MEGA')
                <div class="col">
                    <div class="card-price-blue white-bg rounded border mt-3">
                        <div class="p-lg-4 p-3">
                            <h3 class="text-center fw-600">{{ $sub->plan }}</h3>
                            <hr>
                            <h4 class="text-center d-flex flex-column align-items-center">
                                <strong>$<span>{{ $sub->rate_per_month }} </span></strong>
                                <span class="small-text">Per Month</span>
                            </h4>
                            <hr>
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center justify-content-center mb-md-4 mb-1">
                                    <strong>{{ $sub->range_from }} +</strong>
                                    <span>employees</span>
                                    <!--  <span>Free</span> -->
                                    <span>${{ $sub->rate_per_employee }}/employee</span>
                                </div>
                                <!-- <div class="btn-started text-center">
                                    <button class="btn" type="button" onclick="window.location='{{ route('paytym.home.subplan', $sub->id) }}'">Get Started </button>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="col">
                    <div class="card-price-blue white-bg rounded border mt-3">
                        <div class="p-lg-4 p-3">
                            <h3 class="text-center fw-600">{{ $sub->plan }}</h3>
                            <hr>
                            <h4 class="text-center d-flex flex-column align-items-center">
                                <strong>$<span>{{ $sub->rate_per_month }} </span></strong>
                                <span class="small-text">Per Month</span>
                            </h4>
                            <hr>
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center justify-content-center mb-md-4 mb-1">
                                    <strong>{{ $sub->range_from }} to {{ $sub->range_to }}</strong>
                                    <span>employees</span>
                                    <!--  <span>Free</span> -->
                                    <span>${{ $sub->rate_per_employee }}/employee</span>
                                </div>
                                <!-- <div class="btn-started text-center">
                                    <button class="btn" type="button" onclick="window.location='{{ route('paytym.home.subplan', $sub->id) }}'">Get Started </button>

                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                <!--  <div class="col">
                <div class="card-price-blue white-bg rounded border mt-3">
                    <div class="p-lg-4 p-3" >
                        <h3 class="text-center fw-600">Micro</h3>
                        <hr> 
                        <h4 class="text-center d-flex flex-column align-items-center">
                            <strong>$<span>19 </span></strong>
                            <span class="small-text">Per Month</span>
                        </h4>
                        <hr>
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center justify-content-center mb-md-4 mb-1">
                                <strong>Up to 5</strong>
                                <span>employees</span>
                                <span>Free</span>
                            </div>
                            <div class="btn-started text-center">
                                <button class="btn" type="button">
                                    Get Started
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card-price-pink white-bg rounded border mt-3">
                    <div class="p-lg-4 p-3" >
                        <h3 class="text-center fw-600">Small</h3>
                        <hr>
                        <h4 class="text-center d-flex flex-column align-items-center">
                            <strong>$<span>39 </span></strong>
                            <span class="small-text">Per Month</span>
                        </h4> 
                        <hr>
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center justify-content-center mb-md-4 mb-1">
                                <strong>6 to 40</strong>
                                <span>employees</span>
                                <span>$6.00/employee</span>
                            </div>
                            <div class="btn-started text-center">
                                <button class="btn" type="button">
                                    Get Started
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card-price-light-yellow white-bg rounded border mt-3" >
                    <div class="p-lg-4 p-3" >
                        <h3 class="text-center fw-600">Medium</h3>
                        <hr>
                        <h4 class="text-center d-flex flex-column align-items-center">
                            <strong>$<span>59 </span></strong>
                            <span class="small-text">Per Month</span>
                        </h4>
                        <hr>
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center justify-content-center mb-md-4 mb-1">
                                <strong>41 to 100</strong>
                                <span>employees</span>
                                <span>$5.00/employee</span>
                            </div>
                            <div class="btn-started text-center">
                                <button class="btn" type="button">
                                    Get Started
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card-price-light-peach white-bg rounded border mt-3" >
                    <div class="p-lg-4 p-3" >
                        <h3 class="text-center fw-600">Enterprise</h3>
                        <hr>
                        <h4 class="text-center d-flex flex-column align-items-center">
                            <strong>$<span>99 </span></strong>
                            <span class="small-text">Per Month</span>
                        </h4> 
                        <hr>
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center justify-content-center mb-md-4 mb-1">
                                <strong>101 to 200</strong>
                                <span>employees</span>
                                <span>$4.00/employee</span>
                            </div>
                            <div class="btn-started text-center">
                                <button class="btn">
                                    Get Started
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card-price-light-blue white-bg rounded border mt-3" >
                    <div class="p-lg-4 p-3" >
                        <h3 class="text-center fw-600">Mega</h3>
                        <hr>
                        <h4 class="text-center d-flex flex-column align-items-center">
                            <strong>$<span>149 </span></strong>
                            <span class="small-text">Per Month</span>
                        </h4> 
                        <hr>
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center justify-content-center mb-md-4 mb-1">
                                <strong>201+</strong>
                                <span>employees</span>
                                <span>$3.00/employee</span>
                            </div>
                            <div class="btn-started text-center">
                                <button class="btn">
                                    Get Started
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 -->
            </div>
            <div class="d-flex justify-content-center my-3">
                <a class="btn btn-typ4 btn-typ-3d flex-column px-3" href="{{ route('employer.register') }}"><strong>Register Now - Pay Later</strong> <span  class="small">Onboard Employees and Start Processing Payroll</span></a>
            </div>
        </div>
    </section>
 <!-- testimonial-section -->
 @if($testimonial->count()!=0)
    <section class="testimonial-section" id="testimonial">
        <div class="container about-title pt-5 text-center">
            <h3 class="light-blue-text">Testimonials</h3>
            <p>We do not brag but what others say about us can help you in understanding our ability and ethics well.
            </p>
        </div>
        <div class="container" data-aos="fade-down" data-aos-duration="2000">

            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="owl-carousel testimonial-carousel owl-theme owl-loaded">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                               {{-- @if(is_null($testimonial))
                                <div class="owl-item">
                                    <div class="test-item row">
                                        <div class="col-md-3">
                                            <img src="{{asset('home_assets/images/profile-image/1.jpg')}}" alt="">
                                        </div>
                                        <div class="test-info col-md-9">
                                            <div class="txt-cntnt">
                                                “ Most Dedicated!! These guys are very Dedicated and creative
                                                you have expected, We will happy after Working with Them”
                                            </div>
                                            <strong>Selvedin Durak</strong>
                                            <span>Datahub</span>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="owl-item">
                                    <div class="test-item row">
                                        <div class="col-md-3">
                                            <img src="{{asset('home_assets/images/profile-image/3.jpg')}}" alt="">
                                        </div>
                                        <div class="test-info col-md-9">
                                            <div class="txt-cntnt">
                                                “ Most Dedicated!! These guys are very Dedicated and creative
                                                you have expected, We will happy after Working with Them”
                                            </div>
                                            <strong>Selvedin Durak</strong>
                                            <span>Datahub</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-item">
                                    <div class="test-item row">
                                        <div class="col-md-3">
                                            <img src="{{asset('home_assets/images/profile-image/4.jpg')}}" alt="">
                                        </div>
                                        <div class="test-info col-md-9">
                                            <div class="txt-cntnt">
                                                “ Most Dedicated!! These guys are very Dedicated and creative
                                                you have expected, We will happy after Working with Them”
                                            </div>
                                            <strong>Selvedin Durak</strong>
                                            <span>Datahub</span>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="owl-item">
                                    <div class="test-item row">
                                        <div class="col-md-3">
                                            <img src="{{asset('home_assets/images/profile-image/6.jpg')}}" alt="">
                                        </div>
                                        <div class="test-info col-md-9">
                                            <div class="txt-cntnt">
                                                “ Most Dedicated!! These guys are very Dedicated and creative
                                                you have expected, We will happy after Working with Them”
                                            </div>
                                            <strong>Selvedin Durak</strong>
                                            <span>Datahub</span>
                                        </div>
                                    </div>
                                </div>
                                @else--}}
                                @foreach ($testimonial as $testimonials)
                                <div class="owl-item">
                                    <div class="test-item row">
                                        <div class="col-md-3">
                                            <img src="{{asset('uploads/cms/'.$testimonials->img)}}" alt="">
                                        </div>
                                        <div class="test-info col-md-9">
                                            <div class="txt-cntnt">
                                                {{$testimonials->content}}
                                            </div>
                                            <strong>{{$testimonials->content1}}</strong>
                                            <span>{{$testimonials->content2}}</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                {{--@endif--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

<section id="why-paytym" class="pb-5">
        <div class="container about-title pt-5 text-center">
            <div class="border pt-5 px-lg-0 px-sm-3 px-0">
                <h3>Why Choose Paytym’s Cloud-based Software?</h3>
                <div class="row px-lg-5 px-md-4">

                    <div class="col-md-6">
                        @if(is_null($improvespeed))
                        <div class="p-3">
                            <div class="d-flex align-items-center mb-2">
                                <img src="{{asset('home_assets/images/why-paytym-icons/icon1.png')}}" class="img-fluid" alt="">
                                <h6 class="ml-3 mb-0 text-left fw-600">
                                    Improve Speed and <br>
                                    Accuracy
                                </h6>
                            </div>
                            <p>
                                Discover the efficiency of Paytym’s cloud-basedpayroll services. With a user-friendly interface andautomation, these services eliminate manualcalculations, errors, and workarounds. Ensure youremployees are paid accurately and on time, withoutthe pre-payroll rush. Upgrade from older on-premisepayroll software to a streamlinedcloud solution today.
                            </p>
                        </div>
                        @else
                        <div class="p-3">
                            <div class="d-flex align-items-center mb-2">
                                @if(is_null($improvespeed->img))
                                <img src="{{asset('home_assets/images/why-paytym-icons/icon1.png')}}" class="img-fluid" alt="">
                                @else
                                <img src="{{asset('uploads/cms/'.$improvespeed->img)}}" class="img-fluid" alt="">
                                @endif
                                <h6 class="ml-3 mb-0 text-left fw-600">
                                {{$improvespeed->cms_type}}
                                </h6>
                            </div>
                            <p>
                                {{$improvespeed->content}}
                            </p>
                        </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                    @if(is_null($offermobileaccess))
                        <div class="p-3">
                            <div class="d-flex align-items-center mb-2">
                                <img src="{{asset('home_assets/images/why-paytym-icons/icon2.png')}}" class="img-fluid" alt="">
                                <h6 class="ml-3 mb-0 text-left fw-600">
                                    Offer Mobile <br>
                                    Accessibility
                                </h6>
                            </div>
                            <p>
                                Embrace the freedom of Paytym’s cloud-based payroll services. Process and approve payroll from any device, anywhere, even outside the office. It is ideal even for businesses with multiple worksites across different time zones. Field managers can easily review attendance, approve leaves, and stay connected via smartphones or tablets. Embrace the future of remote payroll management with Paytym.
                            </p>
                        </div>
                        @else
                        <div class="p-3">
                            <div class="d-flex align-items-center mb-2">
                                @if(is_null($offermobileaccess->img))
                                <img src="{{asset('home_assets/images/why-paytym-icons/icon2.png')}}" class="img-fluid" alt="">
                                @else
                                <img src="{{asset('uploads/cms/'.$offermobileaccess->img)}}" class="img-fluid" alt="">
                                @endif
                                <h6 class="ml-3 mb-0 text-left fw-600">
                                {{$offermobileaccess->cms_type}}
                                </h6>
                            </div>
                            <p>
                                {{$offermobileaccess->content}}
                            </p>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                    @if(is_null($protectdata))
                        <div class="p-3">
                            <div class="d-flex align-items-center mb-2">
                                <img src="{{asset('home_assets/images/why-paytym-icons/icon3.png')}}" class="img-fluid" alt="">
                                <h6 class="ml-3 mb-0 text-left fw-600">
                                    Protect Your <br>
                                    Data
                                </h6>
                            </div>
                            <p>
                                Paytym’s cloud-based payroll is a secure choice for
                                safeguarding sensitive data compared to on-premise
                                systems. Paytym has invested heavily in data and
                                infrastructure security, including encryption and
                                rigorous backups. We use reliable private cloud
                                hosting, high server uptime, and top-tier certified data
                                centres with 24/7 security monitoring. Your data is
                                safe with Paytym.
                            </p>
                        </div>
                        @else
                        <div class="p-3">
                            <div class="d-flex align-items-center mb-2">
                                @if(is_null($protectdata->img))
                                <img src="{{asset('home_assets/images/why-paytym-icons/icon3.png')}}" class="img-fluid" alt="">
                                @else
                                <img src="{{asset('uploads/cms/'.$protectdata->img)}}" class="img-fluid" alt="">
                                @endif
                                <h6 class="ml-3 mb-0 text-left fw-600">
                                {{$protectdata->cms_type}}
                                </h6>
                            </div>
                            <p>
                                {{$protectdata->content}}
                            </p>
                        </div>
                        @endif

                    </div>
                    <div class="col-md-6">
                    @if(is_null($easilyscalebusiness))
                        <div class="p-3">
                            <div class="d-flex align-items-center mb-2">
                                <img src="{{asset('home_assets/images/why-paytym-icons/icon4.png') }}" class="img-fluid" alt="">
                                <h6 class="ml-3 mb-0 text-left fw-600">
                                    Easily Scale Your <br>
                                    Business
                                </h6>
                            </div>
                            <p>
                                Embrace Paytym's scalable cloud payroll platform,
                                perfect for seasonal or growing workforces. No more
                                worries about capacity limits or overpaying. With
                                Paytym, you only pay based on the number of active
                                employees in each billing period, ensuring cost
                                efficiency. Let us handle the infrastructure for you.
                            </p>
                        </div>
                        @else
                        <div class="p-3">
                            <div class="d-flex align-items-center mb-2">
                                @if(is_null($easilyscalebusiness->img))
                                <img src="{{asset('home_assets/images/why-paytym-icons/icon4.png')}}" class="img-fluid" alt="">
                                @else
                                <img src="{{asset('uploads/cms/'.$easilyscalebusiness->img)}}" class="img-fluid" alt="">
                                @endif
                                <h6 class="ml-3 mb-0 text-left fw-600">
                                {{$easilyscalebusiness->cms_type}}
                                </h6>
                            </div>
                            <p>
                                {{$easilyscalebusiness->content}}
                            </p>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                    @if(is_null($offeremployeeservice))
                        <div class="p-3">
                            <div class="d-flex align-items-center mb-2">
                                <img src="{{asset('home_assets/images/why-paytym-icons/icon5.png')}}" class="img-fluid" alt="">
                                <h6 class="ml-3 mb-0 text-left fw-600">
                                    Offer Employee Self-Service <br>
                                    Portals
                                </h6>
                            </div>
                            <p>
                                Empower your workforce with Paytym’s mobile app
                                and employee self-service! Access HR and payroll info
                                anytime, anywhere, right from personal devices.
                                Employees can view attendance, manage leaves and
                                documents, download pay slips, chat with
                                management and much more, freeing up HR and
                                managers for more essential tasks. Boost efficiency
                                and satisfaction now!
                            </p>
                        </div>
                        @else
                        <div class="p-3">
                            <div class="d-flex align-items-center mb-2">
                                @if(is_null($offeremployeeservice->img))
                                <img src="{{asset('home_assets/images/why-paytym-icons/icon5.png')}}" class="img-fluid" alt="">
                                @else
                                <img src="{{asset('uploads/cms/'.$offeremployeeservice->img)}}" class="img-fluid" alt="">
                                @endif
                                <h6 class="ml-3 mb-0 text-left fw-600">
                                {{$offeremployeeservice->cms_type}}
                                </h6>
                            </div>
                            <p>
                                {{$offeremployeeservice->content}}
                            </p>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                    @if(is_null($reducecost))
                        <div class="p-3">
                            <div class="d-flex align-items-center mb-2">
                                <img src="{{asset('home_assets/images/why-paytym-icons/icon6.png')}}" class="img-fluid" alt="">
                                <h6 class="ml-3 mb-0 text-left fw-600">
                                    Reduce Ownership <br>
                                    Costs
                                </h6>
                            </div>
                            <p>
                                Opt for Paytym’s cloud-based Software-as-a-Service
                                (SaaS) solution for a superior return on investment.
                                With no need for in-house servers, physical set-up, or
                                upgrade purchases, employers save on initial and
                                recurring expenses. Updates are seamlessly handled
                                by Paytym, eliminating downtime. Experience cost
                                savings and effortless software management with the
                                Paytym cloud-based SaaS solution.
                            </p>
                        </div>
                        @else
                        <div class="p-3">
                            <div class="d-flex align-items-center mb-2">
                                @if(is_null($reducecost->img))
                                <img src="{{asset('home_assets/images/why-paytym-icons/icon6.png')}}" class="img-fluid" alt="">
                                @else
                                <img src="{{asset('uploads/cms/'.$reducecost->img)}}" class="img-fluid" alt="">
                                @endif
                                <h6 class="ml-3 mb-0 text-left fw-600">
                                {{$reducecost->cms_type}}
                                </h6>
                            </div>
                            <p>
                                {{$reducecost->content}}
                            </p>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                    @if(is_null($envfriendly))
                        <div class="p-3">
                            <div class="d-flex align-items-center mb-2">
                                <img src="{{asset('home_assets/images/why-paytym-icons/icon7.png')}}" class="img-fluid" alt="">
                                <h6 class="ml-3 mb-0 text-left fw-600">
                                    Become Environmentally <br>
                                    Friendly
                                </h6>
                            </div>
                            <p>
                                Adopting Paytym’s cloud-based SaaS solution reduces
                                energy consumption, lowering your carbon footprint.
                                Fewer servers and optimized cloud storage lead to
                                energy savings and efficient resource utilization.
                                Embrace this eco-conscious and sustainable approach
                                where environmentally-aware employers can
                                contribute to a greener future.
                            </p>
                        </div>
                        @else
                        <div class="p-3">
                            <div class="d-flex align-items-center mb-2">
                                @if(is_null($envfriendly->img))
                                <img src="{{asset('home_assets/images/why-paytym-icons/icon7.png')}}" class="img-fluid" alt="">
                                @else
                                <img src="{{asset('uploads/cms/'.$envfriendly->img)}}" class="img-fluid" alt="">
                                @endif
                                <h6 class="ml-3 mb-0 text-left fw-600">
                                {{$envfriendly->cms_type}}
                                </h6>
                            </div>
                            <p>
                                {{$envfriendly->content}}
                            </p>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                    @if(is_null($effortlessstat))
                        <div class="p-3">
                            <div class="d-flex align-items-center mb-2">
                                <img src="{{asset('home_assets/images/why-paytym-icons/icon8.png')}}" class="img-fluid" alt="">
                                <h6 class="ml-3 mb-0 text-left fw-600">
                                    Effortless Statutory <br>
                                    Compliance
                                </h6>
                            </div>
                            <p>
                                Paytym solution ensures effortless compliance by
                                automatically updating its systems to meet the latest
                                statutory regulations, tax laws, labour requirements
                                and generates reports to fulfill legal obligations.
                                Employers benefit from a hassle-free, error-free
                                payroll process, freeing up HR and payroll staff for
                                more strategic tasks while remaining fully compliant.
                            </p>
                        </div>
                        @else
                        <div class="p-3">
                            <div class="d-flex align-items-center mb-2">
                                @if(is_null($effortlessstat->img))
                                <img src="{{asset('home_assets/images/why-paytym-icons/icon8.png')}}" class="img-fluid" alt="">
                                @else
                                <img src="{{asset('uploads/cms/'.$effortlessstat->img)}}" class="img-fluid" alt="">
                                @endif
                                <h6 class="ml-3 mb-0 text-left fw-600">
                                {{$effortlessstat->cms_type}}
                                </h6>
                            </div>
                            <p>
                                {{$effortlessstat->content}}
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- our-expert-section -->
    <!-- <section class="our-expert">
        <div class="container about-title pt-5 text-center">
            <h3>Our Expert Team</h3>
            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
            </p>
        </div>

        <div class="container"  data-aos="zoom-in"    data-aos-duration="2000">
            <div class="row text-center">
                <div class="col-md-4 pt-4">
                        <img src="{{asset('home_assets/images/expert/1.jpg')}}" alt="" srcset="">
                        <div class="name text-center"><b>Justin Roberto</b></div>
                        <p class="text-center   sub-text">Founder & CEO</p>
                </div>

                <div class="col-md-4 pt-4">
                    <img src="{{asset('home_assets/images/expert/2.jpg')}}" alt="" srcset="">
                    <div class="name text-center"><b>Lous augustus</b></div>
                    <p class="text-center  sub-text">Co-Founder
                </div>

                <div class="col-md-4 pt-4">
                    <img src="{{asset('home_assets/images/expert/3.jpg')}}" alt="" srcset="">
                    <div class="name text-center"><b>Carl Antersion</b></div>
                    <p class="text-center  sub-text">Web Developer</p>
                </div>
            </div>
        </div>

    </section> -->


    <!-- get-in-touch-section -->

    <section class="get-in-touch" id="contact">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-4 my-2">
                    <div class="img-wrp">
                        <img src="{{ asset('home_assets/images/SCREEN-1.png') }}" alt="">
                    </div>
                </div>
                <div class="col-md-4 my-2">
                    <div class="img-wrp">
                        <img src="{{ asset('home_assets/images/SCREEN-2.png') }}" alt="">
                    </div>
                </div>
                <div class="col-md-4 my-2">
                    <div class="img-wrp">
                        <img src="{{ asset('home_assets/images/SCREEN-3.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="container get-title pt-5 text-center">
            <h3>Get In Touch</h3>
            <p>Get in touch with our team for assistance or reach out for any inquiries!
            </p>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div> -->

        <!-- <div class="container" data-aos="fade-down" data-aos-duration="2000">

            <form action="{{Route('admin.contact.store')}}" method="POST">
                @csrf
                <div class="row pt-2">
                    <div class="col-md-6 pt-2">
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="Name" aria-describedby="emailHelp" required>
                    </div>
                    <div class="col-md-6 pt-2">
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Email" aria-describedby="emailHelp" required>
                    </div>
                    <div class="col-md-12 pt-2">
                        <textarea class="form-control" placeholder="Message" name="message" id="floatingTextarea2" style="height: 100px" required></textarea>
                    
                    </div>
                    <div class="send-btn pb-2 text-center w-100 pt-5">
                        <input type="submit" class="btn text-white btn-typ2" value="Submit">
                    </div>
                </div>
            </form>
        </div> -->

    </section>

    <!-- footer-section -->
    <footer id="footer" class="footer-section">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-6 foot-img">
                    <img src="{{asset('home_assets/images/logo.png')}}" alt="" srcset="" class="mb-2 footer-logo">
                    <div class="footer-contact-sec">
                        <div class="address mb-3">1 Regal Lane, <br> Level 2 De Vos on the Park Building, <br>Suva, Fiji</div>
                        <div>
                            Email: <a href="mailto:contact@paytym.net">contact@paytym.net</a>
                        </div>
                        <ul class="social-links mt-3">
                            <li class="fb-icon"><a href="https://www.facebook.com/people/Paytym/100089080389947/?mibextid=ZbWKwL"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li class="lnkdn-icon"><a href="https://www.linkedin.com/showcase/paytym/"><i class="fa-brands fa-linkedin-in"></i></a></li>
                            <li class="twtr-icon"><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                            <!-- <li><a href=""><i class="fa-brands fa-instagram"></i></a></li> -->
                        </ul>
                    </div>
                </div>
                <!-- <div class="col-md-2 pt-2">
                <div class="quik-link">
                    <h5 class="mt-4">For Employers</h5>
                    <ul class="links pt-3">
                        <li><a href="" >See Plans</a></li>
                        <li><a href="" >Features</a></li>
                        <li><a href="" >Post a Job</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 pt-2">
                <div class="quik-link">
                    <h5 class="mt-4">For Employees</h5>
                    <ul class="links pt-3">
                        <li><a href="" >Features</a></li>
                    </ul>
                </div>
            </div> -->
                <div class="col-md-3 pt-2">
                    <div class="quik-link">
                        <h5 class="mt-4">Quick Links</h5>
                        <ul class="links pt-3">
                            <li><a href="#about">About</a></li>
                            <li><a href="#HowItWork">Registration process</a></li>
                            <li><a href="#pricing">Pricing</a></li>
                            <!-- <li><a href="#contact">Contact Us</a></li> -->

                            <li><a href="{{ route('privacy_policy') }}" target="_blank">Privacy Policy and Terms of Use</a></li>
                            <!-- <li><a href="#" >Terms and Conditions</a></li> -->
                            <!-- <li><a href="#" >Post a Job</a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 pt-2">
                    <div class="quik-link">
                        <h5 class="mt-4">Download</h5>
                        <div class="links-dow pt-3">
                            <a href="https://drive.google.com/file/d/1ajueOBPr2k2tohOKSS_J8DldqQxiQSTM/view"><img src="{{asset('home_assets/images/footer/1 1.png')}}" class="pt-2" alt="" srcset=""></a>
                            <a href="" onclick="alert('Under construction');return false;"><img src="{{asset('home_assets/images/footer/2 1.png')}}" class="pt-2" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p class="copy-text">Copyright &copy; 2023 Paytym.net . All Rights Reserved</p>
                </div>
            </div>
        </div>

    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/ecfd9b3c91.js" crossorigin="anonymous"></script>
    <script src="{{asset('home_assets/js/app.js')}}"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script> -->
    <script src="{{asset('home_assets/js/owl.carousel.min.js')}}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    @if (session('success'))
    <script>
        Swal.fire(
            'Success!',
            '{{ session('
            success ') }}',
            'success'
        )
    </script>
    @endif
    @if (session('error'))
    <script>
        Swal.fire(
            'error!',
            'Please enter a valid email ID and check again',
            'warning'
        )
    </script>
    @endif

    <script>
        $(document).ready(function() {
            $('.banner-carousel').owlCarousel({
                loop: true,
                autoplay: true,
                margin: 30,
                nav: false,
                dots: false,
                center: true,
                smartSpeed: 1000,
                items: 1
            })
            AOS.init();

        });
    </script>
    <script>
        $(document).ready(function() {
            $('.testimonial-carousel').owlCarousel({
                loop: true,
                autoplay: true,
                margin: 30,
                nav: false,
                dots: false,
                center: true,
                smartSpeed: 1000,
                items: 1
            })
            AOS.init();

        });
    </script>

    @push('custom_js')
    <script src="{{ asset('admin_assets/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/tinymce.js') }}"></script>
    @endpush
</body>

</html>