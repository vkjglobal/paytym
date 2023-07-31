@extends('employer.layouts.app')
@dd($plan)
@push('custom_css')
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
        {{-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> --}}
        <link rel="shortcut icon" href="{{asset('home_assets/images/fevicon.PNG')}}" type="">
        <link rel="stylesheet" href="{{asset('home_assets/css/style.css')}}">
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endpush
@section('content')
    {{-- @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent --}}

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                        
                    <h6 class="card-title">Plans</h6>
                    <div class="row ">
                        
                    <div class="col ">
                        @foreach ($subscriptions as $subscription)
                        <div class="card-price-blue white-bg rounded border mt-3 ">
                            <div class="p-lg-4 p-3 " >
                                <h3 class="text-center fw-600">{{$subscription->plan}}</h3>
                                <hr> 
                                <h4 class="text-center d-flex flex-column align-items-center">
                                    <strong>$<span>{{$subscription->rate_per_month}}</span></strong>
                                    <span class="small-text">Per Month</span>
                                </h4>
                                <hr>
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center justify-content-center mb-md-4 mb-1">
                                        <strong>{{$subscription->range_from}} to {{$subscription->range_to}}</strong>
                                        <span>employees</span>
                                        {{-- <span>Free</span> --}}
                                    </div>
                                    <form action="{{route('employer.billing')}}" method="get">
                                        <div class="btn-started text-center">
                                            <button class="btn" type="submit">
                                                Get Started
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                    </div>
                    
                    {{-- <div class="col-md-4">
                        <div class="card-price-blue white-bg rounded border mt-3">
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
                                        
                                    </div>
                                    <form action="{{route('employer.billing')}}" method="get">
                                        <div class="btn-started text-center">
                                            <button class="btn" type="submit">
                                                Get Started
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-price-blue white-bg rounded border mt-3">
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
                                        
                                    </div>
                                    <form action="{{route('employer.billing')}}" method="get">
                                        <div class="btn-started text-center">
                                            <button class="btn" type="submit">
                                                Get Started
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div> --}}
                    
                    {{-- <div>
                        <!-- pricing-plan section -->
                        <section class="pricing-plan" id="pricing">
                            <div class="container about-title pt-5 text-center">
                         --}}
                            {{-- @if(is_null($pricing))
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
                        @endforeach --}}

                               


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
                                    </div>-->
                                {{-- </div>
                            </div>
                        </section>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom_css')
    <link rel="stylesheet" href="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
@endpush
@push('custom_js')
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
