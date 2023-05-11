@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> Create Roster</h6>
                    <form method="POST" action="{{ route('employer.roster.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Employee<span class="text-danger">*</span></label>
                                <select class="form-control"  class="form-control @if ($errors->has('employee')) is-invalid @endif" name="employee" value="{{ old('employee') }}" onChange="salaryType(this)">
                                    <option value="">--SELECT--</option>
                                    @foreach ($users as $user )
                                    <option value="{{$user['id']}}" data-salaryType="{{$user['salary_type']}}">{{$user['first_name']." " . $user['last_name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('employee') }}</div>
                                </div>
                        </div><!-- Col -->

                        <!-- <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Business<span class="text-danger">*</span></label>
                            <select class="form-control"  class="form-control @if ($errors->has('business')) is-invalid @endif" name="business" value="{{ old('business') }}">
                                <option value="">--SELECT--</option>
                                @foreach ($businesses as $business)
                                <option value="{{$business['id']}} " {{ old('business')==$business['id'] ? 'selected':'' }}>{{$business['name']}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('business') }}</div>
                        </div>
                        </div> Col -->

                        <!-- <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Department<span class="text-danger">*</span></label>
                                <select class="form-control"  class="form-control @if ($errors->has('department')) is-invalid @endif" name="department" value="{{ old('department') }}">
                                    <option value="">--SELECT--</option>
                                    @foreach ($departments as $department)
                                    <option value="{{$department['id']}}" {{ old('department')==$department['id'] ? 'selected':'' }}>{{$department['dep_name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('department') }}</div>
                            </div>
                        </div>  -->
                  
                        </div><!-- Row -->

                        <div class="row" id="time-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Start Time <span class="text-danger">*</span></label>
                                    <input type="time"
                                        class="form-control @if ($errors->has('start_time')) is-invalid @endif"
                                        name="start_time" value="{{ old('start_time') }}">
                                    <div class="invalid-feedback">{{ $errors->first('start_time') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">End Time <span class="text-danger">*</span></label>
                                    <input type="time"
                                        class="form-control @if ($errors->has('end_time')) is-invalid @endif"
                                        name="end_time" value="{{ old('end_time') }}">
                                    <div class="invalid-feedback">{{ $errors->first('end_time') }}</div>
                                </div>
                            </div><!-- Col -->
                            
                        </div><!-- Row -->

                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Start Date <span class="text-danger">*</span></label>
                                    <input type="date"
                                        class="form-control @if ($errors->has('start_date')) is-invalid @endif"
                                        name="start_date" value="{{ old('start_date') }}" >
                                    <div class="invalid-feedback">{{ $errors->first('start_date') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">End Date<span class="text-danger">*</span></label>
                                    <input type="date"
                                        class="form-control @if ($errors->has('end_date')) is-invalid @endif"
                                        name="end_date" value="{{ old('country') }}">
                                    <div class="invalid-feedback">{{ $errors->first('end_date') }}</div>
                                </div>
                            </div><!-- Col -->
                            
                        </div><!-- Row -->

                        <div class="row" id="time-table" >
                                <!-- The table for setting start and end times for each day of the week -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Day of the Week</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Monday</td>
                                            <td><input type="time" class="form-control" id="mon_start" name="mon_start"></td>
                                            <td><input type="time" class="form-control" id="mon_end" name="mon_end"></td>
                                        </tr>
                                        <tr>
                                            <td>Tuesday</td>
                                            <td><input type="time" class="form-control" id="tue_start" name="tue_start"></td>
                                            <td><input type="time" class="form-control" id="tue_end" name="tue_end"></td>
                                        </tr>
                                        <tr>
                                            <td>Wednesday</td>
                                            <td><input type="time" class="form-control" id="wed_start" name="wed_start"></td>
                                            <td><input type="time" class="form-control" id="wed_end" name="wed_end"></td>
                                        </tr>
                                        <tr>
                                            <td>Thursday</td>
                                            <td><input type="time" class="form-control" id="thu_start" name="thu_start"></td>
                                            <td><input type="time" class="form-control" id="thu_end" name="thu_end"></td>
                                        </tr>
                                        <tr>
                                            <td>Friday</td>
                                            <td><input type="time" class="form-control" id="fri_start" name="fri_start"></td>
                                            <td><input type="time" class="form-control" id="fri_end" name="fri_end"></td>
                                        </tr>
                                        <tr>
                                            <td>Saturday</td>
                                            <td><input type="time" class="form-control" id="sat_start" name="sat_start"></td>
                                            <td><input type="time" class="form-control" id="sat_end" name="sat_end"></td>
                                        </tr>
                                        <tr>
                                            <td>Sunday</td>
                                            <td><input type="time" class="form-control" id="sun_start" name="sun_start"></td>
                                            <td><input type="time" class="form-control" id="sun_end" name="sun_end"></td>
                                        </tr>
                                    </tbody>
                            </table>
                        </div><!-- Row -->
                        


                        <button type="submit" class="btn btn-primary submit">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
<script>
    function salaryType(selectElement) {
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var salaryType = selectedOption.getAttribute('data-salaryType');

    var classToHide = document.getElementById('time-table');
    var classToShow = document.getElementById('time-row'); 
    // Check if the value is 0
    if (salaryType == 0) {
        // Hide the element with class "class-to-hide"
        classToHide.style.display = 'none';
        // Show the element with class "class-to-show"
        classToShow.style.display = '';
    } else {
        // Show the element with class "class-to-hide"
        classToHide.style.display = '';
        // Hide the element with class "class-to-show"
        classToShow.style.display = 'none';
    }
     // Or call any other function here with the salary type parameter
}
</script>
@push('custom_js')
    <script src="{{ asset('admin_assets/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/tinymce.js') }}"></script>
@endpush
