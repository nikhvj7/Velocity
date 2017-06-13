var count = 0;
var keypress = false;
var timer;

$(document).ready(function() {
	var field = $('#search_employees');
	var e_id = null;

	function setKeypress(choice) {
		keypress = choice;
	}

	function getKeypress() {
		return keypress;
	}


	function getYear() {
		var year_val = $('.get_year').text(); //taking from attendance_cal/calender.php exe folder 
		var year_array = year_val.split('-');
		var year = year_array[0];
		return year;
	}


	function hideTray() {

		if (!getKeypress()) {
			timer = setTimeout(function() {
				//console.log("clear");
				$('#search_response').html("").hide();
				field.val("");
				count = 0;
			}, 2 * 1000);
			setKeypress(true);
		} else {
			clearTimeout(timer);
			setKeypress(false);
			hideTray();
		}
	}


	function checkInputLength() {
		if (field.val().length == 0)
			return true;
		else
			return false;
	}


	function enterFunction(val) {
		console.log(val + e_id);

		$('#emp_name').text(val);
		$('#search_response').html("").hide();
		field.val("");

		//emp holidays
		$.ajax({
			url: 'attendance_cal/emp_holidays.php?e_id=' + e_id,
			type: 'GET',
			success: function(data) {

				var json = JSON.parse(data);
				$.each(json, function(key, value) {
					console.log(value);

					var year_val = $('.get_year').text();
					var year_array = year_val.split('-');
					var year = year_array[0];

					var result = value.split("/");
					var result_year = result[0];


					if (result_year == year) {
						var result_month = result[1];
						var result_day = result[2];
						result_day = result_day.replace(/^0+/, '');
						result_month = result_month.replace(/^0+/, '');
						console.log(result_day + result_month);

						for (var i = 0; i < 12; i++) {
							if (result_month == i) {
								$('table tr:eq(' + (i + 1) + ') td.loop:eq(' + (result_day - 1) + ')').addClass('holiday');
							}
						}
					}

				});
			}
		});
	}

	function load_non_working_days(year) {

		$.ajax({
			url: 'attendance_cal/load_non_working_days.php',
			type: 'GET',
			success: function(data) {

				var json = JSON.parse(data);
				$.each(json, function(key, value) {
					console.log(value);

					var result = value.split("-");
					var result_year = result[0];


					if (result_year == year) {
						var result_month = result[1];
						var result_day = result[2];
						result_day = result_day.replace(/^0+/, '');
						result_month = result_month.replace(/^0+/, '');
						console.log(result_day + result_month);

						for (var i = 0; i < 12; i++) {
							if (result_month == i) {
								$('table tr:eq(' + (i + 1) + ') td.loop:eq(' + (result_day - 1) + ')').addClass('nwd_highlight');
							}
						}
					}

				});
			}
		});
	}


	function processDate(date, type) {


		var year = getYear();

		$.ajax({
			url: 'attendance_cal/process_dates.php',
			type: 'POST',
			data: {
				date: date,
				type: type
			},
			success: function() {
				if (type == 'nwd') {
					$('#sel_nwd').val("");
					load_non_working_days(year);
				}
				if (type == 'wd') {
					$('#sel_wd').val("");
					$('table td').removeClass('nwd_highlight');
					load_non_working_days(year);
				}
			}
		});

	}

	//load nwd days
	$(window).on('load', function() {
		var year_val = $('.get_year').text();
		var year_array = year_val.split('-');
		var year = year_array[0];
		load_non_working_days(year);
	});


	//set non working days 	
	$('#b_nwd').on('click', function() {
		var date = $('#sel_nwd').val();
		if (date != '') {
			processDate(date, 'nwd');   //process date function is call here 
		} else {
			alert('Please choose a date.')
		}
	});

	//set working days
	$('#b_wd').on('click', function() {
		var date = $('#sel_wd').val();
		if (date != '') {
			processDate(date, 'wd');   //process date function is call here
		} else {
			alert('Please choose a date.')
		}
	});

	$('#b_leave').on('click', function() {
		var date = $('#sel_leave').val();
		if (date != '') {
			processDate(date, 'leave');
		} else {
			alert('Please choose a date.')
		}
	});



	field.on("keydown", function(e) {

		var li = $('#search_response ul li');

		//enter
		if (e.keyCode == 13) {
			if (checkInputLength()) {
				console.log("empty");
			} else {
				//console.log("enter function");
				if (li.hasClass('highlight')) {
					//console.log(e_id);
					enterFunction(field.val());
				}
				//					$('#calendar_holder').load('exe/calendar.php?data=jiggy');
			}
		}

		//downarrow
		else if (e.keyCode == 40) {

			if (count >= li.length) {
				count = 0;
			}
			li.removeClass('highlight');
			li.eq(count).addClass('highlight');
			var now = li.eq(count).text();
			e_id = li.eq(count).attr('id');

			if (now != 'No Results') {
				field.val(now);

			}
			count++;
			hideTray();
		}

		//uparrow
		else if (e.keyCode == 38) {
			count--;
			if (count < 0) {
				count = li.length - 1;
			}
			li.removeClass('highlight');
			li.eq(count).addClass('highlight');
			var now = li.eq(count).text();
			e_id = li.eq(count).attr('id');

			if (now != 'No Results') {
				field.val(now);
			}
			hideTray();
		}

		//backspace and delete
		else if ((e.keyCode == 8) || (e.keyCode == 46)) {
			setTimeout(function() {
				if (checkInputLength()) {
					$('#search_response').html("").hide();
					count = 0;
				}
			}, 1);
		}

		//input is letter hence find
		else {

			setTimeout(function() {

				var data = field.val();
				console.log("else");
				$.ajax({
					url: "attendance_cal/search_employees.php",
					type: "get",
					data: {
						data: data
					},
					success: function(response) {
						if (response) {
							$('#search_response').html(response).show();
							return;
						}
					}
				}); //ajax

			}, 1); //set timeout
		} //else letter


	});



	//mouse hover
	$('#search_response').on('mouseover', 'li', function() {
		$('#search_response li').removeClass('highlight');
		$(this).addClass('highlight');
		e_id = $(this).attr('id');

		hideTray();
	}); //mouse hover

	//mouse click
	$('#search_response').on('click', 'li', function() {
		var load = $(this).text().trim();
		field.val(load);
		enterFunction(field.val());
	}); //mouse click


	//year toggle
	//next
	$('body').delegate('.next_year', 'click', function() {
		var year = $(this).attr('id');
		$('#calendar_holder').load('exe/calendar.php?full_name=jiggy&year=' + year);
		load_non_working_days(year);
	});
	//prev
	$('body').delegate('.prev_year', 'click', function() {
		var year = $(this).attr('id');
		$('#calendar_holder').load('exe/calendar.php?full_name=jiggy&year=' + year);
		load_non_working_days(year);
	});

});