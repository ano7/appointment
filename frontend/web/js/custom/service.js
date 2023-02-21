// JavaScript Document
/**
 *Function to get Service Instructor.
 */
function getServiceInstructor(Service_ID) {
	var dataString = {
	  'Service_ID': Service_ID,
	};
	$.ajax({
		type: 'post',
		url: BASE_URL + "/services/our-service/instructor",
		data: dataString,
		cache: false, 
		success: function(data) {
			$("#service-instructor").html(data);
			$('html, body').animate({
				scrollTop: $("#service-instructor").offset().top
			}, 500);
		}
	});
}
/**
 *Function to get Appointment Calender.
 */
function getAppointmentCalender(Instructor_ID) {
    $("#calender-div").removeClass('d-none');
	$("#Instructor_ID").val(Instructor_ID);
	changedate('current', 'full');
	$('html, body').animate({ scrollTop: $("#calender-div").offset().top }, 500);
}
/**
 *Function to book Appointment.
 */
function bookAppointment(Timeslot_ID) {
	var dataString = {
	  'Timeslot_ID': Timeslot_ID,
	  'Instructor_ID': $('#Instructor_ID').val(),
	  'Service_ID': $('#Service_ID').val(),
	  'Appointment_Date': $('#Appointment_Date').val()
	};
	console.log(dataString);
	$.confirm({
		title: 'Confirm!',
		content: 'Are you ready to submit?',
		buttons: {
			confirm: function () {
				$.ajax({
						url: BASE_URL + "/services/our-service/submit",
						type: 'post',
						dataType: 'json',
						data: dataString,
						cache: false,
					})
					.done(function (response) {
						if (response.data.success == true) {
							$.alert({
								title: 'Success!',
								content: response.data.message,
							});
							$("#instructor-info").modal('hide');
						} else {
							$.alert({
								title: 'Error!',
								content: response.data.message,
							});
						}
					})
					.fail(function () {
						console.log("error");
					});
			},
			cancel: function () {
			},
		}
	});
}
