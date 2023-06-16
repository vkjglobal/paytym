
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Company</th>
                                    <th>Contact Person</th>
                                    <th>Reg Date</th>
                                    <th>Company Phone</th>
                                    <th>Email</th>
                                    <th>Country</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employers as $employer)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $employer->company }}</td>
                                        <td>{{ $employer->name }}</td>
                                        <td>{{ date('d-m-Y', strtotime($employer->created_at)) }}</td>
                                        <td>{{ $employer->company_phone }}</td>
                                        <td>{{ $employer->email }}</td>
                                        <td>{{ isset($employer->country->name) ? $employer->country->name : 'No data found' }}</td>
                                        <td>
                                        <button data-id="{{ $employer->id }}" class="status-btn btn {{ $employer->status ? 'btn-success' : 'btn-danger' }} btn-fixed-width">
                                            {{ $employer->status ? 'Active' : 'Inactive' }}
                                        </button>

                                </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <!-- Edit button -->
                                                <a href="{{ route('admin.employers.edit', $employer->id) }}"
                                                    class="mr-1 text-warning" data-toggle="tooltip" data-placement="top"
                                                    title="Edit">
                                                    <i data-feather="edit"></i>
                                                </a>

                                                <!-- Delete button -->
                                                <button type="button" class="text-danger"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                                        document.getElementById('delete-data-{{ $employer->id }}').submit();}"
                                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i data-feather="trash"></i>
                                                </button>
                                                <form id="delete-data-{{ $employer->id }}"
                                                    action="{{ route('admin.employers.destroy', $employer->id) }}"
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
              