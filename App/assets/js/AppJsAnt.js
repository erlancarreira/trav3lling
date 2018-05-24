/*$(function(){
	$('#search').on('keyup', function(){
       var texto = $(this).val();

       $.ajax({
       	  url:'Search',
       	  dataType:'json',
       	  type:'POST',
       	  data:{texto:texto},
       	  success:function(json) {
       	  	var html = '';

       	  	for(var i in json) {
       	  	   html +='<li>'.json[i].title.'</li>';
       	  	  
       	    }
       	     $('#result').html(html);
       	  }
       })
	});
});


function getCategory(obj) {
   // var BASE = '<?php echo BASE; ?>';	
	var item = obj.value;
	$.ajax({
		url:BASE+"search/index",
		type:'POST',
		data:{category:item},
		dataType:'json',
		success:function(json) {
			var html = '';
			for (var i in json) {
				html +='<li value="'+json[i].id+'">'+json[i].title+'</li>';
			}

			$("#result").html(html);
		}
	});
};

*/


/*
function addFriend(id, id_user, obj) {
	
	var id_user = $('#id_user').val();
	if(id != '') {

        $(obj).closest('.add-post').fadeOut();

		$.ajax({
			type: 'POST',
			url:'ajax/add_friend',
			data:{id:id, id_user:id_user} 
		});
	}
}
*/

//function addFriend(id, id_user) {
/*
$('.ajax').on("click", function(){
    var id_post = $(this).attr('data-id');
    var id_user = $(this).attr('data-id_user');
   

   if(id_post != '' && id_user != '') {

		$.ajax({
			type: 'POST',
			url:'ajax/addSubscriber',
			data:{id_post:id_post, id_user: id_user},
			success:function(data){
			  //var html = '';
			  if(data.msg){
			  	
			  	$('#verMsg').html(data.msg);
			    
			    } else {

			    	$('.ajax').addClass("btn-danger");
			    	$('.ajax').html("You have subscriber wait...");

			    }
			  } 

			 
		});
	  }  
   
  }); 

//}
	

//function aceitarFriend(id, obj) {

	$('.accept-user').on("click", function(){
    var id_post = $(this).attr('data-id');
    var id_user = $(this).attr('data-id_user');
   

   if(id_post != '' && id_user != '') {

		$.ajax({
			type: 'POST',
			url:'ajax/acceptSubscriber',
			data:{id_post:id_post, id_user: id_user, data: data.msg},
			success:function(data){
			  var html = '';
			  if(data.msg){
			  	
			  	$('#verMsg').html(data.msg);
			    
			    } else {

			    	$('.accept-user').addClass("btn-danger");
			    	$('.accept-user').html("You have subscriber wait...");

			    }
			  } 

			 
		});
	  }  
   
  }); 
*/