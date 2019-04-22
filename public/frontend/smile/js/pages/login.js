$('#form-login').validate();
$('#form-register').validate({
    rules: {
        email: {
        remote: {
            url: SITE_URL + '/register/check',
            type: 'post',
            data: {
                    email: function() { return $('#form-register input[name="email"]').val()},
                    _token : function() { return $('meta[name="csrf-token"]').attr('content')},
                  }
              },
          },
        retype_password: {
          equalTo: '#form-register [name="password"]'
        }
    },

    messages: {
        email: {
            remote: '{0} has been used'
        },
        retype_password: {
            equalTo: 'Password not match'
        }
    }
});