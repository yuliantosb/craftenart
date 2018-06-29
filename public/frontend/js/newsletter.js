$(document).ready(function(){
	$('#form-subscribe-bottom').validate({
		rules: {
        email: {
            remote: {
                    url: SITE_URL + '/subscribe/check',
                    type: 'post',
                    data: {
                         	email: function() { return $('#form-subscribe-bottom input[name="email"]').val() },
                            _token : function() { return $('meta[name="csrf-token"]').attr('content')}
                          }
                      }
                  },
      	},
    messages: {
        email: {
            remote: 'Email already subscribed'
        }
    },
    	onkeyup: function(element){$(element).valid()},
	});
});