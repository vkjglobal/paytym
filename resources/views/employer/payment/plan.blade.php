@push('custom_css')
<link rel="stylesheet" href="{{asset('home_assets/css/style.css')}}">

@endpush
@extends('employer.layouts.app')
@section('content')
    {{-- @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent --}}

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Plans</h6>
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
                                    <form action="{{Route('employer.billing')}}" method="post">
                                        @csrf
                                    <input type="hidden" name="plan_id" value="{{$sub->id}}">
                                    <button class="btn" type="submit" > 
                                        Buy
                                    </button>
                                    </form>
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
                                    <form action="{{Route('employer.billing')}}" method="post">
                                        @csrf
                                    <input type="hidden" name="plan_id" value="{{$sub->id}}">
                                    <button class="btn" type="submit" > 
                                        Buy
                                    </button>
                                    </form>
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
                                    <form action="{{Route('employer.billing')}}" method="post">
                                        @csrf
                                    <input type="hidden" name="plan_id" value="{{$sub->id}}">
                                    <button class="btn" type="submit" > 
                                        Buy
                                    </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
    @endforeach
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
    
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom_css')
    <link rel="stylesheet" href="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endpush
@push('custom_js')
    <script src="{{ asset('admin_assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin_assets/js/data-table.js') }}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

@endpush