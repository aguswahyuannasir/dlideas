(function( factory ) {
	if ( typeof define === "function" && define.amd ) {
		define( ["jquery", "../jquery.validate"], factory );
	} else {
		factory( jQuery );
	}
}(function( $ ) {

/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: ID (Indonesia; Indonesian)
 */
$.extend($.validator.messages, {
	required: "Columns required.",
	remote: "Please correct this column.",
	email: "Please enter the correct email format.",
	url: "Please enter the correct URL format.",
	date: "Please enter the correct date format.",
	dateISO: "Please enter the correct date format (ISO).",
	number: "Please enter the correct number.",
	digits: "Please enter numbers only.",
	creditcard: "Please enter the correct credit card format.",
	equalTo: "Please enter the same value as before.",
	maxlength: $.validator.format("Input is limited to {0} characters only."),
	minlength: $.validator.format("Input is not less than {0} characters."),
	rangelength: $.validator.format("Character length allowed between {0} and {1} characters."),
	range: $.validator.format("Please enter a value between {0} and {1}."),
	max: $.validator.format("Please enter a value smaller or equal to {0}."),
	min: $.validator.format("Please enter a value greater than or equal to {0}.")
});

}));