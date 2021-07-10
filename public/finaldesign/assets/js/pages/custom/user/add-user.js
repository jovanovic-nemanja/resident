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
			if (current_tab == "#kt_tab_pane_1") {
				if(user_id) {
					swal.fire({
		                text: "Sorry, you already submitted the personal information.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "Ok, got it!",
		                confirmButtonClass: "btn font-weight-bold btn-light"
		            });

		            return;
				}else {
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

					if (!profile_logo) {
						swal.fire({
			                text: "Sorry, please choose the Profile Logo.",
			                icon: "error",
			                buttonsStyling: false,
			                confirmButtonText: "Ok, got it!",
			                confirmButtonClass: "btn font-weight-bold btn-light"
			            });

			            return;
					}if (!firstname) {
						swal.fire({
			                text: "Sorry, please enter the First Name.",
			                icon: "error",
			                buttonsStyling: false,
			                confirmButtonText: "Ok, got it!",
			                confirmButtonClass: "btn font-weight-bold btn-light"
			            });

			            return;
					}if (!lastname) {
						swal.fire({
			                text: "Sorry, please enter the Last Name.",
			                icon: "error",
			                buttonsStyling: false,
			                confirmButtonText: "Ok, got it!",
			                confirmButtonClass: "btn font-weight-bold btn-light"
			            });

			            return;
					}if (!email) {
						swal.fire({
			                text: "Sorry, please enter the Email Address.",
			                icon: "error",
			                buttonsStyling: false,
			                confirmButtonText: "Ok, got it!",
			                confirmButtonClass: "btn font-weight-bold btn-light"
			            });

			            return;
					}if (!birthday) {
						swal.fire({
			                text: "Sorry, please choose the Birthday.",
			                icon: "error",
			                buttonsStyling: false,
			                confirmButtonText: "Ok, got it!",
			                confirmButtonClass: "btn font-weight-bold btn-light"
			            });

			            return;
					}if (!gender) {
						swal.fire({
			                text: "Sorry, please choose the Gender.",
			                icon: "error",
			                buttonsStyling: false,
			                confirmButtonText: "Ok, got it!",
			                confirmButtonClass: "btn font-weight-bold btn-light"
			            });

			            return;
					}if (!phone_number) {
						swal.fire({
			                text: "Sorry, please enter the Phone Number.",
			                icon: "error",
			                buttonsStyling: false,
			                confirmButtonText: "Ok, got it!",
			                confirmButtonClass: "btn font-weight-bold btn-light"
			            });

			            return;
					}if (!street1) {
						swal.fire({
			                text: "Sorry, please enter the Street.",
			                icon: "error",
			                buttonsStyling: false,
			                confirmButtonText: "Ok, got it!",
			                confirmButtonClass: "btn font-weight-bold btn-light"
			            });

			            return;
					}if (!city) {
						swal.fire({
			                text: "Sorry, please enter the City.",
			                icon: "error",
			                buttonsStyling: false,
			                confirmButtonText: "Ok, got it!",
			                confirmButtonClass: "btn font-weight-bold btn-light"
			            });

			            return;
					}if (!zip_code) {
						swal.fire({
			                text: "Sorry, please enter the Zip Code.",
			                icon: "error",
			                buttonsStyling: false,
			                confirmButtonText: "Ok, got it!",
			                confirmButtonClass: "btn font-weight-bold btn-light"
			            });

			            return;
					}if (!state) {
						swal.fire({
			                text: "Sorry, please enter the State.",
			                icon: "error",
			                buttonsStyling: false,
			                confirmButtonText: "Ok, got it!",
			                confirmButtonClass: "btn font-weight-bold btn-light"
			            });

			            return;
					}

					var formData = new FormData();
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
									$('#user_id').val(result.data.id);
								});
							}
						}
					});
				}
			}if (current_tab == "#kt_tab_pane_2") {
				if(!user_id) {
					swal.fire({
		                text: "Sorry, Please enter and submit the personal information before the POA information submitting.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "Ok, got it!",
		                confirmButtonClass: "btn font-weight-bold btn-light"
		            });

		            return;
				}else {
					var poa_type = $('#kt_tab_pane_2 .physician_medical_dentist_type').val();
					var poa_firstname = $('#kt_tab_pane_2 input[name="poa_firstname"]').val();
					var poa_lastname = $('#kt_tab_pane_2 input[name="poa_lastname"]').val();
					var poa_street1 = $('#kt_tab_pane_2 input[name="poa_street1"]').val();
					var poa_street2 = $('#kt_tab_pane_2 input[name="poa_street2"]').val();
					var poa_city = $('#kt_tab_pane_2 input[name="poa_city"]').val();
					var poa_zip_code = $('#kt_tab_pane_2 input[name="poa_zip_code"]').val();
					var poa_state = $('#kt_tab_pane_2 input[name="poa_state"]').val();
					var poa_home_phone = $('#kt_tab_pane_2 input[name="poa_home_phone"]').val();
					var poa_cell_phone = $('#kt_tab_pane_2 input[name="poa_cell_phone"]').val();
					
					if (!poa_firstname) {
						swal.fire({
			                text: "Sorry, please enter the First Name.",
			                icon: "error",
			                buttonsStyling: false,
			                confirmButtonText: "Ok, got it!",
			                confirmButtonClass: "btn font-weight-bold btn-light"
			            });

			            return;
					}if (!poa_lastname) {
						swal.fire({
			                text: "Sorry, please enter the Last Name.",
			                icon: "error",
			                buttonsStyling: false,
			                confirmButtonText: "Ok, got it!",
			                confirmButtonClass: "btn font-weight-bold btn-light"
			            });

			            return;
					}if (!poa_street1) {
						swal.fire({
			                text: "Sorry, please enter the Street.",
			                icon: "error",
			                buttonsStyling: false,
			                confirmButtonText: "Ok, got it!",
			                confirmButtonClass: "btn font-weight-bold btn-light"
			            });

			            return;
					}if (!poa_city) {
						swal.fire({
			                text: "Sorry, please enter the City.",
			                icon: "error",
			                buttonsStyling: false,
			                confirmButtonText: "Ok, got it!",
			                confirmButtonClass: "btn font-weight-bold btn-light"
			            });

			            return;
					}if (!poa_zip_code) {
						swal.fire({
			                text: "Sorry, please enter the Zip Code.",
			                icon: "error",
			                buttonsStyling: false,
			                confirmButtonText: "Ok, got it!",
			                confirmButtonClass: "btn font-weight-bold btn-light"
			            });

			            return;
					}if (!poa_state) {
						swal.fire({
			                text: "Sorry, please enter the State.",
			                icon: "error",
			                buttonsStyling: false,
			                confirmButtonText: "Ok, got it!",
			                confirmButtonClass: "btn font-weight-bold btn-light"
			            });

			            return;
					}

					var formData = new FormData();
					formData.append("user_id", user_id);
					formData.append("poa_type", poa_type);
					formData.append("poa_firstname", poa_firstname);
					formData.append("poa_lastname", poa_lastname);
					formData.append("poa_street1", poa_street1);
					formData.append("poa_street2", poa_street2);
					formData.append("poa_city", poa_city);
					formData.append("poa_zip_code", poa_zip_code);
					formData.append("poa_state", poa_state);
					formData.append("poa_home_phone", poa_home_phone);
					formData.append("poa_cell_phone", poa_cell_phone);

					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});

					$.ajax({
						url: "/resident/saveResidentPOAinfo",
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
								});
							}
						}
					});
				}
			}
		}
	});
});
