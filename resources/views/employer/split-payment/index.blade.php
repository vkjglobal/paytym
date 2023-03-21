@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    {{-- <a href="Api/Employee/mpaisa">Mpaisa    </a> --}}
                    <h6 class="card-title">Split Payment Details</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Employee</th>
                                    <th>Payment System</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Status</th>  
                      
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($splitpayments as $splitpayment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        @isset($splitpayment->user->first_name)
                                            <td>{{ $splitpayment->user->first_name}}</td>
                                        @endisset
                                        @if($splitpayment->payment_wallet == 0)
                                            <td>Mycash</td>
                                        @elseif($splitpayment->status == 1)
                                            <td>Mpaisa</td>
                                        @else
                                            <td>BSP</td>
                                        @endif
                                        <td>{{ $splitpayment->amount}}</td>
                                        <td>{{ $splitpayment->created_at->format('Y-m-d')}}</td>
                                        @if($splitpayment->status == 0)
                                        <td><span class="btn btn-danger">Pending</span></td>
                                        @else
                                        <td><span class="btn btn-success">Success</span></td>
                                        @endif
                                        
                                        {{-- <td>{{ $splitpayment->end_date}}</td> --}}

                                        {{-- @if($splitpayment->status == 0)
                                        <td>
                                            <a href="#" class='btn btn-secondary'>
                                            &nbsp   Not Started &nbsp &nbsp
                                            </a>
                                        </td>
                                        @elseif($splitpayment->status == 1)
                                        <td>
                                            <a href="#" class='btn btn-success'>
                                            &nbsp &nbsp &nbsp  Started &nbsp &nbsp &nbsp &nbsp
                                            </a>
                                        </td>
                                        @else
                                        <td>
                                            <a href="#" class='btn btn-danger'>
                                                Not Completed &nbsp
                                            </a>
                                        </td>
                                        @endif
                                        
                                       
                                        
                                        <!-- <td>
                                            <input data-id="{{ $splitpayment->id }}" class="toggle-class" type="checkbox"
                                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="Active" data-off="InActive"
                                                {{ $splitpayment->status ? 'checked' : '' }}>
                                        </td> -->
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <!-- Edit button -->
                                                <a href="{{ route('employer.splitpayment.edit', $splitpayment->id) }}"
                                                    class="mr-1 text-warning" data-toggle="tooltip" data-placement="top"
                                                    title="Edit">
                                                    <i data-feather="edit"></i>
                                                </a>

                                                <!-- Delete button -->
                                                <button type="button" class="text-danger"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                                        document.getElementById('delete-data-{{ $splitpayment->id }}').submit();}"
                                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i data-feather="trash"></i>
                                                </button>
                                                <form id="delete-data-{{ $splitpayment->id }}"
                                                    action="{{ route('employer.splitpayment.destroy', $splitpayment->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                            </div>
                                        </td> --}}
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