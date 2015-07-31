$(document).ready(function() {
	$(".optional-required").hide();

	$(".type-of-membership-btn").click(function() {
		//if description is hidden, display it
		if($("#type-description:hidden"))
			$("#type-description").slideDown();

		//return all radio buttons to default colour
		$(".type-of-membership-btn").each(function() {
			$(this).css("background", "#B20000");
		});

		//update clicked button to change backgroud colour
		$(this).css("background", "red");

		//load descriptions
		if($(this).find("input[type=radio]").val() == "student") {
			$(".load-desc").hide().load("includes/membership-desc.php?type=1").fadeIn();
			//remove asterisk to the company label
			$(".optional-required").hide();
			$(".website-field").hide();
		}
		else if($(this).find("input[type=radio]").val() == "general") {
			$(".load-desc").hide().load("includes/membership-desc.php?type=2").fadeIn();
			//remove asterisk to the company label
			$(".optional-required").hide();
			$(".website-field").hide();
		}
		else if($(this).find("input[type=radio]").val() == "corporate") {
			$(".load-desc").hide().load("includes/membership-desc.php?type=3").fadeIn();
			//add asterisk to the company label
			$(".optional-required").show();
			$(".website-field").show();
		}
	});


	//add an asterisk to all required input fields on the page
	$("input[required]").each(function() {
		$(this).parent().prev().children().append(' <span class="text-red">*</span>');
	});

	//hide the description area
	$("#close-desc-btn").click(function() {
		$("#type-description").slideUp();
		return false;
	});
});