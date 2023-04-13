@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                        <h6 class="card-title float-left m-2">Check in and Check out time</h6>
                        <button name="edit" type="submit" value="" class="btn btn-success m-3 float-right" title="edit"
                             data-toggle="modal" data-target="#addtime">
                                Edit
                        </button>

                        <!-- Update Modal -->
                                <div class="modal fade" id="addtime" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit time</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('employer.checkinout.update', $check_in_out_time) }}">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="reply_message">Check in time</label>
                                                    <input type="time" class="form-control" name="check_in_time"  
                                                    value="{{old('check_in_time', $check_in_time)}}" required>
                                                    <div class="invalid-feedback">{{ $errors->first('check_in_time') }}</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="reply_message">Check out time</label>
                                                    <input type="time" class="form-control" name="check_out_time"  
                                                    value="{{old('check_out_time', $check_out_time)}}" required>
                                                    <div class="invalid-feedback">{{ $errors->first('check_in_time') }}</div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Update Modal Ends -->
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">

                            <tbody>
                                <tr>
                                    <th>Check in time</th>
                                    <th>@isset($check_in_time)
                                        {{ $check_in_time }}
                                    @endisset</th>
                                </tr>    
                                    <tr>
                                        <th>Check out time</th>
                                        <th>@isset($check_out_time)
                                            {{ $check_out_time }}
                                        @endisset</th>
                                    </tr>
                      
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