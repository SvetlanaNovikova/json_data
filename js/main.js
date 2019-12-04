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
        delete_post();
        step_post();
    })
});
var status1="Частный";
function add_domain() {
    if ($("#domain-name")[0].checkValidity()) {
        $.post(path_to_project + "/view/add-domain.php", {name:$("#domain-name").val()},  function (data) {
            $('.main-info').html(data);
            $("#exampleModal").modal('show');
        })
    }
    return falsse;
}

function add_post() {
    if (($("#title")[0].checkValidity())&& ($("#content")[0].checkValidity())/*&&($("#author")[0].checkValidity())
    &&($("#excerpt")[0].checkValidity())&&($("#status")[0].checkValidity())&&($("#postParent")[0].checkValidity())
    &&($("#url")[0].checkValidity())&&($("#thumbnailUrl")[0].checkValidity())&&($("#postType")[0].checkValidity())
    */){

        $.post(path_to_project + "/view/add-post.php", {title:$("#title").val(),content:$("#content").val(),
            author:$("#author").val(),excerpt:$("#excerpt").val(),status:status1,postParent:$("#postParent").val(),
            url:$("#url").val(),thumbnailUrl:$("#thumbnailUrl").val(),postType:$("#postType").val()},  function (data) {
            $('.main-info').html(data);
            $("#exampleModal").modal('show');
        })
    }
    return false;
}

$(".dropdown-menu li a").click(function(){
    var selText = $(this).text();
    status1=$(this).text();
    $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');

});

function modal_show() {
    if ($("#exampleModal").length > 0){
        $("#exampleModal").modal('show');
        $('.main-info').html("");
    }
}

$(".publish-posts").on("click", function () {
    $.get( path_to_project+"/view/publish-posts.php", function( data ) {
        $('.main-info').html(data);
        modal_show();
        step_publish();
        delete_post();
    })
});

function delete_post() {
    $("button.delete-post").on("click", function () {
        $.post(path_to_project + "/view/delete-post.php", {post_id: $(this).attr("select")}, function (data) {
            $('.main-info').html(data);
            $("#exampleModal").modal('show');
        })
    });
}

function step_post() {
    $(".post-step").on("click", function () {
        $.post(path_to_project + "/view/all-posts.php", {step: $(this).attr("select")}, function (data) {
            $('.main-info').html(data);
            modal_show();
            delete_post();
            step_post();
        })
    });
}

function step_publish() {
    $(".publish-step").on("click", function () {
        $.post(path_to_project + "/view/publish-posts.php", {step: $(this).attr("select")}, function (data) {
            $('.main-info').html(data);
            modal_show();
            delete_post();
            step_publish();
        })
    });
}