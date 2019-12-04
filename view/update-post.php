<?php
include '../model/Class_methods.php';

$model = new Class_methods();
$data = array();
$data["title"] = $_POST["title"];
$data["content"]= $_POST["content"];
$data["author"]= $_POST["author"];
$data["excerpt"]= $_POST["excerpt"];
$data["status"]= strval($_POST["status"]);
$data["postParent"]= intval($_POST["postParent"]);
$data["url"]= $_POST["url"];
$data["thumbnailUrl"]= $_POST["thumbnailUrl"];
$data["postType"]= $_POST["postType"];

$posts = $model->update_post($data, $_POST["id"]);
$str = "";
if (!empty($posts["title"])){
    $str .= "Пост успешно изменен<br>  " . $posts["title"];
}
else $str .= "Возникла ошибка при добавлении поста:<br> " . $posts["error"]["message"];

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
        '.$str.'
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
';
