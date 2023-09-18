@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    @if(session('message'))
    <div class="alert alert-light">
        {{ session('message') }}
    </div>
@endif
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Projects</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Project</th>
                                    <th>Branch</th>
                                    <th>Business</th>
                                    <th>Description</th>
                                    <th>Budget</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $project->name  }}</td>
                                        <td>{{ optional($project->branch)->name ?? 'no data' }}</td>
                                        <td>{{ optional($project->business)->name ?? 'no data' }}</td>
                                        <td>{{ $project->description}}</td>
                        
                                        
                                        <td>@isset($project->budget)
                                            {{ $project->budget}}
                                        @endisset</td>
                                        
                                       
                                        
                                        <td>
                                            <input data-id="{{ $project->id }}" class="toggle-class" type="checkbox"
                                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="Active" data-off="InActive"
                                                {{ $project->status ? 'checked' : '' }}>

                                                @if ($project->end_date < now())
                                                <button onclick="showAlert()" class="btn btn-primary" >View Expense</button>
                                                @else
                                                <a href="{{ route('employer.calculate_project_expense', ['id' => $project->id]) }}" type="button" class="btn btn-primary">View Expense</a>
                                                @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <!-- Edit button -->
                                                <a href="{{ route('employer.project.edit', $project->id) }}"
                                                    class="mr-1 text-warning" data-toggle="tooltip" data-placement="top"
                                                    title="Edit">
                                                    <i data-feather="edit"></i>
                                                </a>

                                                <!-- Delete button -->
                                                <button type="button" class="text-danger"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                                        document.getElementById('delete-data-{{ $project->id }}').submit();}"
                                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i data-feather="trash"></i>
                                                </button>
                                                <form id="delete-data-{{ $project->id }}"
                                                    action="{{ route('employer.project.destroy', $project->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                            </div>
                                        </td>
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
    <script>
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var project_id = $(this).data('id');
                console.log(project_id);

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('employer.project.change.status') }}',
                    data: {
                        'status': status,
                        'project_id': project_id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        })
    </script> 
    <script>
    function showAlert() {
    alert("Project has ended. Expenses can no longer be viewed.");
}
</script>
@endpush