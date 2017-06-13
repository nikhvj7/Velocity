$(document).ready(function() {

    // date functions
    function getNextMonday(date) {
        return date.next().monday();
    }

    function getNextSaturday(date) {
        return date.next().saturday();
    }

    function getPrevMonday(date) {
        return date.last().monday();
    }

    function getPrevSaturday(date) {
        return date.last().saturday();
    }

    function getWeekNum(date) {
        return date.getWeek();
    }

    function addZero(n) {
        return n < 10 ? '0' + n : '' + n;
    }

    // Company Selector 
    $('.company_bar_company').on('click', function() {

        if (!$(this).hasClass('company_bar_company_active')) {
            $('.company_bar_company').removeClass('company_bar_company_active');
            $(this).addClass('company_bar_company_active');

            comp_id = $(this).attr('company_bar_comp_id');
            console.log(comp_id);
            // function logic here
            getData(date, shift, comp_id);
        }
    });

    // show controls
    function showDayControls(){ 
      
      $('#toggle_drawer').hide();
      $('#day_cntrls').show();

      day_of_week = today.clone();

      $('#date_input').val(today.getDateString());
      var i = (today.getDay() - 1);
      $('.dow_single').removeClass('dow_active');
      $('.dow_single:eq('+i+')').addClass('dow_active');
      $('.shift_selector').show();

     // getData(date,shift,comp_id); 
    }

    // get string from date object
    Date.prototype.getDateString = function() {
        var month = addZero((this.getMonth() + 1));
        var day = addZero(this.getDate());
        return this.getFullYear() + '-' + month + '-' + day;
    }

    function getData(date, shift, comp_id) {

        $('#weekly_scroll_helper').load('display/gps/car_list.php?date=' + date + '&shift=' + shift + '&comp_id=' + comp_id);
        

    }


    // main function
    function init() {

        view = 'getdata';
        week_num = getWeekNum(today.clone());
        day_of_week = today.clone();

        if (today.getDay() == 1) { // if monday, use today
            monday = today.clone();
        } else if (today.getDay() == 0) { // if sunday use next monday
            monday = getNextMonday(today.clone());
            week_num++;
        } else {
            monday = getPrevMonday(today.clone()); // else day is past monday, use prev monday
        }

        if (today.getDay() == 6) {
            saturday = today.clone();
        } else {
            saturday = getNextSaturday(today.clone());
        }


        console.log('Mon:' + monday.getDateString());
        console.log('Sat:' + saturday.getDateString());
        console.log('Wno:' + week_num);
        date1 = monday.getDateString();
        date2 = saturday.getDateString();

        getData(date, shift, comp_id);

        // getTable(monday.getDateString(), saturday.getDateString(), week_num);
        // getScrollHelper(monday.getDateString(), saturday.getDateString());
        // company();
        showDayControls();
    }

    // globals
    var today = Date.today();
    var date = 'today';
    var shift = 'a';
    var comp_id = 1;
    var car_id = 0;
    var monday, saturday, week_num, day_of_week, date1, date2, view;
    init();

    // click functions

    // choose day-week-month
    $('.dwm_box').on('click', function() {
        if (!$(this).hasClass('dwm_active')) {
            $('.dwm_box').removeClass('dwm_active');
            $(this).addClass('dwm_active');
            showDayControls();
        }
    });
    // choose day of week
    $('.dow_single').on('click', function() {

        if (!$(this).hasClass('dow_active')) {

            var act_d = $('.dow_active').index();
            var new_d = $(this).index();
            // console.log(act_d);
            // console.log(new_d);

            $('.dow_single').removeClass('dow_active');
            $(this).addClass('dow_active');

            var get_d = new_d - act_d;

            var display_date = day_of_week.add(get_d).days().getDateString();
            $('#date_input').val(display_date);
            date = display_date;
            getData(date, shift, comp_id);
            removeLine();
        }
    });

    // handle date change
    $('#date_input').on('change', function() {

        if ($(this).val() != "") {
            var temp = Date.parse($(this).val());
            var i = (temp.getDay() - 1);
            if (i == -1) {
                alert('Sunday! No data');
                $(this).val(day_of_week.getDateString());
            } else {
                date = $(this).val();
                day_of_week = temp;
                $('.dow_single').removeClass('dow_active');
                $('.dow_single:eq(' + i + ')').addClass('dow_active');
                getData(date, shift, comp_id);
                removeLine();
            }
        }
    });


    // toggle more details
    $('body').delegate('#toggle', 'click', function() {

        if ($('.toggle').is(':visible')) {
            $('.toggle').hide();
            $('.underline').removeClass('underline_toggle');
        } else {
            $('.toggle').show();
            $('.underline').addClass('underline_toggle');
        }
    });


    $('body').delegate('.viewpager_tabs:not(.tab_active)', 'click', function() {
        shift = $(this).attr('shift');
        $('.viewpager_tabs').each(function() {
            $(this).removeClass('tab_active');
        });
        $(this).addClass('tab_active');
        getData(date, shift, comp_id);
        removeLine();
    });

    $('body').delegate('.car_selector', 'click', function() {

        car_id = $(this).attr('carid');

        if (((shift != '') || (car_id != '')) && (date != '')) {
            initialize(date, car_id, shift);
            $('#info').show();
            $('#ops_data').load('display/gps/ops_data.php?date=' + date + '&shift=' + shift + '&car_id=' + car_id);
        } else {
            alert('You are doing something wrong');
        }

    });

    $('body').delegate('#close', 'click', function() {

      $('#info').hide();

    });

    
});