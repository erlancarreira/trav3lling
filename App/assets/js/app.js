// $(document).ready(function(){
//   $
// });  

$(document).ready(function(){
  $('.input-file, #insert').on('click', function(){
    
  var $input = $(this),
    patch = BASE+'App/assets/img/account/places/',      
    $label = $input.next('.js-labelFile'),
    labelVal = $label.html();
    
    $input.on('change', function(element) {
    var fileName = '';
    if (element.target.value) fileName = element.target.value.split('\\').pop();
      fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label.removeClass('has-file').html(labelVal);
      
// console.log($('.img-replace').attr('src'));
      

$($input).each(function(index) {
      
    var data = new FormData();
   
    var arquivo = $input[0].files;

    if (arquivo.length > 0) {
       
      alert('Cliquei');
        
        data.append('insert', $(this).data('id-post'));
        data.append('photo', $(this).data('id'));
        data.append('photo', arquivo[0]);

        console.log(data);

        $.ajax({
          type:'POST',
          url:BASE+'ajax/updateImage',
          data:data,
          contentType:false,
          processData:false,
          beforeSend:function(data){
          
            var i = $($input).attr('id');
            $('.'+i).addClass('fa-spinner fa-spin');        
            // console.log($input);
            // if($($label).hasClass('has-file'))
            // $($input).find('i.fa').addClass('fa-spinner fa-spin') // $('.fa').eq($($input)).remove('fa-spinner fa-spin'); //.removeClass('fa-spinner fa-spin');
           
          },
          success:function(data){
          
          var i = $($input).attr('id');
          $('.'+i).addClass('fa-check').removeClass('fa-spinner fa-spin');
          // $('.img-replace').attr('src', patch+fileName);
         
            
          }
         }); 
        }
      });  
    });
  });   
 });

let $doc = $('html, body');
let menuHeight = $('.menu-swix').innerHeight();
$('.scrollSuave').click(function() {
    $doc.animate({
        scrollTop: $( $.attr(this, 'href') ).offset().top - menuHeight
    }, 1000);
    return false;
});

$(document).ready(function() {
  var appointments = new Array();
  loadCalendar();

  function loadCalendar() {
    $.ajax({
      url: BASE+"ajax/events",
      type: "GET",
      dataType: "json",
      success: function(data) {
        $.each(data, function(index, item) {
          appointments.push(item);
        });

        $("#calendar").fullCalendar({
          displayEventEnd: true,
          
          events: appointments
        });

        
      },
      error: function(errObj, textStatus, errorThrown) {
        console.log(errObj, textStatus, errorThrown);
      }
    });
  }
});  

$(function() {

  // page is now ready, initialize the calendar...

  $('#calendar').fullCalendar({
    header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                selectable: true,
                selectHelper: true,

            defaultDate: new Date(2016, 4, 20)
 

  });

});

$('#chatScroll').each(function() {
  const chatHeight = $(this).innerHeight();
  if(chatHeight > 500) 
    $(this).addClass('chatScroll');
  console.log(chatHeight); 
});
// (function() {
  
//   'use strict';

  
  
//   $('.input-file').each(function(index) {
    
//     // var data = new FormData();
//     var $input = $(this),
//         $label = $input.next('.js-labelFile'),
//         labelVal = $label.html();
    
//     $input.on('change', function(element) {
//       var fileName = '';
//       if (element.target.value) fileName = element.target.value.split('\\').pop();
//       fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label.removeClass('has-file').html(labelVal);
//     });
    
    // for (var i = 0; i < $input.length; i++) {
       
    //   var ver = $input[i].files;
    // console.log(ver);  

    // if(ver.length > 0) {

    //   $('.input-val').val();
    
    // } else {

    //   $('.input-val').val('');
    // }
    
    // }
    // var pr = $input[0].files;

    // // data.append('id_photo', $('#id_photo').val());
    // // data.append('photo', $input[0]);

    // console.log(pr);
    // if(pr.length > 0) {
    //   $('.input-val').val();
    // } else {
    //   $('.input-val').val('');
    // }


//   });

// })();

// $(document).ready(function(){
 
