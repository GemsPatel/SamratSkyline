/*
Author: ShreeGurave
Author URI: https://ShreeGurave.com
*/

$.ajaxSetup({
	headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
}); 
 
/**
 * 
 */
$('.title-form-submit').on( 'click', function(){
      titleFormSubmitValidate()
});

function titleFormSubmitValidate(){

      var submit = true;
      $(".form-control").removeClass('border-red');
      $("#country_id, #language_id").next().removeClass('border-red');

      var title = $("#title").val();
      var serial_number = $("#serial_number").val();
      var type_id = $("#type_id").val();
      var membership_type = $("#membership_type").val();
      var category_id = $("input[name='category_id[]']").val();
      
      if( title == "" ){ $("#title").addClass('border-red'); submit = false; }
      if( serial_number == "" || serial_number.length != 7){ $("#serial_number").addClass('border-red'); submit = false; }
      if( type_id == 0 ){ $("#type_id").addClass('border-red'); submit = false; }
      if( membership_type == "" ){ $("#membership_type").addClass('border-red'); submit = false; }
      if( category_id == undefined ){ $("#genre_search_txt").addClass('border-red'); submit = false; }

      if( submit ){
            $("#titleFormSubmit").trigger("submit");
      }
}

/**
 * 
 */
$('.audio-drama-form-submit').on( 'click', function(){
      audioDramaFormSubmitValidate()
});

function audioDramaFormSubmitValidate(){

      var submit = true;
      $(".form-control").removeClass('border-red');
      $("#country_id, #language_id").next().removeClass('border-red');

      // var drama_name = $("#drama_name").val();
      var serial_number = $("#serial_number").val();
      var title_id = $('#title_id').select2("val");
      var country_id = $('#country_id').select2("val");
      var language_id = $('#language_id').select2("val");
      var type_id = $("#type_id").val();
      var publisher = $("#publisher").val();
      var audio_file_name = $("#audio_file_name").val();
      var publish_date = $("#publish_date").val();
      var duration = $("#duration").val();
       var description = $("#description").val();

      // if( drama_name == "" ){ $("#drama_name").addClass('border-red'); submit = false; }
      if( serial_number == "" || serial_number.length != 7){ $("#serial_number").addClass('border-red'); submit = false; }
      if( title_id == 0 ){ $("#title_id").addClass('border-red'); submit = false; }
      if( country_id.length == 0 ){ $("#country_id").next().addClass('border-red'); submit = false; }
      if( language_id.length == 0 ){ $("#language_id").next().addClass('border-red'); submit = false; }
      if( type_id == 0 ){ $("#type_id").addClass('border-red'); submit = false; }
      if( publisher == "" ){ $("#publisher").addClass('border-red'); submit = false; }
      if( audio_file_name == "" ){ $("#audio_file_name").addClass('border-red'); submit = false; }
      if( publish_date == "" ){ $("#publish_date").addClass('border-red'); submit = false; }
      if( duration == "" ){ $("#duration").addClass('border-red'); submit = false; }
      if( description == "" ){ $("#description").addClass('border-red'); submit = false; }
      if( $("#author_store").html() == "" ){$("#author_txt").addClass('border-red'); submit = false;}
      if( $("#tag-store").html() == "" ){$("#titletag-txt").addClass('border-red'); submit = false;}
      if( $("#genreStore").html() == "" ){$("#genre_search_txt").addClass('border-red'); submit = false;}
      if( $("#genreSubStore").html() == "" ){$("#sub_category_search_txt").addClass('border-red'); submit = false;}

      if( submit ){
            $("#audioDramaFormSubmit").trigger("submit");
      }
}

/**
 * 
 */
 $('.audio-book-form-submit').on( 'click', function(){
      audioBookFormSubmitValidate()
});

