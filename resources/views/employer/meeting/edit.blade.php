@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> Edit Meeting</h6>
                    <form method="POST" action="{{ route('employer.meeting.update',$meeting->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Meeting Title <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('name')) is-invalid @endif"
                                        name="name" value="{{ old('name',$meeting->name) }}" placeholder="Enter Meeting Name" required>
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Location<span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('location')) is-invalid @endif"
                                        name="location" value="{{ old('location',$meeting->location) }}" placeholder="Enter Location" required>
                                    <div class="invalid-feedback">{{ $errors->first('location') }}</div>
                                </div>
                            </div><!-- Col -->
                           
                        </div><!-- Row -->

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Date <span class="text-danger">*</span></label>
                                    <input type="date"
                                        class="form-control @if ($errors->has('date')) is-invalid @endif"
                                        id="meeting_date" name="date" value="{{ old('date',$meeting->date) }}" min="{{ now()->toIso8601String() }}" placeholder="Choose Date" required>
                                    <div class="invalid-feedback">{{ $errors->first('date') }}</div>
                                </div>
                            </div><!-- Col -->
               
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Start Time <span class="text-danger">*</span></label>
                                    <input type="time"
                                        class="form-control @if ($errors->has('postcode')) is-invalid @endif"
                                        name="start_time" value="{{ old('start_time',$meeting->start_time) }}" placeholder="Choose Start Time" required>
                                    <div class="invalid-feedback">{{ $errors->first('start_time') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">End Time <span class="text-danger">*</span></label>
                                    <input type="time"
                                        class="form-control @if ($errors->has('end_time')) is-invalid @endif"
                                        name="end_time" value="{{ old('end_time',$meeting->end_time) }}" placeholder="Choose End Time" required>
                                    <div class="invalid-feedback">{{ $errors->first('end_time') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Agenda <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('agenda')) is-invalid @endif"
                                        name="agenda" value="{{ old('agenda',$meeting->agenda) }}" placeholder="Enter Agenda" required>
                                    <div class="invalid-feedback">{{ $errors->first('agenda') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Attendees <span class="text-danger"></span></label></br>
                                @foreach($attendees as $user)
                                                    <label>
                                                        <input type="checkbox" name="attendees[]" value="{{ $user->attendee_id }}" @if(in_array($user->attendee_id, $meetingAttendees)) checked @endif>
                                                        {{ $user->users->first_name }}
                                                        <input type="hidden" name="all_attendees[]" value="{{ $user->attendee_id }}">
                                                    </label>
                                                </br>
                                                @endforeach
                            </div>
                        </div><!-- Col -->
                        </div><!-- Row -->
                       @if($employees->count()>0)
                        <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Add new Attendees<span class="text-danger">*</span></label>
                                <select name="new_attendees[]" multiple>
                                    @foreach($employees as $user)
                                            <option value="{{ $user->id }}">{{ $user->first_name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('user') }}</div>
                            </div>
                        </div><!-- Col -->
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    const meetingDateInput = document.getElementById('meeting_date');

    meetingDateInput.addEventListener('input', function () {
        const selectedDateTime = new Date(this.value);
        const now = new Date();

        // Set the seconds and milliseconds to 0 for accurate comparison
        selectedDateTime.setSeconds(0);
        selectedDateTime.setMilliseconds(0);

        if (selectedDateTime < now) {
            this.setCustomValidity('Please choose a date in the future.');
        } else {
            this.setCustomValidity('');
        }
    });
</script>





<script>
    $(document).ready(function() {
        // Store the initial attendees from the database
        var initialAttendees = @json($meetingAttendees);

        // Handle checkbox changes
        $('input[name="attendees[]"]').change(function() {
            updateAttendees();
        });

        // Handle multiple select dropdown changes
        $('select[name="new_attendees[]"]').change(function() {
            updateAttendees();
        });

        function updateAttendees() {
            // Get the selected attendees from checkboxes and multiple select dropdown
            var selectedAttendees = $('input[name="attendees[]"]:checked').map(function() {
                return this.value;
            }).get();

            var newAttendees = $('select[name="new_attendees[]"]').val();

            // Merge the selected attendees from checkboxes and multiple select dropdown
            var allAttendees = selectedAttendees.concat(newAttendees);

            // Get the attendees to be removed (initial attendees not in the merged list)
            var attendeesToRemove = initialAttendees.filter(function(id) {
                return !allAttendees.includes(id);
            });

            // Update the hidden input with the list of attendees to be removed
            $('input[name="attendees_to_remove"]').val(JSON.stringify(attendeesToRemove));
        }
    });
</script>

@endpush
