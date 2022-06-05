var post_id = -100;
$(".navi-link").on("click",(e)=>{
    post_id = e.target.getAttribute("data-itemID")
    //Getting the previous post details
    $.ajax({
        url: "/get-post-description",
        type: "GET",
        data: {
            post_id: post_id
        },
        success: (data)=>{
            tinymce.get("update_box").setContent(data);
        },
        error: (err)=>{
            console.log(err);
        }
    });
});
$('.submit_btn').on("click", () => {
    $.ajax({
        url: "/employee/edit-daily-update",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        data: {
            post_id: post_id,
            updated_text : tinymce.get("update_box").getContent()
        },
        success: (data)=>{
            if(data.stage == "success"){
                $(`#dailyUpdate`+post_id).html(tinymce.get("update_box").getContent());
                $("#update_msg").html(`<div class="alert alert-success alert-dismissible fade show" role="alert">
                `+data.msg+`
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>`);
            }else{
                $("#update_msg").html(`<div class="alert alert-warning alert-dismissible fade show" role="alert">
                `+data.msg+`
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>`);
            }
        },
        error: (err)=>{
            console.log(err);
        }
    });
});



$("#get_data").on("click", function() {
    var month = $("#MonthSelect").val();
    var year = $("#YearSelect").val();
    window.location.href = "/search-daily-update/" + month + "/" + year;
});