function audioBookFormSubmitValidate(){

      var submit = true;
      $(".form-control").removeClass('border-red');
      $("#country_id, #language_id").next().removeClass('border-red');

      // var drama_name = $("#book_name").val();
      var serial_number = $("#serial_number").val();
      var title_id = $('#title_id').select2("val");
      var country_id = $('#country_id').select2("val");
      var language_id = $('#language_id').select2("val");
      var type_id = $("#type_id").val();
      var publisher = $("#publisher").val();
      var audio_file_name = $("#audio_file_name").val();
      var publish_date = $("#publish_date").val();
      var duration = $("#duration").val();

      // if( book_name == "" ){ $("#book_name").addClass('border-red'); submit = false; }
      if( serial_number == "" || serial_number.length != 7){ $("#serial_number").addClass('border-red'); submit = false; }
      if( title_id == 0 ){ $("#title_id").addClass('border-red'); submit = false; }
      if( country_id.length == 0 ){ $("#country_id").next().addClass('border-red'); submit = false; }
      if( language_id.length == 0 ){ $("#language_id").next().addClass('border-red'); submit = false; }
      if( type_id == 0 ){ $("#type_id").addClass('border-red'); submit = false; }
      if( publisher == "" ){ $("#publisher").addClass('border-red'); submit = false; }
      if( audio_file_name == "" ){ $("#audio_file_name").addClass('border-red'); submit = false; }
      if( publish_date == "" ){ $("#publish_date").addClass('border-red'); submit = false; }
      if( duration == "" ){ $("#duration").addClass('border-red'); submit = false; }
      if( $("#author_store").html() == "" ){$("#author_txt").addClass('border-red'); submit = false;}
      if( $("#tag-store").html() == "" ){$("#titletag-txt").addClass('border-red'); submit = false;}
      if( $("#genreStore").html() == "" ){$("#genre_search_txt").addClass('border-red'); submit = false;}
      if( $("#genreSubStore").html() == "" ){$("#sub_category_search_txt").addClass('border-red'); submit = false;}

      if( submit ){
            $("#audioBookFormSubmit").trigger("submit");
      }
}

/**
 * 
 */
 $('.plan-form-submit').on( 'click', function(){
      planFormSubmitValidate()
});

function planFormSubmitValidate(){

      var submit = true;
      $(".form-control").removeClass('border-red');
      $("#country_id, #language_id").next().removeClass('border-red');

      var name = $("#name").val();
      var description = $("#description").val();
      var country_id = $("input[name='country_id[0]']").val();
      var titles = $("input[name='titles[]']").val();
      
      if( name == "" ){ $("#name").addClass('border-red'); submit = false; }
      if( description == "" ){ $("#description").addClass('border-red'); submit = false; }
      if( country_id == undefined ){ $("#select_country_txt, #country_amount").addClass('border-red'); submit = false; }
      if( titles == undefined ){ $("#titletag-txt").addClass('border-red'); submit = false; }

      if( submit ){
            $("#planFormSubmit").trigger("submit");
      }
}

/*
+---------------------------------------------+
	display image preview
+---------------------------------------------+
*/

function readURL(input,position) 
{
	var inputId = input.id;
	var prevImgId = $('#'+inputId).parent().find('img').attr('id'); //find parent img id
	strInput = inputId.substring(0,inputId.indexOf("_") + 1);
	strPrevImg = prevImgId.substring(0,prevImgId.indexOf("_") + 1);
	//alert(strInput+"=="+strPrevImg);
	var imgName = $('#'+strInput+position).val();
	var ext = imgName.split('.').pop().toLowerCase();
	
	if($.inArray(ext, ['gif','png','jpg','jpeg'])) 
	{
		if (input.files && input.files[0]) 
		{
			var reader = new FileReader();
			reader.onload = function (e) 
			{
				$('#'+strPrevImg+position).attr('src', e.target.result);
				$('#'+inputId).next().val(imgName);
			}
			reader.readAsDataURL(input.files[0]);
		 }
	}
	else
	{
		$('#'+strPrevImg+position).attr('src','');
	}
}

/*
+---------------------------------------------+
	clear on set no image display
+---------------------------------------------+
*/
function clear_image(para)
{
	$("#"+para).attr('src', url+"/img/no-image.png");
	clearHiddenImage(para);
}

/*
+---------------------------------------------+
	hidden clear image path
+---------------------------------------------+
*/
function clearHiddenImage(para)
{
	var hideInput = $("#"+para).nextAll('input:[type=hidden]')[0];
	$(hideInput).val('');
}