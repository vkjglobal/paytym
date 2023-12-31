@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><u>Import New Employees</u></h6>
                <div class="row mt-4">
                        <div class="col-sm-4">
                        @if(session('msg'))
    <div class="alert alert-light">
        {{ session('msg') }}
    </div>
@endif
                        @if ($errors->any())
    <div class="alert alert-light">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                            <form method="POST" action="{{ route('employer.user.csvfile') }}" enctype="multipart/form-data">
                                @csrf
                                <h6 class="card-title mt-3">Upload a CSV file</h6> 
                                <input type="file" name="csvfile" class="mt-2"><br/>
                                <div class="invalid-feedback">{{ $errors->first('csvfile') }}</div>
                                <button type="submit" class="btn btn-primary submit mt-3">Submit</button>
                           
                            </form>
                        </div>
                    </div>




                </div>
            </div>
        </div>
    </div>
    <br>


    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                   
                   
                                <h6 class="card-title mt-3"><u>Download CSV Import template for New Employees</u></h6> 
                                @if(session('message'))
    <div class="alert alert-light">
        {{ session('message') }}
    </div>
@endif


                                <button type="button" class="btn btn-primary btn-icon-text" onclick="window.location='{{route("employer.download.usertemplate_newemp")}}'">
                            <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                            Download Template for New Employees 
                            
                        </button> 
                   
                        <h6 class="card-title mt-3"><u>Download Instruction Document</u></h6> 

<button type="button" class="btn btn-primary btn-icon-text" onclick="window.location='{{route("employer.download.instruction_doc")}}'">
<i class="btn-icon-prepend" data-feather="download-cloud"></i>
Download Instructions
</button> 
                </div>
            </div>
        </div>
    </div>


    

   
@endsection
@push('custom_js')
    <script src="{{ asset('admin_assets/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/tinymce.js') }}"></script>
@endpush
