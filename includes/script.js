$(".slideron").click(function () {
    var idMine = $(this).attr('id');
    $.ajax({
        type: "POST",
        url: "slider.php",
        data:{
            slider_id:idMine
        },
        success: function (response) {
            $("#sliderbody").html(response);
            $("#modalslider").modal("show");
        }
    });
});
