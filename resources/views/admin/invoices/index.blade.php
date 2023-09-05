@extends('admin.layouts.app')
@section('content')
    {{-- @component('admin.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent --}}

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Invoices</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Employer Name</th>
                                    <th>Plan</th>
                                    <th>Date</th>
                                    <th>Active Employess</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                  <th>Actions</th>  {{--  --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ optional($invoice->employer)->name ?? 'No data' }}</td>
                                        <td>{{ is_null($invoice->custom_plan_id) ? optional($invoice->plan)->plan ?? 'No data' : optional($invoice->custom_plan)->plan ?? 'No data' }}</td>
                                        <td>{{ isset($invoice) && isset($invoice->date) ? date('M-Y', strtotime($invoice->date)) : 'No data' }}</td>
                                        <td>{{ optional($invoice)->active_employees ?? 'No data' }}</td>
                                        <td>{{ optional($invoice)->amount ?? 'No data' }}</td>
                                        {{--<td><span class="btn btn-{{ optional($invoice)->status == '0' ? 'danger' : 'success' }}">{{ optional($invoice)->status == '0' ? 'Pending' : 'Paid' }}</span></td>--}}
                                        <td><span class="btn btn-{{ optional($invoice)->status == '0' ? 'secondary' :  (optional($invoice)->status == '1' ? 'success' : 'danger') }}">{{ optional($invoice)->status == '0' ? 'Pending' : (optional($invoice)->status == '1' ? 'Paid' : 'Overdue') }}</span></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                        <button name="approve" type="submit" value="1" title="Paid" data-toggle="modal" onclick="event.preventDefault(); if(confirm('Are you sure you want to change status to paid ?')){
                                                        document.getElementById('delete-data-{{ $invoice->id }}').submit();}">
                                                    <i data-feather="check" style="color:#4BB543;" ></i>
                                                </button>
    </div>
    </td>
                                        {{-- <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <!-- Edit button -->
                                                <button type="button" class="btn btn-outline-primary mr-3" data-toggle="modal"
                                                    data-target="#exampleModal">
                                                    Reply
                                                </button>

                                                <!-- Delete button -->
                                                <button type="button" class="text-danger"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                                    document.getElementById('delete-data-{{ $invoice->id }}').submit();}"
                                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i data-feather="trash"></i>
                                                </button>
                                                <form id="delete-data-{{ $invoice->id }}"
                                                    action="{{ route('admin.invoice.destroy', $invoice->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                            </div>
                                        </td> --}}
                                    </tr>

                                    {{-- <!-- Send Reply Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Invoices</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{ route('admin.contact') }}">
                                                    @csrf
                                                    <input type="hidden" name="email" value="{{ $contact->email }}">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="reply_message">Reply Message</label>
                                                            <textarea class="form-control" name="reply_message" rows="3" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Send Reply</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Send Reply Modal Ends --> --}}
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
@endpush
@push('custom_js')
    <script src="{{ asset('admin_assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin_assets/js/data-table.js') }}"></script>
@endpush
