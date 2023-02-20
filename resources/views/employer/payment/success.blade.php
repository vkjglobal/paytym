@extends('employer.layouts.app')
@section('content')
@push('custom_css')
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
<style>
      h1 {
        color: #88B04B;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-weight: 900;
        font-size: 40px;
        margin-bottom: 10px;
      }
      .line {
        color: #404F5E;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-size:20px;
        margin: 0;
      }
    .checkmark {
      color: #9ABC66;
      font-size: 100px;
      line-height: 200px;
      margin-left:-15px;
    }
    .card1 {
      background: white;
      padding: 60px;
      border-radius: 4px;
      box-shadow: 0 2px 3px #C8D0D8;
      display: inline-block;
      margin: 0 auto;
      text-align: center;
      padding: 40px 0;
      /* background: #EBF0F5; */
    }
  </style>
@endpush
    {{-- @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent --}}

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            {{-- <div class="card">
                <div class="card-body"> --}}
                        
                    {{-- <h6 class="card-title">Plans</h6> --}}

                        <div class="card1 col-md-10 grid-margin stretch-card mt-4">
                            <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
                              <i class="checkmark">✓</i>
                            </div>
                              <h1>Success</h1> 
                              <p class="line">The transaction was complete;<br/></p>
                            </div>

                    
                {{-- </div>
            </div> --}}
        </div>
    </div>
@endsection
@push('custom_js')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/ecfd9b3c91.js" crossorigin="anonymous"></script>
    <script src="{{asset('home_assets/js/app.js')}}"></script>
    <script src="{{asset('home_assets/js/owl.carousel.min.js')}}"></script>    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> 

        

<script src="{{ asset('admin_assets/vendors/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/tinymce.js') }}"></script>

@endpush
