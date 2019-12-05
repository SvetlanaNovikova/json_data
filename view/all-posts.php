<?php
include '../model/Class_methods.php';

$step = (!empty($_POST["step"])) ? $_POST["step"] : '';
$model = new Class_methods();
$posts = $model->all_post($step);
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
        echo '<li class="page-item active post-step" select="'.($count / 5) .'"><a class="page-link">'.($count / 5 + 1) .'</a></li>';
    else echo '<li class="page-item post-step" select="'.($count / 5) .'"><a class="page-link">'.($count / 5 + 1) .'</a></li>';
    $count += 5;
}
echo '</ul>';

foreach ($posts["result"]["data"] as $key => $post) {
    echo '<div class="row block-post">';

    echo '<div class="col-md-5">
            <a target="_blank" href="'. $post["url"] .'">
            <div class="block-post-img"><img src="'. $post["thumbnailUrl"] .'" title="'. $post["title"] .'" alt="'. $post["title"] .'"></div>
            </a>
          </div> ';

    echo '<div class="col-md-7"> 
                <div class="block-title text-center"><h3>'. $post["title"] .'</h3></div>
                 <div class="block-content">'. $post["content"] .'</div>
                <div class="block-action"> 
                    <div class="block-update"><button type="button" class="update-post" select="'.$post["id"].'">Изменить</button></div>
                    <div class="block-delete"><button class="delete-post" select="'.$post["id"].'" type="button">Удалить</button></div>
                </div>
            
          </div>';

        echo '</div>';
}


