<div class="form-group">
                                        <label class="control-label">Business<span class="text-danger"></span></label>
                                        <select name="business" id="business1" class="@if ($errors->has('business')) is-invalid @endif">
                                            <option selected="true" value="">-SELECT-</option>
                                            <option value="0">All Business</option>
                                            @foreach($businesses as $business)
                                            <option value="{{$business->id}}">{{$business->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">{{ $errors->first('business') }}</div>
                                    </div>
                                    <div class="form-group" id="branch_div">
                                        <label class="control-label">Branch<span class="text-danger"></span></label>
                                        <select name="branch" id="branch1" class="@if ($errors->has('branch')) is-invalid @endif">
                                            <option selected="true" value="">-SELECT-</option>
                                            <option value="0">All Branch</option>
                                            @foreach($branches as $branch)
                                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">{{ $errors->first('branch') }}</div>
                                    </div>
                                    <div class="form-group" id="department_div">
                                        <label class="control-label">Department<span class="text-danger"></span></label>
                                        <select name="department" id="department" class="@if ($errors->has('department')) is-invalid @endif">
                                            <option selected="true" value="">-SELECT-</option>
                                            <option value="0">All Department</option>
                                            @foreach($departments as $department)
                                            <option value="{{$department->id}}">{{$department->dep_name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">{{ $errors->first('department') }}</div>
                                    </div>
                                    <div class="form-group" id="user_div">
                                        <label for="reply_message">User</label>
                                        <select name="employee_id" id="user">
                                            <option disabled="disabled" selected>Select User</option>
                                            @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->first_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>