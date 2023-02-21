// JavaScript Document

/**
 *Function to get Appointment Calender.
 */
$( document ).ready(function() {
   changedate('current', 'full');
   $('html, body').animate({ scrollTop: $("#calender-div").offset().top }, 500);
});
// Get appointment detail for booking
function loadAppointment(Appointment_Date) {
	var dataString = {
	  'Appointment_Date': Appointment_Date
	};
	$.ajax({
		type: 'post',
		url: BASE_URL + "/appointment/calendar/view",
		data: dataString,
		cache: false, 
		success: function(data) {
			$("#partial_view_container").html(data);
			$('html, body').animate({
				scrollTop: $("#appointment-detail").offset().top
			}, 500);
		}
	});
}
// Get appointment detail for booking
function getAppointment(Status) {
	var dataString = {
	  'Status': Status
	};
	onStartLoader();
	$.ajax({
		type: 'post',
		url: BASE_URL + "/appointment/default/view",
		data: dataString,
		cache: false, 
		success: function(data) {
			$("#partial_view_container_"+Status).html(data);
			onStopLoader();
		}
	});
	
}
/**
 *Function to Accept/Reject Appointment.
 */
function appointmentStatus(Appointment_ID,Appointment_Status,Status) {
	var dataString  = "Appointment_ID="+Appointment_ID + "&Appointment_Date="+$('#Appointment_Date').val()+ "&Appointment_Status="+Appointment_Status;
	$.confirm({
		title: 'Confirm!',
		content: 'Are you ready to submit?',
		buttons: {
			confirm: function () {
				onStartLoader();
				$.ajax({
						url: BASE_URL + "/appointment/default/submit",
						type: 'post',
						dataType: 'json',
						data: dataString,
						cache: false
					})
					.done(function (response) {
						if (response.data.success == true) {
							onStopLoader();
							if(Status == 'SINGLE') {
							 loadAppointment($('#Appointment_Date').val());
							} else { 
							 getAppointment(Status);
							}
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
						console.log("error");
					});
			},
			cancel: function () {
				onStopLoader();
			},
		}
	});
}