<div class="table-responsive">
<table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Project</th>
                                    {{--<th>Branch</th>
                                    <th>Business</th>
                                    <th>Description</th>--}}
                                    <th>Expense From</th>
                                    <th>Expense To</th>
                                    <th>Budget</th>
                                    <th>Total Expense</th>
                                    <th>Remaining Budget</th>

                                 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $project->name  }}</td>
                                        {{--<td>{{ optional($project->branch)->name ?? 'no data' }}</td>
                                        <td>{{ optional($project->business)->name ?? 'no data' }}</td>
                                        <td>{{ $project->description}}</td>--}}
                                        {{--<td>{{$project->start_date}}</td>--}}
                                        <td> {{ optional($project)->start_date ? \Carbon\Carbon::parse(optional($project)->start_date)->format('d/m/Y') : 'no data' }}</td>
                                        {{--<td>{{optional($project->projectExpenses)->max('date') ?? 'no data'}}</td>--}}
                                        <td> {{ optional($project->projectExpenses)->max('date') ? \Carbon\Carbon::parse(optional($project->projectExpenses)->max('date'))->format('d/m/Y') : 'no data' }}</td>
                                        
                                        <td>@isset($project->budget)
                                            ${{number_format($project->budget,2)}}
                                        @endisset</td>
                                        <td>@isset($project->total_expense)
                                            ${{number_format($project->total_expense,2)}}
                                            @else
                                           no data
                                           @endisset
                                        </td>
                                        <td>@isset($project->total_expense)
                                           ${{number_format($project->budget - $project->total_expense,2)}}
                                           @else
                                           no data
                                        @endisset
                                        </td>
                                        
                                       
                                        
                                        
                                
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
</div>
