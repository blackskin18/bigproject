// follow trip
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
});
// join trip
$('.join').click(function(){
	var data={
		trip_id:$("#trip_id").val(),
		user_id:$("#user_id").val()
	}
		$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'accepts': 'application/json',
        }
        });

if($('.join').val()==-1){
	$("#myModal").modal("show");
	$('#request').click(function(){
			$.ajax({
		url:"/trip/join",
		type:"post",
		dataType:"json",
		data:{
			trip_id:$("#trip_id").val(),
			user_id:$("#user_id").val(),
			message:$("#message").val(),
		},
		success:function(data){
			$(".join").prop("value",0);
			$(".join").html("Cancel Request");
			$("#myModal").modal("hide");
			}
		});
	});
	}
	else if($(".join").val()==1){
		$("#myModal").modal("hide");
		$.ajax({
			url:"/trip/out",
			type:"post",
			dataType:"json",
			data:data,
			success:function(data){
				$(".join").prop("value",-1);
				$(".join").html("Join");
			}
		});
	}
	else{
		$("#myModal").modal("hide");
		$.ajax({
			url:"/trip/cancelrequest",
			type:"post",
			dataType:"json",
			data:data,
			success:function(data){
				$(".join").prop("value",-1);
				$(".join").html("Join");
			}
		});
	}
});

