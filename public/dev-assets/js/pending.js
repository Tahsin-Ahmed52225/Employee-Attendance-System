$(function () {
    $('.check_out_T').hide();
    $('.check_out_timer').hide();
    $(".form-check-input").on("click", function (e) {
        if (e.target.value == "approve") {
            // alert($(e.target).data('key'));
            $(`#check_out_time${$(e.target).data('key')}`).show();
            //console.log($('input[name="office_time_ends"]').val());
            $('button[type="submit"]').attr('disabled', true);
            $('input[name="office_time_ends"]').on('change', function () {
                if ($(this).val() != '') {
                    $('button[type="submit"]').attr('disabled', false);
                }
            });
        } else {
            $('button[type="submit"]').attr('disabled', false);
            $('.check_out_T').hide();
        }
    });

});
