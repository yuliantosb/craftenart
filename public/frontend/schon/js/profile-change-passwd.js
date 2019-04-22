$(document).ready(function(){
	$('#form-change-password').validate({
		rules: {
	        old_password: {
	            remote: {
	                    url: SITE_URL + '/user/profile/check_password',
	                    type: 'post',
	                    data: {
	                         	old_password: function() { return $('input[name="old_password"]').val() },
	                            _token : function() { return $('meta[name="csrf-token"]').attr('content')}
                          	}
                      	}
                  	},
                retype_password: {
			      	equalTo: '[name="new_password"]'
			    },
	      	},
	    messages: {
	        old_password: {
	            remote: 'Password invalid'
	        },
	        retype_password: {
	        	equalTo: 'Password not match'
	        }
	    }
	});
});