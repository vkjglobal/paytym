@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                   {{-- <h6 class="card-title"> Update Card</h6>--}}
                    <form method="POST" action="{{ route('employer.cards.update', $card->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
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
                                        name="primary_card_number" value="{{ old('primary_card_number',$card->primary_card_number) }}" placeholder="Enter Card Number" required>
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
                                        name="primary_name_on_card" value="{{ old('primary_name_on_card',$card->primary_name_on_card) }}" placeholder="Enter Card Name" required>
                                    <div class="invalid-feedback">{{ $errors->first('primary_name_on_card') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                     
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Expiry Date<span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('primary_expiry_date')) is-invalid @endif"
                                        name="primary_expiry_date" value="{{ old('primary_expiry_date', $card->primary_expiry_date) }}" placeholder="MM/YYYY" required>
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
                                        name="secondary_card_number" value="{{ old('secondary_card_number',$card->secondary_card_number) }}" placeholder="Enter Card Number" required>
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
                                        name="secondary_name_on_card" value="{{ old('secondary_name_on_card',$card->secondary_name_on_card) }}" placeholder="Enter Card Name" required>
                                    <div class="invalid-feedback">{{ $errors->first('secondary_name_on_card') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                     
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Expiry Date <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('secondary_expiry_date')) is-invalid @endif"
                                        name="secondary_expiry_date" value="{{ old('secondary_expiry_date',$card->secondary_expiry_date) }}" placeholder="MM/YYYY" required>
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
                                <input type="radio" name="primary_is_default" value="1" {{ $card->primary_is_default == 1 ? 'checked' : '' }}> Yes
                                    <input type="radio" name="primary_is_default" value="0" {{ $card->primary_is_default == 0? 'checked' : '' }}> No
                                </label><br>

                                <label>Set Secondary Card as Default : <br>
                                <input type="radio" name="secondary_is_default" value="1" {{ $card->secondary_is_default == 1 ? 'checked' : '' }}> Yes
                                <input type="radio" name="secondary_is_default" value="0" {{ $card->secondary_is_default == 0? 'checked' : '' }}> No

                                </label>


        {{--   <input type="radio" name="default_card" value="primary" {{ $card->primary_is_default ? 'checked' : '' }}>
        Set Primary Card as Default
    </label><br>

    <label>
        <input type="radio" name="default_card" value="secondary" {{ $card->secondary_is_default ? 'checked' : '' }}>
        Set Secondary Card as Default
    </label>

                             <input type="radio" name="default_card_type" value="0" {{ $card->primary_is_default == 1 ? 'checked' : '' }}> Male
                                        <input type="radio" name="default_card_type" value="1" {{ $card->primary_is_default == 0 ? 'checked' : '' }}> Female
                               
        <input type="radio" name="default_card_type" value="primary" <?php if($card->primary_is_default == 1){ echo "checked";} ?> > Set as Primary Default Card
   <br>

   
        <input type="radio" name="default_card_type" value="secondary" <?php if($card->secondary_is_default == 1){ echo "checked";} ?> > Set as Secondary Default Card
    <br>
    <input type="radio" name="default_card_type"  value="primary" 
                          {{ $card->primary_is_default == '1' ? 'checked' : '' }} >aa
    <label>
                                    <input type="radio" name="default_card_type" value="primary" checked> Set Primary Card as Default
                                </label><br>

                                <label>
                                    <input type="radio" name="default_card_type" value="secondary"> Set Secondary Card as Default
                                </label>--}}
                                   
                                                         
   
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

@endpush
