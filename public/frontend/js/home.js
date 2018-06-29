$(document).ready(function(){
	$('#form-subscribe-popup').validate({
		rules: {
        email: {
            remote: {
                    url: SITE_URL + '/subscribe/check',
                    type: 'post',
                    data: {
                         	email: function() { return $('#form-subscribe-popup input[name="email"]').val() },
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


    if(localStorage.getItem('popState') != 'shown'){
      
      $.magnificPopup.open({
        items: {
          src: '#popup2', // can be a HTML string, jQuery object, or CSS selector
          type: 'inline',
          effect: 'mfp-zoom-in'
        }
      });

      localStorage.setItem('popState','shown')
    }  

});