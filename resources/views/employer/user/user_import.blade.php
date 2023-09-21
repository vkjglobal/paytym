@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Import Employees</h6>
                    {{--<form action="{{(route('employer.payslip.store'))}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-md-6">
                        <label for="logo">Logo</label>
                        <input type="file" name="logo"  class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="template">Template</label>
                        <select name="template"  class="form-control">
                            <option value="default">Default</option>
                        </select>
                    </div>
                    <input type="hidden" name="business_id" value={{$id}}>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>--}}

                <div class="row mt-4">
                        <div class="col-sm-4">
                            
                            <form method="POST" action="{{ route('employer.attendance.csvfile') }}" enctype="multipart/form-data">
                                @csrf
                                <h6 class="card-title mt-3">Upload a CSV file</h6> 
                                <input type="file" name="csvfile" class="mt-2">
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
                    <h6 class="card-title">Download CSV Template</h6>
                    {{--<div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Template</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Default</td>
                                        <td><a href="{{route('employer.payslip.view.default')}}" class="btn btn-primary">Preview</a></td>
                                        
                                       
                                    </tr>
                            </tbody>
                        </table>
                    </div>--}}
                    <form method="POST" action="{{ route('employer.attendance.csvfile') }}" enctype="multipart/form-data">
                                @csrf
                                <h6 class="card-title mt-3"></h6> 
                                
                                <button type="submit" class="btn btn-primary submit mt-3">Download Template</button>
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
