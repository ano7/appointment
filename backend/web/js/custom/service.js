// JavaScript Document
/**
*Function to show categoroes listing.
*/
function manageCategories(User_ID) {
	var dataString = 'User_ID=' + User_ID;
	onStartLoader();
	$.ajax({
		type: 'post',
		url: BASE_URL + "/services/category/index",
		data: dataString,
		cache: false,
		success: function(data) {
			$("#category-info").modal('show');
			$(".modal-content").html(data);
			$('.selectpicker').selectpicker('refresh');
			onStopLoader(); 
		}
	});
}
/**
*Function to show popup to add/update category info.
*/
function addUpdateCategory(Category_ID) {
	var dataString = 'Category_ID=' + Category_ID;
	onStartLoader();
	$.ajax({
		type: 'post',
		url: BASE_URL + "/services/category/create-update",
		data: dataString,
		cache: false,
		success: function(data) {
			$("#category-info").modal('show');
			$(".modal-content").html(data);
			$('.selectpicker').selectpicker('refresh');
			onStopLoader(); 
		} 
	});
}
/**
*Function to submit category info.
*/
function submitCategoryData() {
	$('#create_update_category').yiiActiveForm('validate');
	if ($("#create_update_category").find(".has-error").length) {
		return false; 
	}
	event.preventDefault(); // stopping submitting
	event.stopImmediatePropagation();
	var data = $("#create_update_category").serializeArray();
	var url = $("#create_update_category").attr('action');
	var formData = new FormData($('#create_update_category')[0]);
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
							$("#category-info").modal('hide');
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
*Function to show popup to add/update Service info.
*/
function addUpdateServicesInfo(SERVICE_ID) {
	var dataString = 'SERVICE_ID=' + SERVICE_ID;
	onStartLoader();
	$.ajax({
		type: 'post',
		url: BASE_URL + "/services/default/create-update",
		data: dataString,
		cache: false,
		success: function(data) {
			$("#service-info").modal('show');
			$(".service-info").html(data);
			$('.selectpicker').selectpicker('refresh');
			onStopLoader(); 
		} 
	});
}
/**
*Function to submit service info.
*/
function submitServiceData() {
	$('#service_form').yiiActiveForm('validate');
	if ($("#service_form").find(".has-error").length) {
		return false;
	}
	event.preventDefault(); // stopping submitting
	event.stopImmediatePropagation();
	var data = $("#service_form").serializeArray();
	var url = $("#service_form").attr('action');
	var formData = new FormData($('#service_form')[0]);
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