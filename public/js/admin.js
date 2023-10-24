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
     * @Function:        <__construct>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <06-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for toast with proper msg.>
     * @return void
     */
function toastCall(msg, type) {
      var typeClass = '';
	var icon = '';
	switch (type) {
	    case 'error':
		  typeClass = 'error';
		  icon = 'mdi mdi-window-close';
		  break;
	    case 'warning':
		  typeClass = 'warning';
		  icon = 'mdi mdi-exclamation';
		  break;
	    default:
		  typeClass = 'success';
		  icon = 'mdi mdi-check';
		  break;
	}

      if (msg != '') {
            $('#type_iocn').removeClass('mdi-window-close').removeClass('mdi-exclamation').removeClass('mdi-check').addClass(icon);
            $('#toast-msg').text(msg).ready(function() {
                $('#toast-custom').removeClass('error').removeClass('warning').removeClass('success').addClass(typeClass).show('fade');
            });
            setTimeout(function() { $('#toast-custom').hide('fade') }, 6000);
      }
}

 /**
     * @Function:        <__construct>
     * @Author:          Gautam Kakadiya( ShreeGurave Dev Team )
     * @Created On:      <06-12-2021>
     * @Last Modified By:Gautam Kakadiya
     * @Last Modified:   Gautam Kakadiya
     * @Description:     <This function work for delete selected records.>
     * @return void
     */
$('.delete-record').on( "click", function(){
      var id = $(this).data('id');
      var title = $(this).data('title');
      var segment = $(this).data('segment');

      $('.bootbox').on('hide.bs.modal', function (e) {
            // do something...
            alert("Bootstrap here");
      });

      bootbox.confirm({
            message: "Are you sure you want to  delete this <b>"+title+".</b> with Gentimedia?",
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                  if( result ) {
                        $.ajax({
                              url: url + '/admin/'+segment+'/delete/'+id,
                              type: "DELETE",
                              data: {},
                              dataType: 'json',
                              success: function(result) {
                                    $("#row_"+id).remove();
                                    if( $( "."+segment+"_row" ).length == 0 ){
                                          var totallength = $( "#"+segment+" th").length;
                                          $("tbody").html('<tr class="text-center"><td colspan="'+totallength+'">There is no menu available.</td></tr>');
                                    }
                                    toastCall( result.data.message, "success");
                              }
                        });
                  } else {
                        // dataTable.ajax.reload();
                        toastCall( "Entry was reverted", "warning");
                  }
            }
        });
});

/**
 * Title Tag
 * auto search client name with specific search on search textbox
 * Autocomplete form from database using name on listing/searching page
 * @returns
 */
 $("#BlogTags-txt").on( 'keyup', function () 
 {
      $('#DropdownBlogTags').hide();
      $("#BlogTags-txt ul").removeClass("d-none");
      $('#BlogTags-txt').css('background-image', 'url(' +  url + '/img/preloader-white.gif)').css( 'background-repeat','no-repeat' ).css( 'background-position', 'right' );
      var  id = $('#used_to').val();
      var membership_type = $("#search_membership_type").val();

      if( $("#plan_mode").length > 0 ){
            membership_type = $("#plan_mode").val();
      }

      $.ajax({
            type: "POST",
            url: url+'/api/autocomplete-blog-tag-search',
            data: { query : $("#BlogTags-txt").val(), membership_type: membership_type },
            dataType: "json",
            success: function (data) 
            {
                  if (data.length > 0) 
                  {
                        $('#DropdownBlogTags').empty().dropdown('toggle');
                        $('#BlogTags-txt').attr("data-toggle", "dropdown");
                        $(".txt_title_tag").show();
                  }

                  $.each(data, function (key,value) 
                  {
                        if (data.length >= 0)
                              $('#DropdownBlogTags').append(`<li role="autoSearch"  class="disclient"><a role="menuitem dropdownClientli" class="dropdownlivalue" onclick="$('#addTag').removeClass('disabled'); $('#addTitle').removeClass('disabled');" >${value['title']}</a></li>`);
                  });

                  $('#BlogTags-txt').css('background-image', 'none');
            }
      });
 });

 $('ul.txt_title_tag').on('click', 'li a', function () {
     $('#BlogTags-txt').val($(this).text());
     $(".txt_title_tag").hide();//addClass("d-none");
 });

 /**
 * Author
 * auto search client name with specific search on search textbox
 * Autocomplete form from database using name on listing/searching page
 * @returns
 */
  $("#author_txt").on( 'keyup', function () 
  {
      $('#DropdownAuthor').hide();
      $("#author_txt ul").removeClass("d-none");
       $('#author_txt').css('background-image', 'url(' +  url + '/img/preloader-white.gif)').css( 'background-repeat','no-repeat' ).css( 'background-position', 'right' );
       var  id = $('#used_to').val();
       $.ajax({
             type: "POST",
             url: url+'/api/autocomplete-author-search',
             data: { query : $("#author_txt").val() },
             dataType: "json",
             success: function (data) 
             {
                   if (data.length > 0) 
                   {
                         $('#DropdownAuthor').empty().dropdown('toggle');
                         $('#author_txt').attr("data-toggle", "dropdown");
                         $(".txt-author").show();
                   }
 
                   $.each(data, function (key,value) 
                   {
                         if (data.length >= 0)
                               $('#DropdownAuthor').append('<li role="autoSearch" class="disclient"><a role="menuitem dropdownAuthorli" class="dropdownlivalue" >' + value['name'] + '</a></li>');
                   });
 
                   $('#author_txt').css('background-image', 'none');
             }
       });
  });
 
  $('ul.txt-author').on('click', 'li a', function () {
      $('#author_txt').val($(this).text());
      $(".txt-author").hide();//addClass("d-none");
  });

  /**
 * Author Tags
 * auto search client name with specific search on search textbox
 * Autocomplete form from database using name on listing/searching page
 * @returns
 */
