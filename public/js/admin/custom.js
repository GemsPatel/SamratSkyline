/*
+--------------------------------------------------+
	Function will remove all special character from
	string and append - for URL optimization
+--------------------------------------------------+
*/
function getUrlName(str, display_alias = 'alias_slug' )
{
	var st = str.replace(/[^a-zA-Z0-9]+/g,'-');
	$('#'+display_alias).val(st.toLowerCase());
}

/**
 *
 */
function setSearchPaginationPlace( id ){
	$(".buttons-excel").addClass('ml-1');
	$(".buttons-pdf").addClass('ml-1');
	$( id+" .col-md-6:eq(1)").addClass('text-right');
	// $( id+"_paginate .pagination").addClass('justify-content-end');
}

/**
 *
 */
$("#plan_mode").on( "change", function(){
	var mode = $(this).val();
	if( mode == 2 ){
		$("#amount").val("0.00").attr("readonly", false);
		$(".plan_interval_mode").removeClass('d-none');
		$(".paid-free-col").removeClass('col-md-6').addClass('col-md-4');
		$(".trial-days").removeClass('d-none');
	} else {
		$("#amount").val("0.00").attr("readonly", true);
		$(".plan_interval_mode").addClass('d-none');
		$(".paid-free-col").removeClass('col-md-4').addClass('col-md-6');
		$(".trial-days").addClass('d-none');
	}
} );

/**
  *Add tag
  */
$("#addBlogTag").on( "click", function (e) {
	var tag_name = $("#BlogTags-txt").val();
	if (tag_name.length > 0)
	{
		var result = tag_name.split(',');
		$.each( result, function( i, name ){
			$("#blog-tag-store").append(
				'<span class="badge badge-dark title-badge mx-1 mt-2"><input type="hidden" name="tags[]" value="'+tag_name+'" >' +
				name+' <a href="javascript:void(0)" class="text-white-50 ml-1 delTag"><i class="fa fa-times"></i></a></span>'
		    );
		});
	}
	// $(this).addClass('disabled');
	$("#BlogTags-txt").val(null);
});

/**
 * Remove select tag
 */
$("#blog-tag-store").on("click", ".delTag", function () {
	$(this).parent().remove();
});

/**
  *Add Title
  */
  $("#addTitle").on( "click", function (e) {
	var tag_name = $("#titletag-txt").val();
	if (tag_name.length > 0)
	{
		var result = tag_name.split(',');
		$.each( result, function( i, name ){
			$("#title_store").append(
				'<span class="badge badge-dark title-badge mx-1 mt-2"><input type="hidden" name="titles[]" value="'+tag_name+'" >' +
				name+' <a href="javascript:void(0)" class="text-white-50 ml-1 delTitle"><i class="fa fa-times"></i></a></span>'
		    );
		});
	}
	// $(this).addClass('disabled');
	$("#titletag-txt").val(null);
});

/**
 * Remove select title
 */
$("#title_store").on("click", ".delTitle", function () {
	$(this).parent().remove();
});

/**
  * Add author type
  */
  $("#authorType").on( "click", function (e) {
	var type_text = $("#author_type_text").val();
	if (type_text.length > 0)
	{
		var result = type_text.split(',');
		$.each( result, function( i, name ){
			$("#author_type_store").append(
				'<span class="badge badge-dark title-badge mx-1 mt-2"><input type="hidden" name="author_type[]" value="'+type_text+'" >' +
				name+' <a href="javascript:void(0)" class="text-white-50 ml-1 delTag"><i class="fa fa-times"></i></a></span>'
		    );
		});
	}
	$("#type_text").val(null);
});

/**
 * Remove selected author type
 */
$("#author_type_store").on("click", ".delTag", function () {
	$(this).parent().remove();
});

/**
  * Add author type
  */
 $("#addAuthorTag").on( "click", function (e) {
	var author_text = $("#author_text").val();
	if (author_text.length > 0)
	{
		var result = author_text.split(',');
		$.each( result, function( i, name ){
			$("#author_tag_store").append(
				'<span class="badge badge-dark title-badge mx-1 mt-2"><input type="hidden" name="author_tag[]" value="'+author_text+'" >' +
				name+' <a href="javascript:void(0)" class="text-white-50 ml-1 delTag"><i class="fa fa-times"></i></a></span>'
		    );
		});
	}
	$("#author_text").val(null);
});

/**
 * Remove selected author type
 */
$("#author_tag_store").on("click", ".delTag", function () {
	$(this).parent().remove();
});

/**
  * Add author
  */
 $("#addAuthor").on( "click", function (e) {
	var author_txt = $("#author_txt").val();
	if (author_txt.length > 0)
	{
		var result = author_txt.split(',');
		$.each( result, function( i, name ){
			$("#author_store").append(
				'<span class="badge badge-dark title-badge mx-1 mt-2"><input type="hidden" name="authors[]" value="'+author_txt+'" >' +
				name+' <a href="javascript:void(0)" class="text-white-50 ml-1 delAuthor"><i class="fa fa-times"></i></a></span>'
		    );
		});
	}

	$("#author_txt").val(null);
});

/**
 * Remove selected author
 */
$("#author_store").on("click", ".delAuthor", function () {
	$(this).parent().remove();
});

