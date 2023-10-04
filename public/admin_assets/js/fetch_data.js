    let token = "{{csrf_token()}}";
    (function($) {
        $('#business1').change(function(e) {
            var id = $(this).val();
            $('#branch1').find('option').not(':first').remove();
            if (id == 0) {
                $("#branch_div").hide();
                $("#department_div").hide();
                $("#user_div").hide();

            } else {
                $("#branch_div").show();
                $("#department_div").show();
                $("#user_div").show();

                
                $.ajax({
                    type: 'get',
                    url: '/employer/report/employment_period/get_branch/' + id,
                    dataType: 'json',
                    success: function(response) {
                        var len = 0;
                        if (response != null) {
                            len = response['data'].length;
                        }
                        if (len > 0) {
                            var option1="<option value='0'>All Branch</option>";
                            $('#branch1').append(option1);
                            for (var i = 0; i < len; i++) {
                                var id = response['data'][i].id;
                                var name = response['data'][i].name;
                                var option="<option value='" + id + "'>" + name + "</option>";
                                $('#branch1').append(option);
                            }
                        }
                    }
                });
            }
        });
        $('#branch1').change(function(e) {
            var id = $(this).val();
            $('#department').find('option').not(':first').remove();
            if (id == 0) {
                $("#department_div").hide();
                $("#user_div").hide();
            } else {
                $("#department_div").show();
                $("#user_div").show();
          
                $.ajax({
                    type: 'get',
                    url: '/employer/report/employment_period/get_department/' + id,
                    dataType: 'json',
                    success: function(response) {
                        var len = 0;
                        if (response != null) {
                            len = response['data'].length;
                        }
                        if (len > 0) {
                            var option1="<option value='0'>All Department</option>";
                            $('#department').append(option1);
                            for (var i = 0; i < len; i++) {
                                var id = response['data'][i].id;
                                var name = response['data'][i].dep_name;
                                var option = "<option value='" + id + "'>" + name + "</option>";
                                $('#department').append(option);
                            }
                        }
                    }
                });
            }
        });

        $('#department').change(function(e) {
            var id = $(this).val();
            $('#user').find('option').not(':first').remove();

            if (id == 0) {
                $("#user_div").hide();
            } else {
                $("#user_div").show();

        
                $.ajax({
                    type: 'get',
                    url: '/employer/report/employment_period/get_user/' + id,
                    dataType: 'json',
                    success: function(response) {
                        var len = 0;
                        if (response != null) {
                            len = response['data'].length;
                        }
                        if (len > 0) {
                            var option1="<option value='0'>All User</option>";
                            $('#user').append(option1);
                            for (var i = 0; i < len; i++) {
                                var id = response['data'][i].id;
                                var name = response['data'][i].first_name;
                                var option = "<option value='" + id + "'>" + name + "</option>";
                                $('#user').append(option);
                            }
                        }
                    }
                });
            }
        });

 

    })(jQuery);
