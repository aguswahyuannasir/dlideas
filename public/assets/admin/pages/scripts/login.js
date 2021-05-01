var Login = function() {

    var handleLogin = function() {

        $('.login-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                username: {
                    required: true
                },
                password: {
                    required: true
                },
                captcha: {
                    required: true
                },
                remember: {
                    required: false
                }
            },

            messages: {
                username: {
                    required: "Username harus di isi."
                },
                password: {
                    required: "Password harus di isi."
                },
                captcha: {
                    required: "Captcha harus di isi."
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   
                $('.alert-danger', $('.login-form')).show();
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: form_submit
        });

        $('.login-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.login-form').validate().form()) {
                    form_submit();
                }

                return false;
            }
        });

        function form_submit()
        {
            $('.login-form').submit(function (e) {
                var data = $(this).serialize();
                var url = $(this).attr('action');

                Metronic.blockUI({
                    target: '.content',
                    animate: true
                });

                $.post(url, data, function (res) {
                    if(res.status == 1){

                    }
                }, 'json');

                return false;
            })
        }
    }

    return {
        //main function to initiate the module
        init: function() {

            handleLogin();

        }

    };

}();