$(document).ready(function(){
	if (window.location.href.indexOf("addContactPersonAddress") > -1) {
		$("#selectAButton").removeClass( "btn-secondary" ).addClass( "btn-primary" );
		$("#selectCButton").removeClass( "btn-primary" ).addClass( "btn-secondary" );
		$("#selectCPButton").removeClass( "btn-primary" ).addClass( "btn-secondary" );
		$("#cardTitle").text('Add Address');
		$("#cardDescription").text('Add address of contact person');
		$("#comForm").hide();
		$("#cPersonForm").hide();
		$("#addressForm").show();
	} else if (window.location.href.indexOf("addContactPerson") > -1) {
		$("#selectCPButton").removeClass( "btn-secondary" ).addClass( "btn-primary" );
		$("#selectAButton").removeClass( "btn-primary" ).addClass( "btn-secondary" );
		$("#selectCButton").removeClass( "btn-primary" ).addClass( "btn-secondary" );
		$("#cardTitle").text('Add Contact Person');
		$("#cardDescription").text('Add contact person details below');
		$("#comForm").hide();
		$("#cPersonForm").show();
		$("#addressForm").hide();
	} else if (window.location.href.indexOf("addCompany") > -1) {
		$("#selectCButton").removeClass( "btn-secondary" ).addClass( "btn-primary" );
		$("#selectCPButton").removeClass( "btn-primary" ).addClass( "btn-secondary" );
		$("#selectAButton").removeClass( "btn-primary" ).addClass( "btn-secondary" );
		$("#cardTitle").text('Add Company');
		$("#cardDescription").text('Add your company below');
		$("#comForm").show();
		$("#addressForm").hide();
		$("#cPersonForm").hide();
	}
	$("#selectCPButton").click(function(){
		$(this).removeClass( "btn-secondary" ).addClass( "btn-primary" );
		$("#selectAButton").removeClass( "btn-primary" ).addClass( "btn-secondary" );
		$("#selectCButton").removeClass( "btn-primary" ).addClass( "btn-secondary" );
		$("#cardTitle").text('Add Contact Person');
		$("#cardDescription").text('Add contact person details below');
		$("#comForm").hide();
		$("#cPersonForm").show();
		$("#addressForm").hide();
	});
	$("#selectAButton").click(function(){
		$(this).removeClass( "btn-secondary" ).addClass( "btn-primary" );
		$("#selectCButton").removeClass( "btn-primary" ).addClass( "btn-secondary" );
		$("#selectCPButton").removeClass( "btn-primary" ).addClass( "btn-secondary" );
		$("#cardTitle").text('Add Address');
		$("#cardDescription").text('Add address of contact person');
		$("#comForm").hide();
		$("#cPersonForm").hide();
		$("#addressForm").show();
	});
	$("#selectCButton").click(function(){
		$(this).removeClass( "btn-secondary" ).addClass( "btn-primary" );
		$("#selectCPButton").removeClass( "btn-primary" ).addClass( "btn-secondary" );
		$("#selectAButton").removeClass( "btn-primary" ).addClass( "btn-secondary" );
		$("#cardTitle").text('Add Company');
		$("#cardDescription").text('Add your company below');
		$("#comForm").show();
		$("#addressForm").hide();
		$("#cPersonForm").hide();
	});
	$(document).on('click', '.editCompany', function () {
		$('#editCompany').find("input,textarea,select").val('');
		$('#companyId').val($(this).data('id'));
		$('#comUpdateName').val($("#cNameRow"+$(this).data('id')).text());
		$('#comUpdateAddress').val($("#cAddressRow"+$(this).data('id')).text());
		$('#comUpdateEmail').val($("#cEmailRow"+$(this).data('id')).text());
		$('#comUpdatePhone').val($("#cPhoneRow"+$(this).data('id')).text());
		$('#editCompany').modal('toggle');
	});
	$( "#updateCompanyButton" ).click(function(event){
		var isCorrect = 1;
		var message = '';
		var name = $.trim($('#comUpdateName').val());
		var address = $.trim($('#comUpdateAddress').val());
		var email = $.trim($('#comUpdateEmail').val());
		var phone = $.trim($('#comUpdatePhone').val());
		var phoneLength = $("#comUpdatePhone").val().length;

		// Check if Company name is empty or not
		if (name  === '') {
			isCorrect = 0;
			message = 'Company Name is empty.';
		} else if (address  === '') {
			isCorrect = 0;
			message = 'Address is empty.';
		} else if (email  === '') {
			isCorrect = 0;
			message = 'Email is empty.';
		} else if (phone  === '') {
			isCorrect = 0;
			message = 'Phone is empty.';
		} else if(!validateEmail(email)) {
			isCorrect = 0;
			message = 'Enter valid email.';
		} else if(!$.isNumeric(phone)) {
			isCorrect = 0;
			message = 'Phone Number must be a numeric.';
		} else if (phoneLength !== 11) {
			isCorrect = 0;
			alert('Phone Number length must be equal to 11 digits.');
		}
		if (isCorrect) {
			$("#comUpdateForm").submit();
		} else {
			alert(message);
			event.preventDefault();
		}
	});
	$(document).on('click', '.editPerson', function () {
		$('#editPerson').find("input,textarea,select").val('');
		$('#personId').val($(this).data('id'));
		$('#pUpdateName').val($("#pNameRow"+$(this).data('id')).text());
		let option = $("#pCNameRow"+$(this).data('id')).text();
		$("#pUpdateCompany option").each(function() {
			if($(this).text() == option) {
				$(this).attr('selected', true);
			} else {
				$(this).attr('selected', false);
			}
		});
		if($("#pDefault"+$(this).data('id')).text() == 'Yes') {
			$("#makeDefaultUpdate").attr('checked', true);
		} else {
			$("#makeDefaultUpdate").attr('checked', false);
		}
		$('#editPerson').modal('toggle');
	});
	$( "#updatePersonButton" ).click(function(event){
		var isCorrect = 1;
		var message = '';
		var name = $.trim($('#pUpdateName').val());
		var pCompany = $.trim($('#pUpdateCompany').val());

		// Check if Person name is empty or not
		if (name  === '') {
			isCorrect = 0;
			message = 'Person Name is empty.';
		} else if (pCompany  === '') {
			isCorrect = 0;
			message = 'Company is empty.';
		}
		if (isCorrect) {
			$("#personUpdateForm").submit();
		} else {
			alert(message);
			event.preventDefault();
		}
	});
	$(document).on('click', '.editAddress', function () {
		$('#editAddress').find("input,textarea,select").val('');
		$('#pUpdateAddressId').val($(this).data('id'));
		$('#pUpdateAddress').val($("#pAddressRow"+$(this).data('id')).text());
		$('#editAddress').modal('toggle');
	});
	$( "#updatePersonAddressButton" ).click(function(event){
		var isCorrect = 1;
		var message = '';
		var address = $.trim($('#pUpdateAddress').val());

		// Check if Address is empty or not
		if (address  === '') {
			isCorrect = 0;
			message = 'Address is empty.';
		}
		if (isCorrect) {
			$("#editAddressForm").submit();
		} else {
			alert(message);
			event.preventDefault();
		}
	});
});
function validateEmail(email) {
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	return emailReg.test(email);
}
