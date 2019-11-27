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
        modal_show();
    })
});
var path_to_project = '/json_data';/*Лизино*/
$(".all-posts").on("click", function () {
    $.get( path_to_project+"/view/all-posts.php", function( data ) {
        $('.main-info').html(data);
        modal_show();
    })
});

function add_domain() {
    if ($("#domain-name")[0].checkValidity()) {
        $.post(path_to_project + "/view/add-domain.php", {name:$("#domain-name").val()},  function (data) {
            $('.main-info').html(data);
            $("#exampleModal").modal('show');
        })
    }
    return false;
}

function add_post() {/*Лизино*/
    if ($("#domain-name")[0].checkValidity()) {
        $.post(path_to_project + "/view/add-post.php", {name:$("#domain-name").val()},  function (data) {
            $('.main-info').html(data);
            $("#exampleModal").modal('show');
        })
    }
    return false;
}

$(".dropdown-menu li a").click(function(){
    var selText = $(this).text();
    $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
});

function modal_show() {
    if ($("#exampleModal").length > 0){
        $("#exampleModal").modal('show');
        $('.main-info').html("");
    }
}

$(".all-posts").on("click", function () {
    $.get( path_to_project+"/view/all-posts.php", function( data ) {
        $('.main-info').html(data);
        //modal_show();
    })
});