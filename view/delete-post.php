<script src="js/main.js"></script>
<?php
include '../model/Class_methods.php';

$model = new Class_methods();
$data = array();
$data["post_id"] = $_POST["post_id"];
$posts = $model->delete_post($data);
$str = "";
if (empty($posts["title"])){
    $str .= "Пост успешно удален<br>  " . $posts["title"];
}
else $str .= "Возникла ошибка при удалении поста:<br> " . $posts["error"]["message"];

echo '
<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Удаление поста</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ' . $str . '
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
';