//  fetch_data();

//  function fetch_data()
//  {
//   var action = "fetch";
//   $.ajax({
//    url:"index.php",
//    method:"POST",
//    data:{action:action},
//    success:function(data)
//    {
//     $('#image_data').html(data);
//    }
//   })
//  }
//  $('#add').click(function(){
//   $('#imageModal').modal('show');
//   $('#image_form')[0].reset();
//   $('.modal-title').text("Add Image");
//   $('#image_id').val('');
//   $('#action').val('insert');
//   $('#insert').val("Insert");
//  });
//  $('#image_form').submit(function(event){
//   event.preventDefault();
//   var image_name = $('#image').val();
//   if(image_name == '')
//   {
//    alert("Please Select Image");
//    return false;
//   }
//   else
//   {
//    var extension = $('#image').val().split('.').pop().toLowerCase();
//    if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
//    {
//     alert("Invalid Image File");
//     $('#image').val('');
//     return false;
//    }
//    else
//    {
//     $.ajax({
//      url:"index.php",
//      method:"POST",
//      data:new FormData(this),
//      contentType:false,
//      processData:false,
//      success:function(data)
//      {
//       alert(data);
//       fetch_data();
//       $('#image_form')[0].reset();
//       $('#imageModal').modal('hide');
//      }
//     });
//    }
//   }
//  });
//  $(document).on('click', '.update', function(){
//   $('#image_id').val($(this).attr("id"));
//   $('#action').val("update");
//   $('.modal-title').text("Update Image");
//   $('#insert').val("Update");
//   $('#imageModal').modal("show");
//  });
//  $(document).on('click', '.delete', function(){
//   var image_id = $(this).attr("id");
//   var action = "delete";
//   if(confirm("Are you sure you want to remove this image from database?"))
//   {
//    $.ajax({
//     url:"index.php",
//     method:"POST",
//     data:{image_id:image_id, action:action},
//     success:function(data)
//     {
//      alert(data);
//      fetch_data();
//     }
//    })
//   }
//   else
//   {
//    return false;
//   }
//  });
// });  


/*function acao1() { 
var url = "http://localhost/swix-pro/";
	//document.form1.action = url+"subscribes/accept";
	
	if(form1) {
		alert("Cliquei na ação 1");
		//alert(document.form1.action = url+"subscribes/accept");
	}
	
}
	
function acao2() { 
var url = "http://localhost/swix-pro/"; 
	
	//document.form1.action = url+"subscribes/notAccept";
	
    if(form1) {
		alert("Cliquei na ação 2");
	}

	}

$(function(){
	$('#search').on('keyup', function(){
       var category = $('#category').val();
       var texto = $('#busca').val();
       
       $.ajax({
       	  url:'Search',
       	  dataType:'json',
       	  type:'GET',
       	  data:{texto:texto},
       	  success:function(json) {
       	  	var html = '';

       	  	for(var i in json) {
       	  	   html +='<li>'+json[i].title+'</li>';
       	  	  
       	    }
       	     $('#result').html(html);
       	  }
       });
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

$("#setSkills").select2({
    
    tags: true,
    tokenSeparators: [',', ' ']
});

$("#setLanguages").select2({
    
    tags: true,
    tokenSeparators: [',', ' ']
});

// $(document).ready(function(){
  
//   $("#desc").outerHeight(function(){  
  
//   if ($(this).innerHeight() >= 137) {
//     $('#desc').addClass('colapso');
//     $('#desc').html("AQUI É");
//   }

//   console.log(verifyHeigh); 
// });
// });

/*
$(document).ready(function(){
 $('.selectpicker').selectpicker('');

 $('#setSkills').change(function(){
  $('#hidden_setSkills').val($('#setSkills').val());
 });

 $('#multiple_select_form').on('submit', function(event){
  event.preventDefault();
  if($('#setSkills').val() != '')
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"ajax/updateSkills",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     console.log(data);
     //$('#hidden_setSkills').val('');
     $('.selectpicker').selectpicker('val', '');
     alert(data);
    }
   })
  }
  else
  {
   alert("Please select framework");
   return false;
  }
 });
});

*/