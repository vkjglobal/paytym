@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                   {{-- <h6 class="card-title"> Create Card</h6>--}}
                    <form method="POST" action="{{ route('employer.cards.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                <h3 class="card-title"><u>Primary Card Details</u></h3>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Card Number <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('primary_card_number')) is-invalid @endif"
                                        name="primary_card_number" value="{{ old('primary_card_number') }}" placeholder="Enter Card Number" required>
                                    <div class="invalid-feedback">{{ $errors->first('primary_card_number') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Name on Card <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('primary_name_on_card')) is-invalid @endif"
                                        name="primary_name_on_card" value="{{ old('primary_name_on_card') }}" placeholder="Enter Card Name" required>
                                    <div class="invalid-feedback">{{ $errors->first('primary_name_on_card') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                     
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Expiry Date<span class="text-danger">*</span></label>
                                    <input type="text" id="dateInput" pattern="(0[1-9]|1[0-2])/\d{4}"
                                        class="form-control @if ($errors->has('primary_expiry_date')) is-invalid @endif"
                                        name="primary_expiry_date" value="{{ old('primary_expiry_date') }}" placeholder="MM/YYYY" required>
                                        <span id="dateError" style="color: red;"></span>
                                        {{-- <input type="date"
                                        class="form-control @if ($errors->has('expiry_date')) is-invalid @endif"
                                        name="expiry_date" value="{{ old('expiry_date') }}" placeholder="Choose Expiry Date" required>--}}
                                    <div class="invalid-feedback">{{ $errors->first('primary_expiry_date') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                    </div>
                </div>
            </div>
                        
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                <h3 class="card-title"><u>Secondary Card Details</u></h3>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Card Number <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('secondary_card_number')) is-invalid @endif"
                                        name="secondary_card_number" value="{{ old('secondary_card_number') }}" placeholder="Enter Card Number" required>
                                    <div class="invalid-feedback">{{ $errors->first('secondary_card_number') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Name on Card <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('secondary_name_on_card')) is-invalid @endif"
                                        name="secondary_name_on_card" value="{{ old('secondary_name_on_card') }}" placeholder="Enter Card Name" required>
                                    <div class="invalid-feedback">{{ $errors->first('secondary_name_on_card') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                     
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Expiry Date<span class="text-danger">*</span></label>
                                    <input type="text" id="dateInput1" pattern="(0[1-9]|1[0-2])/\d{4}"
                                        class="form-control @if ($errors->has('secondary_expiry_date')) is-invalid @endif"
                                        name="secondary_expiry_date" value="{{ old('secondary_expiry_date') }}" placeholder="MM/YYYY" required>
                                        <span id="dateError1" style="color: red;"></span>
                                        {{--<input type="date"
                                        class="form-control @if ($errors->has('expiry_date')) is-invalid @endif"
                                        name="expiry_date" value="{{ old('expiry_date') }}" placeholder="Choose Expiry Date" required>--}}
                                    <div class="invalid-feedback">{{ $errors->first('secondary_expiry_date') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->

                       

                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label>
                                Set Primary Card as Default : <br>
                                <input type="radio" name="primary_is_default" value="1" checked> Yes
                                    <input type="radio" name="primary_is_default" value="0"> No
                                </label><br>

                                <label>Set Secondary Card as Default : <br>
                                <input type="radio" name="secondary_is_default" value="1"> Yes
                                <input type="radio" name="secondary_is_default" value="0" checked> No

                                </label>
                                </div>
                                <button type="submit" class="btn btn-primary submit">Submit</button>
                    </form>
                            </div><!-- Col -->
                        </div><!-- Row -->
</div></div></div>

    </div>
@endsection
@push('custom_js')
    <script src="{{ asset('admin_assets/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/tinymce.js') }}"></script>
    <script>
$(document).ready(function () {
    $('input[name="primary_is_default"]').change(function () {
        if ($(this).val() === '1') {
            $('input[name="secondary_is_default"][value="0"]').prop('checked', true);
        } else if ($(this).val() === '0') {
            $('input[name="secondary_is_default"][value="1"]').prop('checked', true);
        }
    });

    $('input[name="secondary_is_default"]').change(function () {
        if ($(this).val() === '1') {
            $('input[name="primary_is_default"][value="0"]').prop('checked', true);
        } else if ($(this).val() === '0') {
            $('input[name="primary_is_default"][value="1"]').prop('checked', true);
        }
    });
});
</script>
<script>
    const dateInput = document.getElementById('dateInput');
    const dateError = document.getElementById('dateError');

    dateInput.addEventListener('input', function () {
        const isValid = this.checkValidity();
        dateError.textContent = isValid ? '' : 'Please enter a valid date in mm/YYYY format.';
    });
</script>

<script>
    const dateInput1 = document.getElementById('dateInput1');
    const dateError1 = document.getElementById('dateError1');

    dateInput1.addEventListener('input', function () {
        const isValid = this.checkValidity();
        dateError1.textContent = isValid ? '' : 'Please enter a valid date in mm/YYYY format.';
    });
</script>
@endpush
