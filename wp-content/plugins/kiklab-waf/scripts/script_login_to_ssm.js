$(document).ready(function(){
	$('input').removeAttr('size');
	$('#user_login, #user_pass').after('<span class="underline-animation"></span>');
	$('#rememberme').after('<span class="checkmark"></span>');
});