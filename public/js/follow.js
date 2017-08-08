$('.follow').click(function(){
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
	if($('.follow').val()==0){
		$.ajax({
			url:"/trip/follow",
			type:"post",
			dataType:"json",
			data:data,
			success:function(data){
				 console.log(data);
				$(".follow").prop("value",1);
				$(".follow").html('Unfollow');
			}
		});
	}else{
		$.ajax({
			url:"/trip/unfollow",
			type:"post",
			dataType:"json",
			data:data,
			success:function(data){
				$(".follow").prop("value",0);
				$(".follow").html('Follow');
				console.log("sdfsdfsd");
			}
		});
	}
	// console.log('sjdhfsf');
	// }
});
