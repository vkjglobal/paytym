    let token = "{{csrf_token()}}";
    (function($) {
        $('#country').change(function(e) {
            var id = $(this).val();
            $("#wbc_details").hide();
            $("#bank_details").hide();
            
            
            $('#bank').find('option').remove();
                $.ajax({
                    type: 'get',
                    url: '/employer/report/employment_period/get_bank/' + id,
                    dataType: 'json',
                    success: function(response) {
                        var len = 0;
                        if (response != null) {
                            len = response['data'].length;
                        }
                        if (len > 0) {
                            $("#bank_div").show();
                            var option1="<option value=''>--Choose Bank--</option>";
                            $('#bank').append(option1);
                            for (var i = 0; i < len; i++) {
                                var id = response['data'][i].id;
                                var name = response['data'][i].bank_name;
                                var option = "<option value='" + id + "'>" + name + "</option>";
                                $('#bank').append(option);
                            }
                        }
                    }
                });
        });


        $('#bank').change(function(e) {
            $("#bank_details").show();
            var id = $(this).val();
            var selectedOption = $("#bank option:selected");
            var selectedText = selectedOption.text();
            if(selectedText=='WBC' || selectedText=='Westpac')
            {
                $("#wbc_details").show();
            }
            else
            {
                $("#wbc_details").hide();
                $("#company_name").val("");
                $("#account_number").val("");
                $("#batch_no").val("");

            }
            
        });
 

    })(jQuery);
