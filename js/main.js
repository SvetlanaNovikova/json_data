$(".knopka").on("click", function () {
    var form = $(this).attr("select");
    $(".show").removeClass("show");
    if ($("."+form).length > 0){
        $("."+form).addClass("show");
    }
    else alert(form);
});

var path_to_project = '/json_data';
$(".all-domains").on("click", function () {
    $.get( path_to_project+"/view/all-domains.php", function( data ) {
        $('.main-info').html(data);
    })
});