$(document).ready(function() {
	var type = null;
	var student = $("#student-select");
	var general = $("#general-select");
	var corporate = $("#corporate-select");

	//hide the optional requirement for company
	$(".optional-required").hide();

	//slide down membership description area when a membership button is pressed
	/*$(".type-of-membership-btn").click(function() {
		if($("#type-description:hidden"))
			$("#type-desscription").slideDown();
	});*/

	//Checks and un-checks the appropriate radio box depending on which type of membership is selected
	$(student).click(function() {
		type = $('input:radio[value="student"]').val();

		//remove asterisk from the company label
		$(".optional-required").hide();

		//loop through each "type" radio button to uncheck each one that is not the student button
		$('input:radio[name="type"]').each(function() {
			if($(this).val() != "student")
				$(this).attr("checked", false);
		});

		//check the student button
		$('input:radio[value="student"]').attr("checked", "checked");

		//add highlight to button
		$(student).addClass("selected-membership");

		//remove highlight from other buttons
		$(general).removeClass("selected-membership");
		$(corporate).removeClass("selected-membership");

		//load description
		$(".load-desc").hide().load("includes/membership-desc.php?type=1").fadeIn();
	});


	//Checks and un-checks the appropriate radio box depending on which type of membership is selected
	$(general).click(function() {
		type = $('input:radio[value="general"]').val();

		//remove asterisk from the company label
		$(".optional-required").hide();
		
		//loop through each "type" radio button to uncheck each one that is not the general button
		$('input:radio[name="type"]').each(function() {
			if($(this).val() != "general")
				$(this).attr("checked", false);
		});

		//check the general button
		$('input:radio[value="general"]').attr("checked", "checked");

		//add highlight to button
		$(general).addClass("selected-membership");

		//remove highlight from other buttons
		$(student).removeClass("selected-membership");
		$(corporate).removeClass("selected-membership");

		//load description
		$(".load-desc").hide().load("includes/membership-desc.php?type=2").fadeIn();
	});


	//Checks and un-checks the appropriate radio box depending on which type of membership is selected
	$(corporate).click(function() {
		type = $('input:radio[value="corporate"]').val();

		//add asterisk to the company label
		$(".optional-required").show();
		
		//loop through each "type" radio button to uncheck each one that is not the corporate button
		$('input:radio[name="type"]').each(function() {
			if($(this).val() != "corporate")
				$(this).attr("checked", false);
		});


		//check the corporate button
		$('input:radio[value="corporate"]').attr("checked", "checked");

		//add highlight to button
		$(corporate).addClass("selected-membership");

		//remove highlight from other buttons
		$(student).removeClass("selected-membership");
		$(general).removeClass("selected-membership");

		//load description
		$(".load-desc").hide().load("includes/membership-desc.php?type=3").fadeIn();
	});

	//hide the description area
	$("#close-desc-btn").click(function() {
		$("#type-desscription").slideUp();
		return false;
	});
});