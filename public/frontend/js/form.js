$(document).ready(function(){

	// Jquery Validation
	$.extend(jQuery.validator.messages, {
	    required: 'This field is required.',
	    email: 'Please input correct email address.',
	    url: 'Worng URL format.',
	    date: 'Wrong date format.',
	    number: 'Input number only.',
	    maxlength: jQuery.validator.format('Can not more than {0} character.'),
	    minlength: jQuery.validator.format('Can not less than {0} character.'),
	    max: jQuery.validator.format('Value cannot more than {0}.'),
	    min: jQuery.validator.format('Value cannot less than {0}.'),
	    minNumeric: jQuery.validator.format('Value cannot less than {0}.'),
	});

	$.validator.setDefaults({
	    errorElement: 'em',
	    errorPlacement: function (error, element) {
	        element.closest('.form-group').find('.help-block').html(error.text());        
	    },
	    highlight: function (element) {
	        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
	    },
	    unhighlight: function(element, errorClass, validClass) {
	        $(element).parent('.form-group').removeClass('has-error');
	        $(element).closest('.form-group').removeClass('has-error');
	        $(element).closest('.form-group').find('.help-block').html('');
	    },
	    success: function (element) {
	        $(element).closest('.form-group').removeClass('has-error');
	        $(element).closest('.form-group').find('.help-block').html('');
	    },
	    // onkeyup: function(element){$(element).valid()},
	    onChange: function(element){$(element).valid()},
	});

	$('#form-register-sidemenu').validate({
		rules: {
	    	email: {
	        	remote: {
	                url: SITE_URL + '/login/check',
	                type: 'post',
	                data: {
	                        email: function() { return $('#form-register-sidemenu input[name="email"]').val()},
	                        _token : function() { return $('meta[name="csrf-token"]').attr('content')},
	                  	}
	              	},
	          	},
	          	password_confirmation: {
			      equalTo: '#form-register-sidemenu [name="password"]'
			    },
			},

	    messages: {
	        email: {
	            remote: '{0} has been used'
	        },
	        password_confirmation: {
	        	equalTo: 'Password not match'
	        }
		},
    	onkeyup: function(element){$(element).valid()},
	});

	$('#form-register-sidemenu').validate({
		rules: {
	    	email: {
	        	remote: {
	                url: SITE_URL + '/login/check',
	                type: 'post',
	                data: {
	                        email: function() { return $('#form-register-sidemenu input[name="email"]').val()},
	                        _token : function() { return $('meta[name="csrf-token"]').attr('content')},
	                  	}
	              	},
	          	},
	          	password_confirmation: {
			      equalTo: '#form-register-sidemenu [name="password"]'
			    },
			},

	    messages: {
	        email: {
	            remote: '{0} has been used'
	        },
	        password_confirmation: {
	        	equalTo: 'Password not match'
	        }
		},
    	onkeyup: function(element){$(element).valid()},
	});
	

	$('form').validate();
});