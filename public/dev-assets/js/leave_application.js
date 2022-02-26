$("#starting_date").hide();
$("#starting_date").attr('required', false);
$("#ending_date").hide();
$("#ending_date").attr('required', false);


function minForOneDayLeave() {
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear() + "-" + (month) + "-" + (day);
    //Preventing user to applying for past leave
    $('#starting_date input').val(today);
    $('#starting_date input').attr('min', today);
}
function minForLeave() {
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear() + "-" + (month) + "-" + (day);
    //Preventing user to applying for past leave
    $('#starting_date input').val(today);
    $('#starting_date input').attr('min', today);
    //Getting tomorrows date for ending date
    const t_date = new Date(now);
    t_date.setDate(t_date.getDate() + 1);
    var t_day = ("0" + t_date.getDate()).slice(-2);
    var t_month = ("0" + (t_date.getMonth() + 1)).slice(-2);
    var tomorrow = now.getFullYear() + "-" + (t_month) + "-" + (t_day);

    $('#ending_date input').val(tomorrow);
    $('#ending_date input').attr('min', tomorrow);
}
window.onload = (event) => {


    $("#number_of_days").on("keyup", (event) => {
        if (event.target.value > 1) {
            $("#starting_date .col-form-label").text('From');
            $("#starting_date").show();
            $("#ending_date").show();
            $("#ending_date").attr('required', true);
            $("#starting_date").attr('required', true);

            minForLeave();

        } else if (event.target.value == null || event.target.value == "" || event.target.value < 1) {
            $("#starting_date").hide();
            $("#ending_date").hide();
            $("#ending_date").attr('required', false);
            $("#starting_date").attr('required', false);
        }
        else {
            $("#starting_date").show();
            $("#starting_date .col-form-label").text('Leave Date');
            $("#ending_date").hide();
            $("#ending_date").attr('required', false);
            $("#starting_date").attr('required', true);
            minForOneDayLeave();
        }
    });
};
