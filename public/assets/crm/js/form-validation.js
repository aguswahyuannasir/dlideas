var FormValidation = function () {

    return {
        initDefault: function (form_target, rule, message, title, text) {
            
            rule = (typeof rule === "undefined") ? {} : rule;
            message = (typeof message === "undefined") ? {} : message;
            title = (typeof title === "undefined") ? "Apakah anda yakin?" : title;
            text = (typeof text === "undefined") ? "?" : text;
            
            var form_input = $(form_target);
            var form_confirm = form_input.attr('data-confirm');
            var error = $('.alert-danger', form_input);
            var warning = $('.alert-warning', form_input);
            var data = '';

            form_input.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: message,
                rules: rule,

                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.parent(".input-group").size() > 0) {
                        error.insertAfter(element.parent(".input-group"));
                    } else if (element.attr("data-error-container")) { 
                        error.appendTo(element.attr("data-error-container"));
                    } else if (element.parents('.radio-list').size() > 0) { 
                        error.appendTo(element.parents('.radio-list').attr("data-error-container"));
                    } else if (element.parents('.radio-inline').size() > 0) { 
                        error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
                    } else if (element.parents('.checkbox-list').size() > 0) {
                        error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
                    } else if (element.parents('.checkbox-inline').size() > 0) { 
                        error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    error.show();
                    Metronic.scrollTo(error, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label.closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {

                    $('.ckeditor').each(function (index, value) {
                        var $textarea = $(this);
                        $textarea.val(CKEDITOR.instances[$textarea.attr('name')].getData());
                    });
                    if(form_confirm == 1){ // Jika Form butuh konfirmasi
                        swal({
                            title: title,
                            text: text,
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: '#DD6B55',
                            confirmButtonText: 'Yes',
                            closeOnConfirm: true
                        },
                        function(){
                            Metronic.blockUI({
                                target: form_target,
                                animate: true
                            });

                            var options = { 
                                dataType:      'json',
                                success:       callback_form, // Callback jika form success
                                error:         callback_error // Callback jika form error
                            }; 

                            $(form).ajaxSubmit(options);
                        });
                    }else{
                        Metronic.blockUI({
                            target: form_target,
                            animate: true
                        });

                        var options = { 
                            dataType:      'json',
                            success:       callback_form, // Callback jika form success
                            error:         callback_error // Callback jika form error
                        }; 

                        $(form).ajaxSubmit(options);
                    }
                }
            });

            function callback_form(res, statusText, xhr, form) // Callback form success
            {
                if(res.status == 1){ // Jika respond status bernilai benar
                    warning.hide(); // Hilangkan Label Warning

                    toastr.options = call_toastr('4000'); // Panggil toastr
                    var $toast = toastr['success'](res.message, "Success");

                    if($('#reload', form).length) // Jika ada input reload
                    {
                        $('#reload', form).trigger('click'); // Reload
                    }

                    //reload table
                    reloadTable();

                }else if(res.status == 0 || res.status == 2){ // Error Validasi dll
                    warning.hide();

                    toastr.options = call_toastr('4000');
                    var $toast = toastr['error'](res.message, "Error");
                }else if(res.status == 3){ // Error gagal insert
                    warning.find('ul').html(res.message);
                    warning.show();
                    Metronic.scrollTo(warning, -200);
                }else if(res.status == 4){
                    swal({
                        title: 'Apakah anda yakin ?',
                        text: res.message,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'Yes',
                        closeOnConfirm: true
                    },
                    function(){
                        $('input[name="valid"]', form).val('1');
                        form.submit();
                    });
                }

                Metronic.unblockUI(form_target);
            }

            function callback_error(xhr, statusText, thrown){
                toastr.options = call_toastr('4000');
                var $toast = toastr['error']('Something wrong! Error ['+xhr.status+']', "Error");

                Metronic.unblockUI(form_target);
            }
        }

    };

}();