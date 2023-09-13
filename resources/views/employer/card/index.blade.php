@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                   {{-- <h6 class="card-title"> Create Card</h6>--}}
                    <form method="POST" action="{{ route('employer.cards.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                <h3 class="card-title"><u>Primary Card Details</u></h3>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Card Number : <span class="text-danger"></span></label>
                                    {{ optional($card)->primary_card_number ?? 'No data' }}
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Name on Card : <span class="text-danger"></span></label>
                                    {{ optional($card)->primary_name_on_card ?? 'No data' }}
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                     
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Expiry Date : <span class="text-danger"></span></label>
                                    {{ optional($card)->primary_expiry_date ?? 'No data' }}
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                    </div>
                </div>
            </div>
                        
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                <h3 class="card-title"><u>Secondary Card Details</u></h3>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Card Number : <span class="text-danger"></span></label>
                                    {{ optional($card)->secondary_card_number ?? 'No data' }}
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Name on Card : <span class="text-danger"></span></label>
                                    {{ optional($card)->secondary_name_on_card ?? 'No data' }}
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                     
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Expiry Date : <span class="text-danger"></span></label>
                                    {{ optional($card)->secondary_expiry_date ?? 'No data' }}
                                    
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->

                       

                </div>
            </div>
        </div>
        @if(isset($card))
        <div class="col-md-12 mt-3 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    @if($card->primary_is_default ==1)
                                    <strong>Your default card is your Primary Card.</strong>
                                    @else
                                    <strong>Your default card is your Secondary Card.</strong>
                               @endif
                                </div>
                                {{--<button type="submit" class="btn btn-primary submit">Update Cards</button>--}}
                                <a href="{{ route('employer.cards.edit', ['card' => $card->id]) }}" type="button" class="btn btn-primary">Update Cards</a>
                    </form>
                            </div><!-- Col -->
                        </div><!-- Row -->
</div></div></div>
@else
<div class="col-md-12 mt-3 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                            <div class="col-sm-6">
                                <a href="{{ route('employer.cards.create')}}" type="button" class="btn btn-primary">Create Card</a>
                            </div><!-- Col -->
                        </div><!-- Row -->
</div></div></div>
@endif

    </div>

    {{--<div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Cards</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Card Type</th>
                                    <th>Card Number</th>
                                    <th>Valid till</th>
                                    <th>Name</th>
                                   <!--  <th>Status</th> -->
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($card as $card)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $card->card_type }}</td>
                                        <td>{{ $card->card_number }}</td>
                                        <td>{{ $card->expiry_date }}</td>
                                        <td>{{ $card->name_on_card}}</td>
                                     <!--    <td>
                                            <input data-id="{{ $card->id }}" class="toggle-class" type="checkbox"
                                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="Active" data-off="InActive"
                                                {{ $card->status ? 'checked' : '' }}>
                                        </td> -->
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <!-- Edit button -->
                                                <a href="{{ route('employer.cards.edit', $card->id) }}"
                                                    class="mr-1 text-warning" data-toggle="tooltip" data-placement="top"
                                                    title="Edit">
                                                    <i data-feather="edit"></i>
                                                </a>

                                                <!-- Delete button -->
                                                <button type="button" class="text-danger"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                                        document.getElementById('delete-data-{{ $card->id }}').submit();}"
                                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i data-feather="trash"></i>
                                                </button>
                                                <form id="delete-data-{{ $card->id }}"
                                                    action="{{ route('employer.cards.destroy', $card->id) }}"
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
    </div>--}}

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
                var department_id = $(this).data('id');
                console.log(department_id);

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('employer.department.change.status') }}',
                    data: {
                        'status': status,
                        'department_id': department_id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        })
    </script>
@endpush