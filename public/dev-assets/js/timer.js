window.onload = function () {
    value = $('#time_msg').data('clicked');

    if (value != 0) {
        localStorage.setItem('start_button', 'clicked');
        $('#end_button').attr('disabled', false);
    } else {
        localStorage.clear();
        $('#end_button').attr('disabled', true);
    }
    function get_time_duration() {
        $.ajax({
            type: 'GET',
            url: '/get-time-duration',
            success: function (data) {
                time_du = data.time;
                hr = Math.floor(time_du / 3600); // get hours
                min = Math.floor((time_du - (hr * 3600)) / 60); // get minutes
                sec = time_du - (hr * 3600) - (min * 60); //  get seconds
                timerCycle();
            },
            error: function (data) {
                console.log("Error:");
                console.log(data);
            },
        });

    }
    function checkin() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/check-in',
            success: function (data) {
                document.getElementById("time_msg").innerHTML = data.msg;
                $("#time_msg").slideDown(500);
                $("#time_msg").delay(1000).slideUp(500);
                if (data.stage) {
                    localStorage.setItem('start_button', 'clicked');
                    $("#start_button").prop("disabled", true);
                    $("#start_button").removeClass("btn-outline-success");
                    $("#start_button").addClass("btn-light");
                    start_button.innerHTML = "Running";
                    timerCycle();
                    document.getElementById("time_msg").innerHTML = "";
                    $("#end_button").prop("disabled", false);
                }
            },
            error: function (data) {
                console.log("Error:");
                console.log(data);
            },
        });


    }

    function checkOut(hr, min, sec, description) {
        var type = document.getElementById("timer_label").innerText;
        console.log(type);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/check-out',
            data: {

                'hr': hr,
                'min': min,
                'sec': sec,
                'description': description,
                'type': type,

            },
            success: function (data) {
                document.getElementById("time_msg").innerHTML = data.msg;
                $("#time_msg").slideDown(500);
                $("#time_msg").delay(1000).slideUp(500);
                if (data.stage) {
                    localStorage.clear();
                    timer.innerHTML = '00:00:00';
                    //Stopping the cycle
                    clearTimeout(cycle);
                    hr = 0;
                    min = 0;
                    sec = 0;
                    $("#start_button").prop("disabled", false);
                    $("#start_button").addClass("btn-success");
                    $("#start_button").removeClass("btn-light");
                    start_button.innerHTML = "Check In";
                    tinyMCE.get('kt-tinymce-3').setContent('');
                    $("#end_button").prop("disabled", true);
                }
            },
            error: function (data) {
                console.log("Error:");
                console.log(data);

            },
        });

    }
    //Getting dashboard  ( Checking if we are in dashboard or not)
    var dashboard = document.getElementById("page_name");
    //Start button
    var start_button = document.getElementById("start_button");
    //Stop button
    var stop_button = document.getElementById("timer_submit");
    //timer
    var timer = document.getElementById("stopwatch");
    // console.log(timer.innerHTML);

    if (dashboard != null && localStorage.getItem('start_button') == null) {
        //Declaring variable
        var hr = 0;
        var min = 0;
        var sec = 0;

    } else if ((dashboard != null && localStorage.getItem('start_button') != null)) {
        $("#start_button").prop("disabled", true);
        $("#start_button").removeClass("btn-outline-success");
        $("#start_button").addClass("btn-light");
        start_button.innerHTML = "Running";
    }




    if (start_button) {
        start_button.addEventListener('click', function () {
            checkin();
        })
    }
    if (stop_button) {
        stop_button.addEventListener('click', function () {
            checkOut(hr, min, sec, tinyMCE.get('kt-tinymce-3').getContent());

        })
    }
    //continue timer on other pages
    if (dashboard == null && localStorage.getItem('start_button') != null) {

        get_time_duration();

        //continue timer on coming back Dashboard
    } else if (dashboard != null && localStorage.getItem('start_button') != null) {
        get_time_duration();
    }
    function timerCycle() {
        sec = parseInt(sec);
        min = parseInt(min);
        hr = parseInt(hr);

        sec = sec + 1;

        if (sec == 60) {
            min = min + 1;
            sec = 0;
        }
        if (min == 60) {
            hr = hr + 1;
            min = 0;
            sec = 0;
        }

        if (sec < 10 || sec == 0) {
            sec = '0' + sec;
        }
        if (min < 10 || min == 0) {
            min = '0' + min;
        }
        if (hr < 10 || hr == 0) {
            hr = '0' + hr;
        }


        if (dashboard == null && localStorage.getItem('start_button') != null) {
            var side_timer = document.getElementById('time_title');
            if (side_timer) {
                //handling other page timer
                side_timer.innerHTML = hr + ':' + min + ':' + sec;
            }

        } else {
            timer.innerHTML = hr + ':' + min + ':' + sec;
        }


        cycle = setTimeout(timerCycle, 1000);
    }


}
