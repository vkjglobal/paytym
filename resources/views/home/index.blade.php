<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paytym</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Montserrat:ital,wght@0,200;0,300;0,700;0,800;1,200;1,300;1,500;1,600;1,700;1,800;1,900&family=Oswald:wght@200;300&family=Poppins:ital,wght@0,100;0,300;0,400;1,300;1,400;1,500;1,600&family=Urbanist:wght@300&display=swap"
        rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('home_assets/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('home_assets/css/owl.theme.default.min.css')}}">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link rel="shortcut icon" href="{{asset('home_assets/images/fevicon.PNG')}}" type="">
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
                                   
                                    <li class="nav-item">
                                        <a class="nav-link" href="#about">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#ForEmployers">For Employers</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#ForEmployees">For Employees</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#HowItWork">How It Works?</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#pricing">Pricing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#contact">Contact</a>
                                    </li> 
                                </ul>
                                <span class="download">
                                    <a href="{{Route('employer.login')}}" class="btn btn-typ2">Login</a>
                                    <a href="#downloadApp" class="btn btn-typ2">Download</a>
                                </span>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="sticky-button"><img src="{{asset('home_assets/images/logo-jobtym.png')}}" alt=""></a>
     </header>


    <!-- Banner Section -->
   
    <section class="header-section hero-section" id="home">
        <div class="container">
            <div class="row ">
                <div class="col-md-6 text-white  " data-aos="fade-up"    data-aos-duration="2000">
                    <div class="text"> 
                        <!-- <h1 class="first-text">Creative <br>Solutions to</h1>
                        <h1 class="sub-text"> Improve your <br>Business.</h1> -->
                        <div class="banner-txt">
                            Are you looking for an advanced and
                            innovative <strong class="fw-600"> HR management and
                            Payroll software system?</strong>
                            If YES, then we have the perfect
                            solution for you!
                        </div>
                    </div>

                </div>
                <div class="col-md-6 pt-3">
                    <div class="right-img"  data-aos="fade-down"    data-aos-duration="2000">
                        <img src="{{asset('home_assets/images/Group 82.png')}}" alt="" srcset="">
                  </div>
         </div>
        </div>
    </section>
    
    <!-- Banner End -->
   

    <!-- about-section -->
    <section class="about-section" id="about">
        <div class="container"  >
            <div class="about-title pt-5 text-center" >
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
            <div class="about-title pt-5 text-center" >
            @if(is_null($foremployers))
            <h3> For Employers </h3>
                   <p>  As an employer, the Paytym app allows you to easily manage your employees and their salaries and 
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
            <div class="feature-wrp">
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
                <div class="row pt-3 justify-content-center"  data-aos="zoom-in-up"    data-aos-duration="2000">
                    <div class="col-md-4 mb-md-4 mb-3 d-flex">
                        <div class="card-about text-center  pb-3">
                            <span class="icon-back text-center " class="px-2 py-2">
                                <svg width="42" height="28" viewBox="0 0 42 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M33.8625 10.57C33.2747 7.59101 31.6708 4.9085 29.3249 2.98068C26.9789 1.05286 24.0364 -0.000686424 21 3.35539e-07C15.9425 3.35539e-07 11.55 2.87 9.3625 7.07C6.79041 7.34796 4.41176 8.56661 2.68361 10.4918C0.955449 12.417 -0.000300478 14.9129 7.08623e-08 17.5C7.08623e-08 23.2925 4.7075 28 10.5 28H33.25C38.08 28 42 24.08 42 19.25C42 14.63 38.4125 10.885 33.8625 10.57ZM33.25 24.5H10.5C6.6325 24.5 3.5 21.3675 3.5 17.5C3.5 13.9125 6.1775 10.92 9.73 10.5525L11.6025 10.36L12.4775 8.6975C13.2823 7.13086 14.5038 5.81668 16.0075 4.89964C17.5112 3.9826 19.2387 3.49828 21 3.5C25.585 3.5 29.54 6.755 30.4325 11.2525L30.9575 13.8775L33.635 14.07C34.9505 14.1585 36.1837 14.742 37.0864 15.7031C37.989 16.6642 38.4941 17.9315 38.5 19.25C38.5 22.1375 36.1375 24.5 33.25 24.5ZM17.5 17.815L13.8425 14.1575L11.375 16.625L17.5 22.75L28.0175 12.2325L25.55 9.765L17.5 17.815Z" fill="#ffffff"/>
                                </svg>    
                            </span>
                            <div class="card-body pt-3">
                                <h5 class="card-title pt-2 text-center">Employee Management</h5>
                                <p class="card-text pt-3 text-center">On-board new employees, track and manage their information and benefits, time and attendance, 
                                    shifts and time off. Show scheduled meetings in calendar.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-md-4 mb-3 d-flex">
                        <div class="card-about text-center  pb-3">
                            <span class="icon-back text-center " class="px-2 py-2">
                                <svg width="27" height="30" viewBox="0 0 27 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.93945 21.4395L10.0605 23.5605L13.5 20.121L16.9395 23.5605L19.0605 21.4395L15.621 18L19.0605 14.5605L16.9395 12.4395L13.5 15.879L10.0605 12.4395L7.93945 14.5605L11.379 18L7.93945 21.4395Z" fill="white"/>
                                    <path d="M24 3H21V0H18V3H9V0H6V3H3C1.3455 3 0 4.3455 0 6V27C0 28.6545 1.3455 30 3 30H24C25.6545 30 27 28.6545 27 27V6C27 4.3455 25.6545 3 24 3ZM24.003 27H3V9H24L24.003 27Z" fill="white"/>
                                </svg>    
                            </span>
                            <div class="card-body pt-3">
                                <h5 class="card-title pt-2 text-center">Payroll Management</h5>
                                <p class="card-text pt-3 text-center">Automatically calculate and process employee salaries and benefits, such as vacation and leaves, tax 
                                    deductions, and other deductions.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-md-4 mb-3 d-flex">
                        <div class="card-about text-center  pb-3">
                            <span class="icon-back text-center " class="px-2 py-2">
                                <svg width="25" height="30" viewBox="0 0 25 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.25 15.375C17.25 15.0766 17.1315 14.7905 16.9205 14.5795C16.7095 14.3685 16.4234 14.25 16.125 14.25H8.625C8.32663 14.25 8.04048 14.3685 7.82951 14.5795C7.61853 14.7905 7.5 15.0766 7.5 15.375V16.125C7.5 17.625 9.5745 18.75 12.375 18.75C15.1755 18.75 17.25 17.625 17.25 16.125V15.375ZM15 10.1175C15 8.67 13.8255 7.5 12.375 7.5C10.9245 7.5 9.75 8.6685 9.75 10.1175C9.75 10.8137 10.0266 11.4814 10.5188 11.9737C11.0111 12.4659 11.6788 12.7425 12.375 12.7425C13.0712 12.7425 13.7389 12.4659 14.2312 11.9737C14.7234 11.4814 15 10.8137 15 10.1175ZM0 3.75C0 2.75544 0.395088 1.80161 1.09835 1.09835C1.80161 0.395088 2.75544 0 3.75 0H21C21.4925 0 21.9801 0.0969966 22.4351 0.285452C22.89 0.473907 23.3034 0.75013 23.6516 1.09835C23.9999 1.44657 24.2761 1.85997 24.4645 2.31494C24.653 2.76991 24.75 3.25754 24.75 3.75V25.125C24.75 25.4234 24.6315 25.7095 24.4205 25.9205C24.2095 26.1315 23.9234 26.25 23.625 26.25H2.25C2.25 26.6478 2.40804 27.0294 2.68934 27.3107C2.97064 27.592 3.35218 27.75 3.75 27.75H23.625C23.9234 27.75 24.2095 27.8685 24.4205 28.0795C24.6315 28.2905 24.75 28.5766 24.75 28.875C24.75 29.1734 24.6315 29.4595 24.4205 29.6705C24.2095 29.8815 23.9234 30 23.625 30H3.75C2.75544 30 1.80161 29.6049 1.09835 28.9016C0.395088 28.1984 0 27.2446 0 26.25V3.75ZM2.25 3.75V24H22.5V3.75C22.5 3.35218 22.342 2.97064 22.0607 2.68934C21.7794 2.40804 21.3978 2.25 21 2.25H3.75C3.35218 2.25 2.97064 2.40804 2.68934 2.68934C2.40804 2.97064 2.25 3.35218 2.25 3.75Z" fill="white"/>
                                </svg>    
                            </span>
                            <div class="card-body pt-3">
                                <h5 class="card-title pt-2 text-center">Direct Deposits to Employee Accounts</h5>
                                <p class="card-text pt-3 text-center">Offer employees the option to split salary and receive payments into multiple accounts as per 
                                    channels available in the platform.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-md-4 mb-3 d-flex">
                        <div class="card-about text-center  pb-3">
                            <span class="icon-back text-center " class="px-2 py-2">
                                <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.25 10.75C8.82453 10.75 9.39344 10.6368 9.92424 10.417C10.455 10.1971 10.9373 9.87485 11.3436 9.46859C11.7498 9.06234 12.0721 8.58004 12.292 8.04924C12.5118 7.51844 12.625 6.94953 12.625 6.375C12.625 5.80047 12.5118 5.23156 12.292 4.70076C12.0721 4.16996 11.7498 3.68766 11.3436 3.28141C10.9373 2.87515 10.455 2.55289 9.92424 2.33303C9.39344 2.11316 8.82453 2 8.25 2C7.08968 2 5.97688 2.46094 5.15641 3.28141C4.33594 4.10188 3.875 5.21468 3.875 6.375C3.875 7.53532 4.33594 8.64812 5.15641 9.46859C5.97688 10.2891 7.08968 10.75 8.25 10.75V10.75ZM20.75 10.75C21.3245 10.75 21.8934 10.6368 22.4242 10.417C22.955 10.1971 23.4373 9.87485 23.8436 9.46859C24.2498 9.06234 24.5721 8.58004 24.792 8.04924C25.0118 7.51844 25.125 6.94953 25.125 6.375C25.125 5.80047 25.0118 5.23156 24.792 4.70076C24.5721 4.16996 24.2498 3.68766 23.8436 3.28141C23.4373 2.87515 22.955 2.55289 22.4242 2.33303C21.8934 2.11316 21.3245 2 20.75 2C19.5897 2 18.4769 2.46094 17.6564 3.28141C16.8359 4.10188 16.375 5.21468 16.375 6.375C16.375 7.53532 16.8359 8.64812 17.6564 9.46859C18.4769 10.2891 19.5897 10.75 20.75 10.75V10.75Z" stroke="white" stroke-width="3" stroke-linejoin="round"/>
                                    <path d="M2 27V21.375C2 17.9231 4.35625 15.125 7.26312 15.125H10.4213C12.9744 15.125 14.5 17.6419 14.5 17.6419" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M27 27V21.375C27 17.9231 24.6156 15.125 21.6744 15.125H18.4787C16.0031 15.125 14.495 17.6419 14.5 17.6419M6.375 24.5H23.25" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M20.9344 22.1611L21.7094 22.9405L23.2594 24.4999L21.7094 26.1005L20.9344 26.9011M8.45631 22.1449L7.66881 22.9286L6.09506 24.4955L7.66881 26.088L8.45631 26.8849" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>

                            <div class="card-body pt-3">
                                <h5 class="card-title pt-2 text-center">Payroll Tax and Contribution Filing</h5>
                                <p class="card-text pt-3 text-center">Auto generate payroll tax reports and employer/employee contributions for simple statutory filing 
                                    requirements.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-md-4 mb-3 d-flex">
                        <div class="card-about text-center  pb-3">
                            <span class="icon-back text-center " class="px-2 py-2">
                                <svg width="26" height="30" viewBox="0 0 26 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.83166 7.09747C7.10854 5.2732 9.94019 4.28126 12.8577 4.28591C15.8936 4.28591 18.6837 5.33739 20.8838 7.09747L22.9596 5.02166L24.9797 7.04176L22.9039 9.11757C24.415 11.0093 25.3613 13.2892 25.6338 15.695C25.9063 18.1008 25.494 20.5346 24.4444 22.7164C23.3948 24.8982 21.7504 26.7393 19.7006 28.0279C17.6509 29.3164 15.2789 30 12.8577 30C10.4366 30 8.06464 29.3164 6.01484 28.0279C3.96505 26.7393 2.32073 24.8982 1.2711 22.7164C0.221469 20.5346 -0.190806 18.1008 0.0817185 15.695C0.354243 13.2892 1.30049 11.0093 2.81157 9.11757L0.735756 7.04318L2.75585 5.02309L4.83166 7.0989V7.09747ZM12.8577 27.1441C14.171 27.1441 15.4714 26.8854 16.6848 26.3829C17.8981 25.8803 19.0005 25.1437 19.9291 24.215C20.8578 23.2864 21.5944 22.184 22.097 20.9707C22.5995 19.7574 22.8582 18.4569 22.8582 17.1437C22.8582 15.8304 22.5995 14.53 22.097 13.3166C21.5944 12.1033 20.8578 11.0009 19.9291 10.0723C19.0005 9.14363 17.8981 8.407 16.6848 7.90443C15.4714 7.40186 14.171 7.14319 12.8577 7.14319C10.2055 7.14319 7.6618 8.19681 5.78635 10.0723C3.9109 11.9477 2.85728 14.4914 2.85728 17.1437C2.85728 19.7959 3.9109 22.3396 5.78635 24.215C7.6618 26.0905 10.2055 27.1441 12.8577 27.1441ZM14.2864 15.715H18.5723L11.4291 25.0012V18.5723H7.1432L14.2864 9.279V15.715ZM7.1432 0H18.5723V2.85728H7.1432V0Z" fill="white"/>
                                </svg>
                            </span>
                            <div class="card-body pt-3">
                                <h5 class="card-title pt-2 text-center ">Analytics and Report</h5>
                                <p class="card-text pt-3 text-center">Manage and view payroll summaries, trends, comparisons, employee breakdowns and tax 
                                    compliance reports at a click.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-md-4 mb-3 d-flex">
                        <div class="card-about text-center pb-3">
                            <span class="icon-back text-center " class="px-2 py-2">
                                <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 15V13M8 15V11M11 15V9M13 19H3C2.46957 19 1.96086 18.7893 1.58579 18.4142C1.21071 18.0391 1 17.5304 1 17V3C1 2.46957 1.21071 1.96086 1.58579 1.58579C1.96086 1.21071 2.46957 1 3 1H8.586C8.8512 1.00006 9.10551 1.10545 9.293 1.293L14.707 6.707C14.8946 6.89449 14.9999 7.1488 15 7.414V17C15 17.5304 14.7893 18.0391 14.4142 18.4142C14.0391 18.7893 13.5304 19 13 19Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                            <div class="card-body pt-3">
                                <h5 class="card-title pt-2 text-center">Chat</h5>
                                <p class="card-text pt-3 text-center">Create chat groups by company, business, branch, department or custom and chat with employees in 
                                    the relevant groups.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="forEmployees-section" id="ForEmployees">
        <div class="container">
            <div class="about-title pt-5 text-center" >
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
                                <div class="about-icons"><img src="{{asset('home_assets/images/about-icons/Group 1.png')}}" alt="" srcset="">
                                </div>
                                <div class="text-table">
                                    <strong class="d-block mb-2 black-txt">Pay Slips</strong>
                                    <p class="grey-txt">view and download payslips for each pay.</p>
                                </div>
                            </div>
                        </li>
                        <li class="col-md-6 col-12 mb-md-5 mb-3">
                            <div class="d-flex">
                                <div class="about-icons"><img src="{{asset('home_assets/images/about-icons/Group 2.png')}}" alt="" srcset="">
                                </div>
                                <div class="text-table">
                                    <strong class="d-block mb-2 black-txt">Leaves and Time Off</strong>
                                    <p class="grey-txt">apply for leaves and view approvals.</p>
                                </div>
                            </div>
                        </li>
                        <li class="col-md-6 col-12 mb-md-5 mb-3">
                            <div class="d-flex">
                                <div class="about-icons"><img src="{{asset('home_assets/images/about-icons/Group 3.png')}}" alt="" srcset="">
                                </div>
                                <div class="text-table">
                                    <strong class="d-block mb-2 black-txt">Personal Profile</strong>
                                    <p class="grey-txt">update your personal profile at any time.</p>
                                </div>
                            </div>
                        </li>
                        <li class="col-md-6 col-12 mb-md-5 mb-3">
                            <div class="d-flex">
                                <div class="about-icons"><img src="{{asset('home_assets/images/about-icons/Group 4.png')}}" alt="" srcset="">
                                </div>
                                <div class="text-table">
                                    <strong class="d-block mb-2 black-txt">Deposit Accounts</strong>
                                    <p class="grey-txt">update your payment accounts at any time.</p>
                                </div>
                            </div>
                        </li>
                        <li class="col-md-6 col-12 mb-md-5 mb-3">
                            <div class="d-flex">
                                <div class="about-icons"><img src="{{asset('home_assets/images/about-icons/Group 4.png')}}" alt="" srcset="">
                                </div>
                                <div class="text-table">
                                    <strong class="d-block mb-2 black-txt">Shift Roster</strong>
                                    <p class="grey-txt">view shifts and scheduled meetings.</p>
                                </div>
                            </div>
                        </li>
                        <li class="col-md-6 col-12 mb-md-5 mb-0">
                            <div class="d-flex">
                                <div class="about-icons"><img src="{{asset('home_assets/images/about-icons/Group 4.png')}}" alt="" srcset="">
                                </div>
                                <div class="text-table">
                                    <strong class="d-block mb-2 black-txt">Chat</strong>
                                    <p class="grey-txt">conveniently chat within designated groups.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 d-lg-block d-none" >
                    <div class="img-right " data-aos="fade-down"    data-aos-duration="2000">
                        <img src="{{asset('home_assets/images/Group 48.png')}}" alt="" srcset="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- showcase-section -->
    <section class="showcase-section" >
        <div class="container" >
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
            <div class="row" data-aos="fade-down"    data-aos-duration="2000">
                <div class="col-md-2 pt-2">
                    <img src="{{asset('home_assets/images/showcase/showcase-img1.jpg')}}" alt="" srcset="">
                </div>
                <div class="col-md-2 pt-2 ">
                    <img src="{{asset('home_assets/images/showcase/showcase-img2.jpg')}}" alt="" srcset="">
                </div>
                <div class="col-md-2 pt-2">
                    <img src="{{asset('home_assets/images/showcase/showcase-img3.jpg')}}" alt="" srcset="">
                </div>
                <div class="col-md-2 dash pt-2">
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
        <div class="container" >
            <div class="about-title pt-5 text-center">
                <h3>Download App</h3>
            </div>
            <div class="row align-items-center justify-content-center mt-md-4 mt-3" data-aos="fade-down"    data-aos-duration="2000">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6 pt-2">
                            <div class="d-flex align-items-center justify-content-center justify-content-md-end">
                                <a href="">
                                    <img src="{{asset('home_assets/images/footer/1 1.png')}}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 pt-2 ">
                            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                <a href="">
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
   <h3  class="light-blue-text">{{$howitworks->cms_type}}</h3>
   <p>{{$howitworks->content}}</p>
   @endif

    </div>
    <div class="container" data-aos="zoom-in"    data-aos-duration="2000">
        <div class="row justify-content-center">
            <div class="col-md-4 col-sm-6">
                <div class="card-work text-center">
                    <div class="work-img-wrp">
                        <img src="{{asset('home_assets/images/svg/1.svg')}}" alt="">
                    </div>
                    <div class="title-wrp">
                        Employer Chooses a
                        <strong>PLAN & REGISTERS</strong>
                    </div>
                </div>    
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card-work text-center">
                    <div class="work-img-wrp">
                        <img src="{{asset('home_assets/images/svg/2.svg')}}" alt="">
                    </div>
                    <div class="title-wrp">
                        Employer on-boarding
                        <strong>EMPLOYEES</strong>
                    </div>
                </div>    
            </div>
            <div class="col-md-4 col-sm-6 line-right">
                <div class="card-work text-center">
                    <div class="work-img-wrp">
                        <img src="{{asset('home_assets/images/svg/3.svg')}}" alt="">
                    </div>
                    <div class="title-wrp">
                        Share login details with
                        <strong>EMPLOYEES</strong>
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
                        <strong>PAYTYM MOBILE APP</strong>
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
                        <strong>SIGNS IN</strong>
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
                        <strong>EMPLOYER & EMPLOYEE</strong>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</section>


    <!-- testimonial-section -->

    <section class="testimonial-section" id="testimonial">
        <div class="container about-title pt-5 text-center">
        @if(is_null($testimonial))
            <h3>Testimonial</h3>
            <p>We do not brag but what others say about us can help you in understanding our ability and ethics well.
            </p>
            @else
            <h3>{{$testimonial->cms_type}}</h3>
            <p>{{$testimonial->content}}</p>
            @endif
        </div>
        <!-- <div class="container text-center testi" data-aos="fade-down"    data-aos-duration="2000">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active pt-4">
                        <p>“ Most Recomented!! These guys are very friendly and creative <br>
                            you have expected, value for money very happy after working with them.”</p>
                        <img src="images/testi/Group 73.png" alt="" srcset="" class="pt-3">
                        <h4 class="text-center text-secondary pt-4">Selvedin Durak
                        </h4>
                        <p class="text-dark">Mojlife</p>

                    </div>
                    <div class="carousel-item pt-4">
                        <p>“ Highly recommended!! These guys are very friendly and they will provide you more than<br>
                            you have expected, value for money very happy after working with them.”

                        </p>
                        <img src="images/testi/Group 74.png" alt="" srcset="" class="pt-3">
                        <h4 class="text-center text-secondary pt-4">Selvedin Durak
                        </h4>
                        <p class="text-dark">ColorCode</p>
                    </div>
                    <div class="carousel-item pt-4">
                        <p>“ Most Dedicated!! These guys are very Dedicated and creative <br>
                            you have expected, We will happy after Working with Them”</p>

                        <img src="images/testi/Group 74.png" alt="" srcset="" class="pt-3">

                        <h4 class="text-center text-secondary pt-4">Selvedin Durak
                        </h4>
                        <p class="text-dark">Datahub</p>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div> -->
        <div class="container" data-aos="fade-down"    data-aos-duration="2000">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="owl-carousel testimonial-carousel owl-theme owl-loaded">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
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
                                            <img src="{{asset('home_assets/images/profile-image/2.jpg')}}" alt="">
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
                                            <img src="{{asset('home_assets/images/profile-image/5.jpg')}}" alt="">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

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
    <div class="container" data-aos="fade-up" data-aos-duration="2000" >
        <div class="form-row justify-content-center pt-2" style="width:auto">
        @foreach ($subscription as $sub)
        @if($sub->plan == 'MICRO')    
        <div class="col" style="width:100%">
                <div class="card-price-blue white-bg rounded border mt-3" style="width:212px">
                    <div class="p-lg-4 p-3" >
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
                            <div class="btn-started text-center">
                                <button class="btn" type="button"><!--  onclick="window.location='{{Route('employer.login')}}'" -->
                                    Get Started
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($sub->plan == 'MEGA')
            <div class="col" style="width:100%">
                <div class="card-price-blue white-bg rounded border mt-3" style="width:212px">
                    <div class="p-lg-4 p-3" >
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
                            <div class="btn-started text-center">
                                <button class="btn" type="button"><!--  onclick="window.location='{{Route('employer.login')}}'" -->
                                    Get Started
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="col" style="width:100%">
                <div class="card-price-blue white-bg rounded border mt-3" style="width:212px">
                    <div class="p-lg-4 p-3" >
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
                            <div class="btn-started text-center">
                                <button class="btn" type="button"><!--  onclick="window.location='{{Route('employer.login')}}'" -->
                                    Get Started
                                </button>
                            </div>
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
 -->        </div>
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
    <div class="container get-title pt-5 text-center">
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
    </div>

    <div class="container" data-aos="fade-down"    data-aos-duration="2000" >
        
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
                        <!-- <div class="form-floating">
                            <label for="floatingTextarea2">Message</label>
                        </div> -->
                    </div>
                    <div class="send-btn pb-2 text-center w-100 pt-5">
                        <!-- <button type="button">Send a Message</button> -->
                        <input type="submit" class="btn text-white btn-typ2" value="Submit">
                    </div>
                </div>
            </form>
        </div>

</section>

<!-- footer-section -->
<footer class="footer-section">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6 foot-img">
                <img src="{{asset('home_assets/images/logo.png')}}"  alt="" srcset="" class="mb-2 footer-logo">
                <div class="footer-contact-sec">
                    <div class="address mb-3">1 Regal Lane, <br> Level 2 De Vos on the Park Building, <br>Suva, Fiji</div>
                    <div>
                        Email: <a href="mailto:contact@paytym.net">contact@paytym.net</a> 
                    </div>
                    <ul class="social-links mt-3">
                        <li class="fb-icon"><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li class="lnkdn-icon"><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
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
                        <li><a href="#about" >About</a></li>
                        <li><a href="#contact" >Contact Us</a></li>
                        <li><a href="#" >Privacy Policy</a></li>
                        <li><a href="#" >Terms and Conditions</a></li>
                        <li><a href="#" >Post a Job</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 pt-2">
                <div class="quik-link">
                    <h5 class="mt-4">Download</h5>
                    <div class="links-dow pt-3">
                        <a href=""><img src="{{asset('home_assets/images/footer/1 1.png')}}" class="pt-2" alt="" srcset=""></a>
                        <a href="#"><img src="{{asset('home_assets/images/footer/2 1.png')}}" class="pt-2" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p class="copy-text">Copyright &copy; 2022 Paytym.net . All Rights Reserved</p>
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
    @if (session('success'))
    <script>
        Swal.fire(
            'Success!',
            '{{ session('success') }}',
            'success'
        )
    </script>
    @endif
    @if (session('error'))
    <script>
        Swal.fire(
            'error!',
            '{{ session('error') }}',
            'success'
        )
    </script>
    @endif

    <script>
        

        $(document).ready(function(){
            $('.banner-carousel').owlCarousel({
                loop:true,
                autoplay:true,
                margin:30,
                nav:false,
                dots:false,
                center:true,
                smartSpeed:1000,
                items:1
            })
            AOS.init();

        });
        

    </script> 
    <script>
        

        $(document).ready(function(){
            $('.testimonial-carousel').owlCarousel({
                loop:true,
                autoplay:true,
                margin:30,
                nav:false,
                dots:false,
                center:true,
                smartSpeed:1000,
                items:1
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