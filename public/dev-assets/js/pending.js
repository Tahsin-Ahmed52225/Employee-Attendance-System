$(function () {
    $('.check_out_T').hide();
    $('.check_out_timer').hide();
    $(".form-check-input").on("click", function (e) {
        if (e.target.value == "approve") {
            // alert($(e.target).data('key'));
            $(`#check_out_time${$(e.target).data('key')}`).show();
        } else {
            $('.check_out_T').hide();
        }
    });

});
