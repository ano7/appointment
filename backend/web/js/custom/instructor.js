// JavaScript Document
/**
*Function to show popup to add/update Instructor info.
*/
function addUpdateInstructorInfo(User_ID) {
	var dataString = 'User_ID=' + User_ID;
	onStartLoader();
	$.ajax({
		type: 'post',
		url: BASE_URL + "/instructor/default/create-update",
		data: dataString,
		cache: false,
		success: function(data) {
			$("#instructor-info").modal('show');
			$(".modal-content").html(data);
			$('.selectpicker').selectpicker('refresh');
			onStopLoader(); 
		}
	});
}
/**
*Function to submit Instructor Register Data info.
*/
function submitInstructorRegisterData() {
	$('#instructor_registeration_form').yiiActiveForm('validate');
	if ($("#instructor_registeration_form").find(".has-error").length) {
		return false;
	}
	event.preventDefault(); // stopping submitting
	event.stopImmediatePropagation();
	var data = $("#instructor_registeration_form").serializeArray();
	var url = $("#instructor_registeration_form").attr('action');
	var formData = new FormData($('#instructor_registeration_form')[0]);
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
							$("#instructor-info").modal('hide');
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
*Function to show popup to view Instructor info.
*/
function instructorDetail(User_ID) {
	var dataString = 'User_ID=' + User_ID;
	onStartLoader();
	$.ajax({
		type: 'post',
		url: BASE_URL + "/instructor/default/view",
		data: dataString,
		cache: false,
		success: function(data) {
			$("#instructor-info").modal('show');
			$(".modal-content").html(data);
			$('.selectpicker').selectpicker('refresh');
			onStopLoader(); 
		}
	});
}
/**
*Function to show popup to add break info.
*/
function addBreak(Day_ID) {
	var dataString = 'Day_ID=' + Day_ID;
	onStartLoader();
	$.ajax({
		type: 'post',
		url: BASE_URL + "/instructor/work-hour/create-break",
		data: dataString,
		cache: false,
		success: function(data) {
			$("#break-info").modal('show');
			$(".modal-content").html(data);
			$('.selectpicker').selectpicker('refresh');
			onStopLoader(); 
		} 
	});
}
/**
 *Function to get end time slot on the basis of Start Time.
 */
function getEndTimeSlot(Break_ID) {
	var dataString = 'Break_Start_Time=' + $('#Break_Start_Time_'+Break_ID).val();
	onStartLoader();
    $.ajax({
        type: 'post',
        url: BASE_URL + "/instructor/work-hour/end-time-slot",
        data: dataString,
        dataType: 'json', 
        cache: false,
        success: function(data) {
			$("#Break_End_Time_"+Break_ID).empty();
			$.each(data, function(key, value) {
                $("#Break_End_Time_"+Break_ID).append('<option value="' + key + '">' + value + '</option>');
            });
            $('#Break_End_Time_'+Break_ID).selectpicker('refresh');
			onStopLoader();
        }
    });
	return false;
}
/**
 *Function to get break data of Instructor.
 */
function getBreak(Day_ID) {
	var dataString = {
	  'Day_ID': Day_ID,
	};
	$.ajax({
		type: 'post',
		url: BASE_URL + "/instructor/work-hour/view-break",
		data: dataString,
		cache: false, 
		success: function(data) {
			$("#expand_break_hour_"+Day_ID).html(data);
			$('.selectpicker').selectpicker('refresh');
		}
	});
}
/**
*Function to submit break info.
*/
function submitBreakData() {
	$('#create_break').yiiActiveForm('validate');
	if ($("#create_break").find(".has-error").length) {
		return false; 
	}
	event.preventDefault(); // stopping submitting
	event.stopImmediatePropagation();
	var data = $("#create_break").serializeArray();
	var url = $("#create_break").attr('action');
	var formData = new FormData($('#create_break')[0]);
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
							$("#break-info").modal('hide');
							getBreak(response.data.Day_ID);
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
*Function to submit Instructor Work Hour Data info.
*/
function submitWorkHourData() {
	$('#create_update_workhour').yiiActiveForm('validate');
	if ($("#create_update_workhour").find(".has-error").length) {
		return false;
	}
	event.preventDefault(); // stopping submitting
	event.stopImmediatePropagation();
	var data = $("#create_update_workhour").serializeArray();
	var url  = $("#create_update_workhour").attr('action');
	var formData = new FormData($('#create_update_workhour')[0]);
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