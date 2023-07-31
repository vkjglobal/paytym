@extends('admin.layouts.app')
@section('content')
    @component('admin.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Employers</h6>
                    <div class="float-right mb-3">
                      
                          <button type="button" class="btn btn-primary btn-icon-text" onclick="window.location='{{route("admin.report.employer.export")}}'">
                            <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                            Download Report
                          </button> 
                    
                    </div>

<div id="employers_table">
    @include('admin.employers.employers_table')
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
    $('.status-btn').click(function(event) {
        event.preventDefault(); // prevent default action

        var status = $(this).hasClass('btn-success') ? 0 : 1;
        var employer_id = $(this).data('id');

        var confirmed = confirm("Are you sure you want to change the status?");
        if (confirmed) {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('admin.employer.change.status') }}',
                data: {
                    'status': status,
                    'employer_id': employer_id
                },
                success: function(data) {
                    console.log(data.success);
                    var newStatus = (status == 1) ? 'Active' : 'Inactive';
                    var newClass = (status == 1) ? 'btn-success' : 'btn-danger';
                    $(this).text(newStatus).removeClass('btn-success btn-danger').addClass(newClass);
                }.bind(this)
            });
        }
    });
});
</script>

@endpush
