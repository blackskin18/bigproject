$('.sub_comment_nd').on("keypress",function(e){
	if(e.which==13){
		var data={
			parent_id:$('#sub_parent_id').val(),
			trip_id:$('#sub_trip_id').val(),
			user_id:$("#sub_user_id").val(),
			text:$(".sub_comment_nd").val()
		}
		e.preventDefault();
		$.ajaxSetup({
			headers: {
            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
		});
		console.log(1);
	$.ajax({
			url:window.location.origin+"/bigproject/public/trip/detail/sub_comment",
			type:"POST",
			dataType:"json",
			data:data,
			success:function(data){
				console.log(data);
				setTimeout(function(){
					location.reload()
				},1);
			},
			error:function(data){
				alert('error');
			}
		});
	};
 });
$('#sub_comment_image').click(function(){
	$("sub_comment_text").modal('show');
});
