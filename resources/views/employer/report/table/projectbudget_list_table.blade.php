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
                                        
                                       
                                        
                                        
                                
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
</div>
