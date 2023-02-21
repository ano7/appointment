// JavaScript Document
/**
*Function to show popup to add/update Customer info.
*/
function addUpdateCustomerInfo(User_ID) {
	var dataString = 'User_ID=' + User_ID;
	onStartLoader();
	$.ajax({
		type: 'post',
		url: BASE_URL + "/customer/default/create",
		data: dataString,
		cache: false,
		success: function(data) {
			$("#customer-info").modal('show');
			$(".modal-content").html(data);
			$('.selectpicker').selectpicker('refresh');
			onStopLoader(); 
		}
	});
}
/**
*Function to submit Customer Data info.
*/
function submitCustomerRegisterData() {
	$('#customer_registeration_form').yiiActiveForm('validate');
	if ($("#customer_registeration_form").find(".has-error").length) {
		return false;
	}
	event.preventDefault(); // stopping submitting
	event.stopImmediatePropagation();
	var data = $("#customer_registeration_form").serializeArray();
	var url = $("#customer_registeration_form").attr('action');
	var formData = new FormData($('#customer_registeration_form')[0]);
	$.confirm({
		title: 'Confirm!',
		content: 'Are you ready to submit?',
		buttons: {
			confirm: function () {
				onStartLoader();
				$.ajax({
						url: url,
						type: 'post',
						enctype: 'multipart/form-data',
						dataType: 'json',
						data: formData,
						cache: false,
						processData: false,
						contentType: false,
					})
					.done(function (response) {
						if (response.data.success == true) {
							onStopLoader();
							$.alert({
								title: 'Success!',
								content: response.data.message,
							});
							$("#customer-info").modal('hide');
						} else {
							onStopLoader();
							$.alert({
								title: 'Error!',
								content: response.data.message,
							});
						}
					})
					.fail(function () {
						onStopLoader();
						console.log("error");
					});
			},
			cancel: function () {
				onStopLoader();
			},
		}
	});
}
/**
*Function to show popup to view Customer info.
*/
function customerDetail(User_ID) {
	var dataString = 'User_ID=' + User_ID;
	onStartLoader();
	$.ajax({
		type: 'post',
		url: BASE_URL + "/customer/default/view",
		data: dataString,
		cache: false,
		success: function(data) {
			$("#customer-info").modal('show');
			$(".modal-content").html(data);
			$('.selectpicker').selectpicker('refresh');
			onStopLoader(); 
		}
	});
}