$("#author_text").on( 'keyup', function () 
{
      console.log('here');
      $('#DropdownAuthorTag').hide();
      $("#author_text ul").removeClass("d-none");
      $('#author_text').css('background-image', 'url(' +  url + '/img/preloader-white.gif)').css( 'background-repeat','no-repeat' ).css( 'background-position', 'right' );
      var  id = $('#used_to').val();
      $.ajax({
            type: "POST",
            url: url+'/api/autocomplete-author-tag-search',
            data: { query : $("#author_text").val() },
            dataType: "json",
            success: function (data) 
            {
                  if (data.length > 0) 
                  {
                        $('#DropdownAuthorTag').empty().dropdown('toggle');
                        $('#author_text').attr("data-toggle", "dropdown");
                        $(".txt-author-tag").show();
                  }

                  $.each(data, function (key,value) 
                  {
                        if (data.length >= 0)
                              $('#DropdownAuthorTag').append('<li role="autoSearch"  class="disclient"><a role="menuitem DropdownAuthorTagli" class="dropdownlivalue" >' + value['name'] + '</a></li>');
                  });

                  $('#author_text').css('background-image', 'none');
            }
      });
});

$('ul.txt-author-tag').on('click', 'li a', function () {
      $('#author_text').val($(this).text());
      $(".txt-author-tag").hide();//addClass("d-none");
});

/**
 * Author Type
 * auto search client name with specific search on search textbox
 * Autocomplete form from database using name on listing/searching page
 * @returns
 */
 $("#author_type_text").on( 'keyup', function () 
 {
       $('#DropdownAuthorType').hide();
       $("#author_type_text ul").removeClass("d-none");
       $('#author_type_text').css('background-image', 'url(' +  url + '/img/preloader-white.gif)').css( 'background-repeat','no-repeat' ).css( 'background-position', 'right' );
       var  id = $('#used_to').val();
       $.ajax({
             type: "POST",
             url: url+'/api/autocomplete-author-type-search',
             data: { query : $("#author_type_text").val() },
             dataType: "json",
             success: function (data) 
             {
                   if (data.length > 0) 
                   {
                         $('#DropdownAuthorType').empty().dropdown('toggle');
                         $('#author_type_text').attr("data-toggle", "dropdown");
                         $(".txt-author-type").show();
                   }
 
                   $.each(data, function (key,value) 
                   {
                         if (data.length >= 0)
                               $('#DropdownAuthorType').append('<li role="autoSearch"  class="disclient"><a role="menuitem DropdownAuthorTypeli" class="dropdownlivalue" >' + value['name'] + '</a></li>');
                   });
 
                   $('#author_type_text').css('background-image', 'none');
             }
       });
 });
 
 $('ul.txt-author-type').on('click', 'li a', function () {
       $('#author_type_text').val($(this).text());
       $(".txt-author-type").hide();//addClass("d-none");
 });

 /**
 * Category(Genre)
 * auto search client name with specific search on search textbox
 * Autocomplete form from database using name on listing/searching page
 * @returns
 */
