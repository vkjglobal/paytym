@extends('employer.layouts.app')
@section('content')
    {{-- @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent --}}
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">User name</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Files</th>
                                    <th>Filename</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form method="POST" class="form-control" enctype="multipart/form-data" action="{{route('employer.uploads.store')}}">@csrf 
                                    <input type="hidden" name="userid" value="{{$id}}">
                                    @if(!$ups)
                                    <tr>
                                        <td>{{ 'Contract' }}</td>
                                        <td><input type="file" name="contract" ></td>
                                    </tr>
                                    <tr>
                                        <td>{{ 'Employment Letter' }}</td>
                                        <td><input type="file" name="employment" id=""></td>
                                    <tr>
                                        <td>{{ 'Termination Letter' }}</td>
                                        <td><input type="file" name="termination" id=""></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <button name="submit" type="submit" value=""><span class="btn btn-success">ADD</span></button>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td>{{ 'Contract' }}</td>
                                        <td>@if($ups->contracts){{$ups->contracts}}@else {{'No file'}}@endif</td>
                                    </tr>
                                    <tr>
                                        <td>{{ 'Employment Letter' }}</td>
                                        <td>@if($ups->employment_letter){{$ups->employment_letter}}@else {{'No file'}}@endif</td>
                                    <tr>
                                        <td>{{ 'Termination Letter' }}</td>
                                        <td>@if($ups->termination_letter){{$ups->termination_letter}}@else {{'No file'}}@endif</td>
                                    </tr>
                                    @endif
                                </form>
                                @if($ups)
                                <tr>
                                    <td>
                                        <form method="GET" action="{{route('employer.uploads.edit', $id)}}">
                
                                            <button name="managefile" type="submit" value="{{$id}}"><span class="btn btn-warning">UPDATE HERE</span></button>
        
                                        </form>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom_css')
    <link rel="stylesheet" href="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
@endpush
@push('custom_js')
    <script src="{{ asset('admin_assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin_assets/js/data-table.js') }}"></script>
@endpush
