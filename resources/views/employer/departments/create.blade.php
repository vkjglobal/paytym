@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Create Department</h6>
                    <form method="POST" action="{{ route('admin.employers.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Department name <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('company')) is-invalid @endif"
                                        name="name" value="{{ old('name') }}" placeholder="Enter Department name"
                                        required>
                                    <div class="invalid-feedback">{{ $errors->first('company') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">&nbsp Select Branch <span class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                                <select class="form-select" aria-label="">
                                                    @foreach ($branches as $branch )
                                                    <option name="id" value="{{$branch->id}}">{{$branch->name}}</option>
                                                    @endforeach
                                                    </select>
                                            </div>
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
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
