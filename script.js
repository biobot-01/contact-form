$(document).ready(function() {
    // Contact form validation
	// Initialize form validation on contact form
	$('#contactForm').validate({
		// Specify validation rules
		rules: {
			fullName: {
				required: true,
				minlength: 4
			},
			email: {
				required: true,
				email: true
			},
			phoneNumber: {
				phonesUK: true
			},
			subject: {
				required: true,
				minlength: 4
			},
			message: {
				required: true,
				minlength: 5
			}
		},
		// Validation error messages to display for each rule
		messages: {
			fullName: {
				required: "Please enter your full name",
				minlength: $.validator.format("At least {0} characters required!")
			},
			email: {
				required: "We need your email address to contact you",
				email: "Your email address must be in the format of name@domain.com"
			},
			phoneNumber: {
				phonesUK: "Please enter a valid UK landline or mobile number"
			},
			subject: {
				required: "Please enter the nature of your enquiry",
				minlength: $.validator.format("At least {0} characters required!")
			},
			message: {
				required: "We need to know what you want. Tell us here",
				minlength: "Message is too short. Please provide as much detail as possible"
			}
		},
		errorElement: "em",
		errorPlacement: function(error, element) {
			error.addClass("panel red");
			element.parents("fieldset").addClass("red");
			
			if (!element.next("span")[0]) {
				$("<span class='fa fa-close form-control-feedback'></span>").insertAfter(element);
			}
		},
		success: function(label, element) {
        	// Add the span element, if doesn't exists, and apply the icon classes to it.
        	if (!$(element).next("span")[0]) {
            	$("<span class='fa fa-check form-control-feedback'></span>").insertAfter($(element));
			}
		},
		highlight: function(element, errorClass, validClass) {
			$(element).parents("fieldset").addClass("red").removeClass("green");
			$(element).next("span").addClass("fa-close").removeClass("fa-check");
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents("fieldset").addClass("green").removeClass("red");
			$(element).next("span").addClass("fa-check").removeClass("fa-close");
		}
	});
	
	$('#contactForm').on('submit', function(e) {
		e.preventDefault();
		if ($('#contactForm').valid()) {
			$.ajax({
				type: 'POST',
				url: $('#contactForm').attr('action'),
				dataType: 'json',
				data: $('#contactForm').serialize(),
				beforeSend: function() {
					$('#loading').show();
				},
				success: function(data) {
					$("#formMessages").empty().append(data.text).show();
				},
				error: function() {
					$('#loading').hide();
					$("#formMessages span").html("An error occurred when trying to send the form.");
					$('#formMessages').show();
				},
				complete: function() {
					$('#loading').hide();
				}
			})
		}
	});
});
