$(document).ready(function(){
	$('#menu').on('click',function(){
		if($('#side_nav').is(':visible')){
			$('#side_nav').hide();
		}else{
			$('#side_nav').show();	
		}
	});
});
