$("#starting_date").hide();
$("#starting_date").attr('required', false);
$("#ending_date").hide();
$("#ending_date").attr('required', false);
window.onload = (event) => {


    $("#number_of_days").on("keyup", (event) => {
        if (event.target.value > 1) {
            $("#starting_date .col-form-label").text('From');
            $("#starting_date").show();
            $("#ending_date").show();
            $("#ending_date").attr('required', true);
            $("#starting_date").attr('required', true);
        } else if (event.target.value == null || event.target.value == "") {
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
        }
    });
};
