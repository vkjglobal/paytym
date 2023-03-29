@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Files</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>File Type</th>
                                    <th>File</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <a href="{{route('employer.upload.form',$id)}}" class="btn btn-success">Add File</a><br><br>
                            <tbody>
                                @foreach ($ups as $up)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ optional($up->filetype)->file_type ?? 'no data' }}</td>
                                        <td>{{basename($up->file)}}</td>
                                        <td> <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{route('employer.upload.download',$up->id)}}" class="btn btn-primary">Download</a>

                                              <!-- Edit button -->
                                              <a href="{{ route('employer.uploads.edit', $up->id) }}"
                                                    class="mr-1 text-warning ml-2" data-toggle="tooltip" data-placement="top"
                                                    title="Edit">
                                                    <i data-feather="edit"></i>
                                                </a>

                                            <!-- Delete button -->
                                            <button type="button" class="text-danger ml-2"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                                        document.getElementById('delete-data-{{ $up->id }}').submit();}"
                                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i data-feather="trash"></i>
                                                </button>
                                                <form id="delete-data-{{ $up->id }}"
                                                    action="{{ route('employer.uploads.destroy', $up->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form></div></td>
                                    </tr>
                                @endforeach
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
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endpush
@push('custom_js')
    <script src="{{ asset('admin_assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin_assets/js/data-table.js') }}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
   
@endpush