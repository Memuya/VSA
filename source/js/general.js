$(document).ready(function() {
	//control marquee for ads
	$('.marquee').marquee({
		duration: 11000,
		duplicated: false,
		pauseOnHover: true
	});

	//add an asterisk to all required input fields on the page
	$("input[required]").each(function() {
		$(this).parent().prev().children().append(' <span class="text-red">*</span>');
	});

	//deals with overlay and universal login box
	$(".login-btn").click(function() {
		$("#overlay").fadeIn(function() {
			$(".login-box").fadeIn(function() {
				$(".input-username").focus();
			});
		});
		return false;
	});

	$("#overlay").click(function() {
		$(this).fadeOut(function() {
			$(".login-box").fadeOut();
		});
		$(".login-box").fadeOut();
	});

	$(".close-btn").click(function() {
		$("#overlay").fadeOut();
		$(".login-box").fadeOut();
	});
	
	//toggle navigation when menu button is clicked (resized button only displays when screen is small)
	$(".resized-menu").click(function() {
		$(".main-nav").slideToggle();
	});

	//
	$(".resized-sidebar-menu").click(function() {
		$(".sidebar").slideToggle();
	});


	//appends "Opens in new tab" title to all links with a target=_blank
	$('a[target="_blank"]').each(function() {
		$(this).attr("title", "Opens in new tab");
	});

	//confirm deletion for any link with .delete-btn attached to it
	//delete link is put in the data-link attribute rather than the href attribute
	$(".delete-btn").click(function() {
		//get delete button info
		var delete_btn = $(this);
		var delete_btn_link = $(this).attr("data-link");

		//hide button
		$(this).fadeOut();

		//create new link
		var cdb = document.createElement("a");

		//add info to link
		$(cdb).html("Confirm").attr("href", delete_btn_link).hide().insertAfter(delete_btn).fadeIn();

		//remove delete button from DOM
		$(delete_btn).remove();

		return false;
	});
});

$(window).resize(function() {
	//hide/show main navigation when window is resized
	if($(window).width() >= 550) {
		$(".main-nav").show();
		$(".sidebar").show();
	} else {
		$(".main-nav").hide();
		$(".sidebar").show();
	}

	if($(window).width() >= 980) {
		$(".sidebar").show();
	} else {
		$(".sidebar").hide();
	}
});