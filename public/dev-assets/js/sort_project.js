$(".navi-link").on("click",(e)=>{
    var post_id = e.target.getAttribute("data-itemID")
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
    $('.submit_btn').on("click", (e) => {
        $.ajax({
            url: "empolyee/update-daily-update/",
            type: "POST",
            data: {
                post_id: post_id,
                updated_text : tinymce.get("update_box").getContent()
            },
            success: (data)=>{
               console.log(data);
            },
            error: (err)=>{
                console.log(err);
            }
        });
     //  console.log(tinymce.get("update_box").getContent());

    });
});



// window.onload = function() {
//    $("#get_data").on("click", function() {
//         var month = $("#MonthSelect").val();
//         var year = $("#YearSelect").val();
//         console.log(month);
//         console.log(year);
//         if(month == null && year == null){
//            return;
//         }
//    });
// }
