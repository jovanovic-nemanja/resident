"use strict";

// Class Definition
var KTAddUser = function () {
	// Private Variables
	var _avatar;

	var _initAvatar = function () {
		_avatar = new KTImageInput('kt_user_add_avatar');
	}

	return {
		// public functions
		init: function () {
			_initAvatar();
		}
	};
}();

jQuery(document).ready(function () {
	KTAddUser.init();

	$('#submit-resident-info').click(function() {
		var user_id = $('#user_id').val();
		var current_tab = $("ul.nav-tabs li a.active").attr('href');
		if(current_tab) {
			// tab 1
			var profile_logo_url = $('#kt_tab_pane_1 .image-input-wrapper').css('background-image');
			var profile_logo = profile_logo_url.replace('url(','').replace(')','').replace(/\"/gi, "");
			var firstname = $('#kt_tab_pane_1 input[name="firstname"]').val();
			var middlename = $('#kt_tab_pane_1 input[name="middlename"]').val();
			var lastname = $('#kt_tab_pane_1 input[name="lastname"]').val();
			var email = $('#kt_tab_pane_1 input[name="email"]').val();
			var birthday = $('#kt_tab_pane_1 input[name="birthday"]').val();
			var gender = $('#kt_tab_pane_1 select[name="gender"]').val();
			var phone_number = $('#kt_tab_pane_1 input[name="phone_number"]').val();
			var street1 = $('#kt_tab_pane_1 input[name="street1"]').val();
			var street2 = $('#kt_tab_pane_1 input[name="street2"]').val();
			var city = $('#kt_tab_pane_1 input[name="city"]').val();
			var zip_code = $('#kt_tab_pane_1 input[name="zip_code"]').val();
			var state = $('#kt_tab_pane_1 input[name="state"]').val();
			var date_admitted = $('#kt_tab_pane_1 input[name="date_admitted"]').val();
			var ssn = $('#kt_tab_pane_1 input[name="ssn"]').val();
			var primary_language = $('#kt_tab_pane_1 input[name="primary_language"]').val();

			// Validation part
				// tab 1
				if (!profile_logo || profile_logo == "none") {
					swal.fire({
		                text: "Sorry, please choose the Profile Logo of the Personal Information.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "Ok, got it!",
		                confirmButtonClass: "btn font-weight-bold btn-light"
		            });

		            return;
				}if (!firstname) {
					swal.fire({
		                text: "Sorry, please enter the First Name of the Personal Information.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "Ok, got it!",
		                confirmButtonClass: "btn font-weight-bold btn-light"
		            });

		            return;
				}if (!lastname) {
					swal.fire({
		                text: "Sorry, please enter the Last Name of the Personal Information.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "Ok, got it!",
		                confirmButtonClass: "btn font-weight-bold btn-light"
		            });

		            return;
				}if (!email) {
					swal.fire({
		                text: "Sorry, please enter the Email Address of the Personal Information.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "Ok, got it!",
		                confirmButtonClass: "btn font-weight-bold btn-light"
		            });

		            return;
				}if (!birthday) {
					swal.fire({
		                text: "Sorry, please choose the Birthday of the Personal Information.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "Ok, got it!",
		                confirmButtonClass: "btn font-weight-bold btn-light"
		            });

		            return;
				}if (!gender) {
					swal.fire({
		                text: "Sorry, please choose the Gender of the Personal Information.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "Ok, got it!",
		                confirmButtonClass: "btn font-weight-bold btn-light"
		            });

		            return;
				}if (!phone_number) {
					swal.fire({
		                text: "Sorry, please enter the Phone Number of the Personal Information.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "Ok, got it!",
		                confirmButtonClass: "btn font-weight-bold btn-light"
		            });

		            return;
				}if (!street1) {
					swal.fire({
		                text: "Sorry, please enter the Street of the Personal Information.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "Ok, got it!",
		                confirmButtonClass: "btn font-weight-bold btn-light"
		            });

		            return;
				}if (!city) {
					swal.fire({
		                text: "Sorry, please enter the City of the Personal Information.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "Ok, got it!",
		                confirmButtonClass: "btn font-weight-bold btn-light"
		            });

		            return;
				}if (!zip_code) {
					swal.fire({
		                text: "Sorry, please enter the Zip Code of the Personal Information.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "Ok, got it!",
		                confirmButtonClass: "btn font-weight-bold btn-light"
		            });

		            return;
				}if (!state) {
					swal.fire({
		                text: "Sorry, please enter the State of the Personal Information.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "Ok, got it!",
		                confirmButtonClass: "btn font-weight-bold btn-light"
		            });

		            return;
				}
			// end validation part

			var formData = new FormData();

			// tab 1
			formData.append("profile_logo", profile_logo);
			formData.append("firstname", firstname);
			formData.append("middlename", middlename);
			formData.append("lastname", lastname);
			formData.append("email", email);
			formData.append("birthday", birthday);
			formData.append("gender", gender);
			formData.append("phone_number", phone_number);
			formData.append("street1", street1);
			formData.append("street2", street2);
			formData.append("city", city);
			formData.append("zip_code", zip_code);
			formData.append("state", state);
			formData.append("date_admitted", date_admitted);
			formData.append("ssn", ssn);
			formData.append("primary_language", primary_language);

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$.ajax({
				url: "/resident/saveResidentPersonalinfo",
				type: 'POST',
				contentType: false,
			    cache: false,
			    processData: false,
				data: formData,
				success: function(result, status) {
					if (result.status == "failed") {
						swal.fire({
			                text: result.msg,
			                icon: "error",
			                buttonsStyling: false,
			                confirmButtonText: "Ok, got it!",
			                confirmButtonClass: "btn font-weight-bold btn-light"
			            }).then(function() {
							KTUtil.scrollTop();
						});
					}else{
						swal.fire({
			                text: result.msg,
			                icon: "success",
			                buttonsStyling: false,
			                confirmButtonText: "Ok, got it!",
			                confirmButtonClass: "btn font-weight-bold btn-light-primary"
			            }).then(function() {
							KTUtil.scrollTop();
							window.location.href = result.url;
						});
					}
				}
			});
		}
	});
});
