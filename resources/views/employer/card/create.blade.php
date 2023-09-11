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
                                        class="form-control @if ($errors->has('card_number')) is-invalid @endif"
                                        name="card_number" value="{{ old('card_number') }}" placeholder="Enter Card Number" required>
                                    <div class="invalid-feedback">{{ $errors->first('card_number') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Name on Card <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('name_on_card')) is-invalid @endif"
                                        name="name_on_card" value="{{ old('name_on_card') }}" placeholder="Enter Card Name" required>
                                    <div class="invalid-feedback">{{ $errors->first('name_on_card') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                     
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Expiry Date<span class="text-danger">*</span></label>
                                    <input type="date"
                                        class="form-control @if ($errors->has('expiry_date')) is-invalid @endif"
                                        name="expiry_date" value="{{ old('expiry_date') }}" placeholder="Choose Expiry Date" required>
                                    <div class="invalid-feedback">{{ $errors->first('expiry_date') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
</div></div></div>
                        
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
                                        class="form-control @if ($errors->has('card_number')) is-invalid @endif"
                                        name="card_number" value="{{ old('card_number') }}" placeholder="Enter Card Number" required>
                                    <div class="invalid-feedback">{{ $errors->first('card_number') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Name on Card <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('name_on_card')) is-invalid @endif"
                                        name="name_on_card" value="{{ old('name_on_card') }}" placeholder="Enter Card Name" required>
                                    <div class="invalid-feedback">{{ $errors->first('name_on_card') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                     
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Expiry Date<span class="text-danger">*</span></label>
                                    <input type="date"
                                        class="form-control @if ($errors->has('expiry_date')) is-invalid @endif"
                                        name="expiry_date" value="{{ old('expiry_date') }}" placeholder="Choose Expiry Date" required>
                                    <div class="invalid-feedback">{{ $errors->first('expiry_date') }}</div>
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
                                    <input type="radio" name="default_card_type" value="primary" checked> Set Primary Card as Default
                                </label><br>

                                <label>
                                    <input type="radio" name="default_card_type" value="secondary"> Set Secondary Card as Default
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
@endpush
