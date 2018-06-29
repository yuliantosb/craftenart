$(document).ready(function(){
	$('#form-comment').validate();

	$('.btn-reply').click(function(){

		comment_id = $(this).data('value');


		$('#form-comment-reply-' + comment_id).toggle('fast');
		$('#form-comment-reply-' + comment_id).validate();

	});

});