$("#genre_search_txt").on( 'keyup', function () 
{
      $('#DropdownGenreSearch').hide();
      $("#genre_search_txt ul").removeClass("d-none");
      $('#genre_search_txt').css('background-image', 'url(' +  url + '/img/preloader-white.gif)').css( 'background-repeat','no-repeat' ).css( 'background-position', 'right' );
      var  id = $('#used_to').val();
      $.ajax({
            type: "POST",
            url: url+'/api/autocomplete-category-search/0/2',
            data: { query : $("#genre_search_txt").val() },
            dataType: "json",
            success: function (data) 
            {
                  if (data.length > 0) 
                  {
                        $('#DropdownGenreSearch').empty().dropdown('toggle');
                        $('#genre_search_txt').attr("data-toggle", "dropdown");
                        $(".txt-genre").show();
                  }

                  $.each(data, function (key,value) 
                  {
                        if (data.length >= 0){
                              $('#DropdownGenreSearch').append(`<li role="autoSearch"  class="disclient"><a role="menuitem DropdownGenreSearchli" class="dropdownlivalue" onclick="$('#select_parent_cat_id').val(${value['id']});$('#addGenre').removeClass('disabled');">${value['title']}</a></li>`);
                              // $('#DropdownGenreSearch').append(`<li role="autoSearch"  class="disclient"><a role="menuitem DropdownGenreSearchli" class="dropdownlivalue" onclick="$('#select_parent_cat_id').val(${value['id']});$('#addGenre').removeClass('disabled');">${value['title']}</a></li>`);
                              //  getChildCategory( ${value['id']}, 3 )
                        }
                  });

                  $('#genre_search_txt').css('background-image', 'none');
            }
      });
});
  
$('ul.txt-genre').on('click', 'li a', function () {
      $('#genre_search_txt').val($(this).text());
      $(".txt-genre").hide();//addClass("d-none");
});

 /**
 * Category(Genre)
 * auto search client name with specific search on search textbox
 * Autocomplete form from database using name on listing/searching page
 * @returns
 */
$("#sub_category_search_txt").on( 'keyup', function () 
{
      var parent_ids = '';
      $('.selected-category-ids').each(function( i, v ){
            parent_ids = v.value+'-'+parent_ids;
      });

      parent_ids = parent_ids.slice(0,-1);

      // var parent_id = $('#select_parent_cat_id').val();
      // if( ( parent_id == "" || parent_id == 0 ) && parent_ids == "" )
      if( parent_ids == "" )
            return ;

      $('#DropdownSubGenreSearch').hide();
      $("#sub_category_search_txt ul").removeClass("d-none");
      $('#sub_category_search_txt').css('background-image', 'url(' + url + '/img/preloader-white.gif)').css( 'background-repeat','no-repeat' ).css( 'background-position', 'right' );
      var  id = $('#used_to').val();
      $.ajax({
            type: "POST",
            url: url+'/api/autocomplete-category-search/'+parent_ids+'/3',
            data: { query : $("#sub_category_search_txt").val() },
            dataType: "json",
            success: function (data) 
            {
                  if (data.length > 0) 
                  {
                        $('#DropdownSubGenreSearch').empty().dropdown('toggle');
                        $('#sub_category_search_txt').attr("data-toggle", "dropdown");
                        $(".txt-sub-genre").show();
                  }

                  $.each(data, function ( key, value ) 
                  {
                        if (data.length >= 0)
                              $('#DropdownSubGenreSearch').append(`<li role="autoSearch"  class="disclient"><a role="menuitem DropdownSubGenreSearchli" class="dropdownlivalue" onclick="$('#select_child_cat_id').val(${value['id']});$('#addSubGenre').removeClass('disabled');">${value['title']}</a></li>`);
                  });
                  $('#sub_category_search_txt').css('background-image', 'none');
            }
      });
});

$('ul.txt-sub-genre').on('click', 'li a', function () {
      $('#sub_category_search_txt').val($(this).text());
      $(".txt-sub-genre").hide();
});

 /**
  * 
  */
function getChildCategory( id, type )
{
      $.ajax({
            url: url + '/api/get-sub-genre/'+id,
            type: "get",
            data: {},
            dataType: 'json',
            success: function(result) {
                  console.log(result);
                  // var html = "";
                  // $(result.data.result).each(function( i, v ) {
                  //       html += `<option value="${v.id}" >${v.title}</option>`;
                  // });
                  // console.log(html);
                  // $(".child-category-id-"+type).html("").html(html);
            }
      });
}

/**
 * 
 */
 function onlyNumberKey(evt, val, length) {
          
      // Only ASCII character in that range allowed
      var ASCIICode = (evt.which) ? evt.which : evt.keyCode
      if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57) && ASCIICode == 08){
            $(".onlyNumberKey-error").removeClass('d-none');
            return false;
      }

      if( val.length > length ){// && length !=0 ){
            $(".onlyNumberKey-error").addClass('d-none');
            return false;
      }

      $(".onlyNumberKey-error").removeClass('d-none');
      return true;
}

$("document").ready(function(){
      setTimeout(function(){
            $("div .alert").remove();
      }, 5000 ); // 5 secs
});