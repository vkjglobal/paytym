@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> Edit Deduction</h6>
                    <form method="POST" action="{{ route('employer.deduction.update',$deduction->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Deduction Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('name')) is-invalid @endif"
                                        name="name" value="{{ old('name',$deduction->name) }}" placeholder="Enter Branch Name" required>
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                </div>
                            </div><!-- Col -->
                            {{-- <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Amount<span class="text-danger">*</span></label>
                                    <input type="number"
                                        class="form-control @if ($errors->has('amount')) is-invalid @endif"
                                        name="amount" value="{{ old('amount',$deduction->amount) }}" placeholder="Enter Amount" required>
                                    <div class="invalid-feedback">{{ $errors->first('amount') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Percentage<span class="text-danger">*</span></label>
                                    <input type="number"
                                        class="form-control @if ($errors->has('percentage')) is-invalid @endif"
                                        name="percentage" value="{{ old('percentage',$deduction->percentage) }}"
                                        placeholder="Enter Percentage" required>
                                    <div class="invalid-feedback">{{ $errors->first('percentage') }}</div>
                                </div>
                            </div><!-- Col --> --}}
                        </div><!-- Row -->

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Description <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('description')) is-invalid @endif"
                                        name="description" value="{{ old('description',$deduction->description) }}" placeholder="Enter Description">
                                    <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                                </div>
                            </div><!-- Col -->
                            
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
@endpush
