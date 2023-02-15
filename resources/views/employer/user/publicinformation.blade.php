<table width="100%"><tr><td><div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">First Name <span class="text-danger">-</span></label>
                                   {{ $user->first_name}}
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Last Name <span class="text-danger">-</span></label>
                                    {{ $user->last_name}}
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Email <span class="text-danger">-</span></label>
                                    {{ $user->email}}
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Phone Number <span class="text-danger"> -</span></label>
                                    {{ $user->phone}}
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Date Of Birth<span class="text-danger"> -</span></label>
                                    {{ $user->date_of_birth}}
                                </div>
                            </div><!-- Col -->
                           <!--  <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Street <span class="text-danger"> </span></label>
                                    
                                </div>
                            </div> --><!-- Col -->
                        </div><!-- Row -->

                        <div class="row">   
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Address<span class="text-danger"> - </span></label>
                                    {{ $user->street}},{{ $user->town}},{{ $user->city}},{{ $user->postcode}}
                                      
                                    
                                </div>
                            </div><!-- Col -->
                            <!-- <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Town<span class="text-danger"> *</span></label>
                                   
                                </div>
                            </div> --><!-- Col -->
                            <!-- <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Post Code <span class="text-danger"> *</span></label>
                                    
                                </div>
                            </div> --><!-- Col -->
                        </div><!-- Row -->

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Country <span class="text-danger"> - </span></label>
                                    {{ $user->country}}
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Tin<span class="text-danger"> - </span></label>
                                    {{ $user->tin}}
                                </div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">FNPF<span class="text-danger"> - </span></label>
                                    {{ $user->fnpf}}
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Position<span class="text-danger"> - </span></label>
                                    {{ $user->role_name}}
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Employment start date<span class="text-danger"> - </span></label>
                                    {{ $user->fnpf}}
                                </div>
                            </div><!-- Col --><!-- Col -->
                        </div><!-- Row --></td></tr></table>