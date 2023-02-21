// JavaScript Document
/**
 *Function to get Appointment Calender.
 */
$( document ).ready(function() {
   changedateadmin('current', 'full');
   $('html, body').animate({ scrollTop: $("#appointment-div").offset().top }, 500);
}); 
/**
*Function to show popup to re-scheduled appointment.
*/
function reScheduleAppointment(Appointment_ID) {
	var dataString = 'Appointment_ID=' + Appointment_ID;
	$.ajax({
		type: 'post',
		url: BASE_URL + "/admin/order/re-schedule-appointment",
		data: dataString,
		cache: false,
		success: function(data) {
			$("#reschedule-info").modal('show');
			$(".modal-content").html(data);
			$('.selectpicker').selectpicker('refresh');
		}
	});
}
/**
 *Function to book Appointment.
 */
function bookReScheduleAppointment(Timeslot_ID) {
	var dataString = {
	  'Timeslot_ID': Timeslot_ID,
	  'Appointment_ID': $('#Appointment_ID').val(),
	  'Appointment_Date': $('#Appointment_Date').val()
	};
	console.log(dataString);
	$.confirm({
		title: 'Confirm!',
		content: 'Are you ready to submit?',
		buttons: {
			confirm: function () {
				$.ajax({
						url: BASE_URL + "/services/our-service/re-schedule-submit",
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
							$("#reschedule-info").modal('hide');
                            loadScheduleAdmin($('#Appointment_Date').val());
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
/**
*Function to submit credit wallet amount.
*/
function submitCreditWallet() {
	$('#credit_wallet').yiiActiveForm('validate');
	if ($("#credit_wallet").find(".has-error").length) {
		return false; 
	}
	event.preventDefault(); // stopping submitting
	event.stopImmediatePropagation();
	var data = $("#credit_wallet").serializeArray();
	var url = $("#credit_wallet").attr('action');
	var formData = $('#credit_wallet').serialize();
	$.confirm({
		title: 'Confirm!',
		content: 'Are you ready to submit?',
		buttons: {
			confirm: function () {
				$.ajax({
						url: url,
						type: 'post',
						dataType: 'json',
						data: formData,
						cache: false,
					})
					.done(function (response) {
						if (response.data.success == true) {
							$.alert({
								title: 'Success!',
								content: response.data.message,
							});
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