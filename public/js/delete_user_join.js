$('.delete_user_join').click(function(){
		var data={
			trip_id:$("#trip_id").val(),
			user_id:$('#user_id').val(),
	}
		$.ajaxSetup({
        	headers: {
            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            	'accepts': 'application/json',
        }
        });
        $.ajax({
        	url:"http://localhost/bigproject/public/trip/delete_user_join",
        	type:"post",
        	dataType:'json',
        	data:data,
        	success:function(data){
        		$(this).fadeOut();
        	}
        });
});
$('.delete_user_request').click(function(){
	var data={
		trip_id:$("#trip_id_request").val(),
		user_id:$("#user_id_request").val(),
	}
	$.ajaxSetup({
        	headers: {
            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            	'accepts': 'application/json',
        }
    });
    $.ajax({
    	url:"http://localhost/bigproject/public/trip/delete_user_request",
    	type:"post",
    	dataType:"json",
    	data:data,
    	success:function(data){
    		$(this).fadeOut();
    	}
    });
});
$('.accept').click(function(){
	var data={
		trip_id:$("#trip_id_request").val(),
		user_id:$("#user_id_request").val()
	}
	$.ajaxSetup({
        	headers: {
            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            	'accepts': 'application/json',
        }
    });
    $.ajax({
    	url:"http://localhost/bigproject/public/trip/accept",
    	type:"post",
    	dataType:"json",
    	data:data,
    	success:function(data){
    		$('.user_request').fadeOut();
    		$('.user_join').append('.user_request');
    		$('.accept').fadeOut();
    	}
    });
});