@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> Create Branch</h6>
                    <form method="POST" action="{{ route('employer.branch.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Branch Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('email')) is-invalid @endif"
                                        name="name" value="{{ old('email') }}" placeholder="Enter Branch Name" required>
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Business<span class="text-danger">*</span></label>
                                <select class="form-control"  class="form-control @if ($errors->has('branch')) is-invalid @endif" name="business" value="{{ old('branch') }}">
                                    <option value="">--SELECT--</option>
                                    @foreach ($businesses as $business)
                                    <option value="{{$business['id']}}">{{$business['name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('business') }}</div>
                            </div>
                        </div><!-- Col -->
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Town/City <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('company_phone')) is-invalid @endif"
                                        name="town" value="{{ old('town') }}"
                                        placeholder="Enter Town" required>
                                    <div class="invalid-feedback">{{ $errors->first('town') }}</div>
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Post Code <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('street')) is-invalid @endif"
                                        name="postcode" value="{{ old('postcode') }}" placeholder="Enter Post Code">
                                    <div class="invalid-feedback">{{ $errors->first('postcode') }}</div>
                                </div>
                            </div><!-- Col -->

                            <!-- <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">City <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('phone')) is-invalid @endif"
                                        name="city" value="{{ old('city') }}" placeholder="Enter City" required>
                                    <div class="invalid-feedback">{{ $errors->first('city') }}</div>
                                </div>
                            </div>
                             -->
                            <!-- Col -->

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Country <span class="text-danger">*</span></label>
                                    <select class="form-control" name="country" id="country" value="{{ old('country') }}">
                                        <option value="">--Choose Country--</option>
                                        @foreach ($country as $key => $value )
                                        <option value="{{ $value['id'] }}">{{ $value['name']}}</option>
                                        @endforeach
                                    </select>
                                    
                                    <div class="invalid-feedback">{{ $errors->first('country') }}</div>
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-4" style="display: none;" id="bank_div">
                                <div class="form-group">
                                    <label class="control-label">bank <span class="text-danger">*</span></label>
                                    <select class="form-control" name="bank" id="bank" value="{{ old('bank') }}">
                                    </select>

                                    <div class="invalid-feedback">{{ $errors->first('bank') }}</div>
                                </div>
                            </div><!-- Col -->

                        </div><!-- Row -->

                        <div class="row">
                            <!-- <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">QR Code <span class="text-danger">*</span></label>
                                    <input type="file"
                                        class="form-control @if ($errors->has('logo')) is-invalid @endif"
                                        name="qr_code" value="{{ old('qr_code') }}" placeholder="Enter logo" required>
                                    <div class="invalid-feedback">{{ $errors->first('qr_code') }}</div>
                                </div>
                            </div>Col -->
                        </div><!-- Row -->

                        <button type="submit" class="btn btn-primary submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom_js')
    <script src="{{ asset('admin_assets/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/tinymce.js') }}"></script>
    <!-- <script src="{{ asset('admin_assets/js/fetch_data.js') }}"></script> -->
<script>
       $('#country').change(function(e) {
            var id = $(this).val();
            $('#bank').find('option').remove();
                $.ajax({
                    type: 'get',
                    url: '/employer/report/employment_period/get_bank/' + id,
                    dataType: 'json',
                    success: function(response) {
                        var len = 0;
                        if (response != null) {
                            len = response['data'].length;
                        }
                        if (len > 0) {
                            $("#bank_div").show();
                            var option1="<option value=''>--Choose Bank--</option>";
                            $('#bank').append(option1);
                            for (var i = 0; i < len; i++) {
                                var id = response['data'][i].id;
                                var name = response['data'][i].bank_name;
                                var option = "<option value='" + id + "'>" + name + "</option>";
                                $('#bank').append(option);
                            }
                        }
                    }
                });
        });


        $('#bank').change(function(e) {
            var id = $(this).val();
            alert(id);
        });

</script>
@endpush