/**
  *Add Plan Country
  */
  $("#addCountryPlan").on( "click", function (e) {
	var country_name = $("#select_country_txt").val();

	$(".form-control").removeAttr("style");
	if( country_name == "" )
	{
		$("#select_country_txt").attr("style", "border: 1px solid red");
		return true;
	}

	var country_amount = $("#country_amount").val();
	if( country_amount == "" )
	{
		$("#country_amount").attr("style", "border: 1px solid red");
		return true;
	}

	var country_id = $('#countryPlan option').filter(function() {
		return this.value == country_name;
	}).data('id');

	$(".country-msg").addClass('d-none');
	var count = $(".country-plan").length;
	$("#country_plan_store").append(
		`<div class="row country-plan p-2 mx-0" style="border-top: 1px #e9ecef solid;">
			<div class="col-md-6"><input type="hidden" name="country_id[${count}]" value="${country_id}" >
			<input type="hidden" name="country_name[${count}]" value="${country_name}" >${country_name}</div>
			<div class="col-md-4"><input type="hidden" name="country_amount[${count}]" value="${country_amount}" >${country_amount}</div>
			<div class="col-md-2"><a href="javascript:void(0)" class="delPlanCountry"><i class="fa fa-times"></i></a></div>
		</div>`
	);

	$("#country_amount").attr( "disabled", true );
	// $(this).addClass('disabled');
	$("#select_country_txt").val(null);
	$("#country_amount").val(null);
});

/**
 * Remove select tag
 */
$("#country_plan_store").on("click", ".delPlanCountry", function () {
	$(this).parent().parent().remove();
	if( $(".country-plan").length == 0 ){
		$(".country-msg").removeClass('d-none');
	}
});

/**
  *Add genre
  */
  $("#addGenre").on( "click", function (e) {
	var tag_name = $("#genre_search_txt").val();
	if (tag_name.length > 0)
	{
		var result = tag_name.split(',');
		$.each( result, function( i, name ){
			$("#genreStore").append(
				`<span class="badge badge-dark title-badge mx-1 mt-2">
				<input type="hidden" name="category_id[]" class="selected-category-ids" value="${$("#select_parent_cat_id").val()}" >${name}
				<a href="javascript:void(0)" class="text-white-50 ml-1 delGenre"><i class="fa fa-times"></i></a></span>`
		    );
		});
	}
	// $(this).addClass('disabled');
	$("#genre_search_txt").val(null);
});

/**
 * Remove select genre
 */
$("#genreStore").on("click", ".delGenre", function () {
	$(this).parent().remove();
});

/**
  *Add sub genre
  */
  $("#addSubGenre").on( "click", function (e) {
	var tag_name = $("#sub_category_search_txt").val();
	if (tag_name.length > 0)
	{
		var result = tag_name.split(',');
		$.each( result, function( i, name ){
			$("#genreSubStore").append(
				`<span class="badge badge-dark title-badge mx-1 mt-2">
				<input type="hidden" name="sub_category_id[]" value="${$("#select_child_cat_id").val()}" >${name}
				<a href="javascript:void(0)" class="text-white-50 ml-1 delSubGenre"><i class="fa fa-times"></i></a></span>`
		    );
		});
	}
	// $(this).addClass('disabled');
	$("#sub_category_search_txt").val(null);
});

/**
 * Remove select sub genre
 */
$("#genreSubStore").on("click", ".delSubGenre", function () {
	$(this).parent().remove();
});

/**
  *Add sub genre
  */
  $("#addNarratorActor").on( "click", function (e) {
	var tag_name = $("#narrator_actor_txt").val();
	if (tag_name.length > 0)
	{
		var result = tag_name.split(',');
		$.each( result, function( i, name ){
			$("#narrator_actor_store").append(
				`<span class="badge badge-dark title-badge mx-1 mt-2">
				<input type="hidden" name="narrator_actor[]" value="${name}" >${name}
				<a href="javascript:void(0)" class="text-white-50 ml-1 delNarrator"><i class="fa fa-times"></i></a></span>`
		    );
		});
	}
	$(this).addClass( 'disabled' );
	$("#narrator_actor_txt").val(null);
});

/**
 * Remove select sub genre
 */
$("#narrator_actor_store").on("click", ".delNarrator", function () {
	$(this).parent().remove();
});

function edit(element) {
	var parent=$(element).parent().parent();
	var placeholder=$(parent).find('.text-info').text();
	//hide label
	$(parent).find('label').hide();
	//show input, set placeholder
	var input=$(parent).find('input[type="text"]');
	$(input).show();
	$(input).attr('placeholder', placeholder);
}

/**
 *
 */
$(".parent-category-id").on( "change", function(){
	var openGenre = $(this).val();
	$(".hide-sub-genere").addClass("d-none");
	$(".open-"+openGenre).removeClass("d-none");
});

/**
 *
 */
//  $(".country-id, .language-id, .title-id").select2();

/**
 *
 */
$("#select_country_txt").on( "change", function(){
	$("#country_amount").removeAttr('disabled');
} );

$("#country_amount").on( "keyup", function(){
	$("#addCountryPlan").removeClass('disabled');
} );

$('.allow-float-number').on( 'keypress', function(event) {
	if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
	  event.preventDefault();
	}
});