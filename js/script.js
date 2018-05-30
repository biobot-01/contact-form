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
            contactEmail: {
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
            contactMessage: {
                required: true,
                minlength: 5
            }
        },
        // Validation error messages to display for each rule
        messages: {
            fullName: {
                required: "Please enter your full name",
                minlength: "Your name must consist of at least 4 characters"
            },
            contactEmail: {
                required: "Please enter a valid email address",
                email: "Your email address must be in the format of your@email.com"
            },
            phoneNumber: {
                phonesUK: "Please enter a valid UK landline or mobile number"
            },
            subject: {
                required: "Please enter the nature of your enquiry",
                minlength: "The subject must consist of at least 4 characters"
            },
            contactMessage: {
                required: "We need to know what you want. Tell us here",
                minlength: "Message is too short. Please provide as much detail as possible"
            }
        },
        errorElement: "em",
        errorPlacement: function(error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");
            // Add `has-feedback` class to the parent fieldset.div
            // in order to add icons to inputs
            element.parents("fieldset div").addClass("has-feedback");

            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.parent("label"));
            } else {
                error.insertAfter(element);
            }

            // Add the i element, if doesn't exist,
            // and apply the icon classes to it.
            if (!element.next("i")[0]) {
                $('<i class="fas fa-times form-control-feedback"></i>').insertAfter(element);
            }
        },
        success: function(label, element) {
            // Add the i element, if doesn't exists,
            // and apply the icon classes to it.
            if (!$(element).next("i")[0]) {
                $('<i class="fas fa-check form-control-feedback"></i>').insertAfter($(element));
            }
        },
        highlight: function(element, errorClass, validClass) {
            $(element).parents('fieldset div').addClass("has-error").removeClass("has-success");
            $(element).next('i').addClass("fa-times").removeClass("fa-check");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('fieldset div').addClass("has-success").removeClass("has-error");
            $(element).next('i').addClass("fa-check").removeClass("fa-times");
        },
        submitHandler: function(form) {
            if ($('#contactForm').valid()) {
                $.ajax({
                    type: 'POST',
                    url: $('#contactForm').attr('action'),
                    dataType: 'json',
                    data: $('#contactForm').serialize(),
                    beforeSend: function() {
                        $('#loading i').addClass("spin");
                        $('#loading').show();
                    },
                    success: function(data) {
                        $('#formMessages').empty().append(data.text).show();
                    },
                    error: function() {
                        $('#loading').hide();
                        $("#formMessages span").html("An error occurred when trying to send the form.");
                        $('#formMessages').show();
                    },
                    complete: function() {
                        $('#loading i').removeClass("spin")
                        $('#loading').hide();
                    }
                })
            }
        }
    });
});
