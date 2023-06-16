@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div>{{ $errors->first() }}</div>
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> Update Roster</h6>
                    <form method="POST" action="{{ route('employer.roster.update',$roster->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label">Employee<span class="text-danger">*</span></label>
                                <select class="form-control"  class="form-control @if ($errors->has('employee')) is-invalid @endif" name="employee" disabled onChange="salaryType(this)" >
                                    <option value="">--SELECT--</option>
                                    @foreach ($users as $user )
                                    <option value="{{$user['id']}}" data-salaryType="{{$user['salary_type']}}" {{$roster->user_id == $user['id'] ? 'selected':''}}>{{$user['first_name']." " . $user['last_name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('employee') }}</div>
                                </div>
                        </div><!-- Col -->
                        <input type="hidden" name="employee" value="{{$roster->user_id}}">
                            <!-- <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label">Business<span class="text-danger">*</span></label>
                            <select class="form-control"  class="form-control @if ($errors->has('business')) is-invalid @endif" name="business" value="{{ old('business') }}">
                                <option value="">--SELECT--</option>
                                @foreach ($businesses as $business)
                                <option value="{{$business['id']}} " {{ $roster->business_id == $business['id'] ? 'selected': ''}}>{{$business['name']}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('business') }}</div>
                        </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Department<span class="text-danger">*</span></label>
                                <select class="form-control"  class="form-control @if ($errors->has('department')) is-invalid @endif" name="department" value="{{ old('department') }}">
                                    <option value="">--SELECT--</option>
                                    @foreach ($departments as $department)
                                    <option value="{{$department['id']}}" {{ $roster->department_id == $department['id'] ? 'selected':'' }}>{{$department['dep_name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('department') }}</div>
                            </div>
                        </div> -->

                        </div><!-- Row -->
                        @if ($roster->user!=null)
                        @if(isset($roster->user->salary_type) == 0)
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Start Time <span class="text-danger">*</span></label>
                                    <input type="time"
                                        class="form-control @if ($errors->has('start_time')) is-invalid @endif"
                                        name="start_time" value="{{ old('start_time',$roster->start_time) }}">
                                    <div class="invalid-feedback">{{ $errors->first('start_time') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">End Time <span class="text-danger">*</span></label>
                                    <input type="time"
                                        class="form-control @if ($errors->has('end_time')) is-invalid @endif"
                                        name="end_time" value="{{ old('end_time',$roster->end_time) }}">
                                    <div class="invalid-feedback">{{ $errors->first('end_time') }}</div>
                                </div>
                            </div><!-- Col -->
                            
                        </div><!-- Row -->
                        @endif
                        @endif

                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Start Date <span class="text-danger">*</span></label>
                                    <input type="date"
                                        class="form-control @if ($errors->has('start_date')) is-invalid @endif"
                                        name="start_date" value="{{ old('start_date',$roster->start_date) }}" >
                                    <div class="invalid-feedback">{{ $errors->first('start_date') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">End Date<span class="text-danger">*</span></label>
                                    <input type="date"
                                        class="form-control @if ($errors->has('end_date')) is-invalid @endif"
                                        name="end_date" value="{{ old('end_date',$roster->end_date) }}">
                                    <div class="invalid-feedback">{{ $errors->first('end_date') }}</div>
                                </div>
                            </div><!-- Col -->
                            
                        </div><!-- Row -->


                        @if($roster->user->salary_type == 1)
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
                                            <?php list($mon_start, $mon_end) = explode('/', $roster->mon); ?>
                                            <td><input type="time" class="form-control" id="mon_start" value="{{ $mon_start }}" name="mon_start"></td>
                                            <td><input type="time" class="form-control" id="mon_end" value="{{ $mon_end }}" name="mon_end"></td>
                                        </tr>
                                        <tr>
                                            <td>Tuesday</td>
                                            <?php list($tue_start, $tue_end) = explode('/', $roster->tue); ?>
                                            <td><input type="time" class="form-control" id="tue_start" value="{{ $tue_start }}" name="tue_start"></td>
                                            <td><input type="time" class="form-control" id="tue_end" value="{{ $tue_end }}" name="tue_end"></td>
                                        </tr>
                                        <tr>
                                            <td>Wednesday</td>
                                            <?php list($wed_start, $wed_end) = explode('/', $roster->wed); ?>
                                            <td><input type="time" class="form-control" id="wed_start" value="{{ $wed_start }}" name="wed_start"></td>
                                            <td><input type="time" class="form-control" id="wed_end" value="{{ $wed_end }}" name="wed_end"></td>
                                        </tr>
                                        <tr>
                                            <td>Thursday</td>
                                            <?php list($thu_start, $thu_end) = explode('/', $roster->thu); ?>
                                            <td><input type="time" class="form-control" id="thu_start" value="{{ $thu_start }}" name="thu_start"></td>
                                            <td><input type="time" class="form-control" id="thu_end" value="{{ $thu_end }}" name="thu_end"></td>
                                        </tr>
                                        <tr>
                                            <td>Friday</td>
                                            <?php list($fri_start, $fri_end) = explode('/', $roster->fri); ?>
                                            <td><input type="time" class="form-control" id="fri_start" value="{{ $fri_start }}" name="fri_start"></td>
                                            <td><input type="time" class="form-control" id="fri_end" value="{{ $fri_end }}" name="fri_end"></td>
                                        </tr>
                                        <tr>
                                            <td>Saturday</td>
                                            <?php list($sat_start, $sat_end) = explode('/', $roster->sat); ?>
                                            <td><input type="time" class="form-control" id="sat_start" value="{{ $sat_start }}" name="sat_start"></td>
                                            <td><input type="time" class="form-control" id="sat_end" value="{{ $sat_end }}" name="sat_end"></td>
                                        </tr>
                                        <tr>
                                            <td>Sunday</td>
                                            <?php list($sun_start, $sun_end) = explode('/', $roster->sun); ?>
                                            <td><input type="time" class="form-control" id="sun_start" value="{{ $sat_start }}" name="sun_start"></td>
                                            <td><input type="time" class="form-control" id="sun_end" value="{{ $sat_end }}" name="sun_end"></td>
                                        </tr>
                                    </tbody>
                            </table>
                        </div><!-- Row -->

                        @endif
                        


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
@endpush
