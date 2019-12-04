<?php
include '../model/Class_methods.php';

$step = (!empty($_POST["step"])) ? $_POST["step"] : '';
$model = new Class_methods();
$posts = $model->publish_post($step);
$posts = json_decode($posts, true);

if (empty($posts)){
    echo '
<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ответ сервера</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Сервет не отвечает, пожалуста, подождите некоторое время и попробуйте снова.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
';
    exit;
}

$total = $posts["result"]["total"];
$count = 0;
echo '<ul class="pagination">';
while ($count <= $total) {
    if ($count == intval($posts["result"]["skip"]))
        echo '<li class="page-item active publish-step" select="'.($count / 5) .'"><a class="page-link">'.($count / 5 + 1) .'</a></li>';
    else echo '<li class="page-item publish-step" select="'.($count / 5) .'"><a class="page-link">'.($count / 5 + 1) .'</a></li>';
    $count += 5;
}
echo '</ul>';

foreach ($posts["result"]["data"] as $key => $post) {
    if ($key % 3 == 0) {
        echo '<div class="row">';
    }
    if ( strlen($post["content"]) > 300) {
        $content = mb_substr($post["content"], 0, 297, 'UTF-8'); //140 это кол. знаков
        $content .= '...';
    }
    else $content = $post["content"];
    echo '<div class="col-md-4 "> 
            <div class="block-post">
                <div class="block-post-img"><img src="'. $post["thumbnailUrl"] .'"></div>
                <div class="block-title">'. $post["title"] .'</div>
                 <div class="block-content">'. $content .'</div>
                <div class="block-action"> 
                    <div class="block-update"><button type="button" class="update-post" select="'.$post["id"].'">Изменить</button></div>
                    <div class="block-delete"><button type="button" class="delete-post" select="'.$post["id"].'">Удалить</button></div>
                </div>
            </div>
          </div>';

    if (($key+1) % 3 == 0) {
        echo '</div>';
    }
}


