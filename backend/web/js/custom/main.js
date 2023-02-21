// JavaScript Document
var BASE_URL = "http://localhost/projects/appointment/backend/web/index.php";

var partialviewcontainer     = $("#partial_view_container");

$( "#datepicker" ).datepicker();



// Delete the cookie
function eraseCookie(name) {
  setCookie(name, "", -1)
}
	$(document).ready(function(e){
		calendar = new CalendarYvv("#calendar", moment().format("Y-M-D"), "Monday");
		calendar.funcPer = function(ev){
			console.log(ev)
		};
		calendar.diasResal = [4,15,26]
		calendar.createCalendar();
	});
	  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
  
$(document).ready(function(){
  $(".allownumericwithoutdecimal").on("keypress keyup blur",function (event) {    
	$(this).val($(this).val().replace(/[^\d].+/, ""));
	  if ((event.which < 48 || event.which > 57)) {
		event.preventDefault();
	}
  });
  $("[type='number']").keypress(function (evt) {
	  evt.preventDefault();
  });
  $( ".txtOnly" ).keypress(function(e) {
		var key = e.keyCode;
		if (key >= 48 && key <= 57) {
			e.preventDefault();
		}
	});
	$( ".intOnly" ).keypress(function(e) {
		var key = e.keyCode;
		if (key > 31 && (key < 48 || key > 57)) {
			e.preventDefault();
		}
	});
	$('.floatOnly').keypress(function(event) {
		var $this = $(this);
		if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
		   ((event.which < 48 || event.which > 57) &&
		   (event.which != 0 && event.which != 8))) {
			   event.preventDefault();
		}
	
		var text = $(this).val();
		if ((event.which == 46) && (text.indexOf('.') == -1)) {
			setTimeout(function() {
				if ($this.val().substring($this.val().indexOf('.')).length > 3) {
					$this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
				}
			}, 1);
		}
	
		if ((text.indexOf('.') != -1) &&
			(text.substring(text.indexOf('.')).length > 2) &&
			(event.which != 0 && event.which != 8) &&
			($(this)[0].selectionStart >= text.length - 2)) {
				event.preventDefault();
		}      
	});
	
	$('.floatOnly').bind("paste", function(e) {
	var text = e.originalEvent.clipboardData.getData('Text');
	if ($.isNumeric(text)) {
		if ((text.substring(text.indexOf('.')).length > 3) && (text.indexOf('.') > -1)) {
			e.preventDefault();
			$(this).val(text.substring(0, text.indexOf('.') + 3));
	   }
	}
	else {
			e.preventDefault();
		 }
	});
});
/**
 *Show loader on ajax request.
 */
function onStartLoader() {
    $("#erp_loader").removeClass("d-none");
    var body = document.body;
    body.classList.add("loader_body");
}
/**
 *Stop loader on ajax response.
 */
function onStopLoader() {
    $("#erp_loader").addClass("d-none");
    var body = document.body;
    body.classList.remove("loader_body");
}
/**
 *Show Preview Image
 */	
function showPreview() { 
	$("#picture-img").change(function () {
		readURL(this);
	});
}
/**
 *Function to show image preview.
 */
function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		console.log(document.getElementById('picture-img').files[0].size);
		reader.onload = function (e) {
			$('#picture-img-tag').attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
}
/**
 *Function to get all district on the basis of state.
 */
function getDistrict() {
	var dataString = 'State_ID=' + $('#State_ID').val();
	onStartLoader();
	$.ajax({
		type: 'post',
		url: BASE_URL + "/ajax/districts",
		data: dataString,
		dataType: 'json',
		cache: false,
		success: function (json) {
			$("#District_ID").html('<option>Select Dstrict</option>');
			$.each(json, function (key, value) {
				$("#District_ID").append('<option value="' + key + '">' + value + '</option>');
			});
			$('#District_ID').selectpicker('refresh');
			onStopLoader();
		}
	});
}