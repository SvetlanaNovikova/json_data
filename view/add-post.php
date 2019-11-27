<?php /*Лизино*/

include '../model/Class_methods.php';

$model = new Class_methods();
$data = array();
$data["domainName"] = $_POST["name"];
$data["content"]= $_POST["content"];
$data["author"]= $_POST["author"];
$data["excerpt"]= $_POST["excerpt"];
$data["title"]= $_POST["title"];
$data["status"]= $_POST[ "status"];
$data["postParent"]= $_POST["postParent"];
$data["url"]= $_POST["url"];
$data["thumbnailUrl"]= $_POST["thumbnailUrl"];
$data["postType"]= $_POST["postType"];

if((stristr($data["url"], 'http:')===FAlSE)||(stristr($data["url"], 'https:')===FAlSE)) {
    $str .= "Введите ссылку" ;
}
if(((stristr($data["thumbnailUrl"], 'http:')===FAlSE)||(stristr($data["thumbnailUrl"], 'https:')===FAlSE))&&(strlen($data["thumbnailUrl"])!=0)) {
    $str .= "Введите ссылку" ;
}
if(is_int($data["postParent"])===FAlSE) {
    $str .= "Введите число" ;
}

if (!empty($posts["id"])){
    $str .= "Пост успешно добавлен<br> Id поста - " . $posts["id"];
}
else $str .= "Возникла ошибка при добавлении поста:<br> " . $posts["error"]["message"];

$posts = $model->add_post($data);
$str = "";
if (!empty($posts["id"])){
    $str .= "Пост успешно добавлен<br> Id поста - " . $posts["id"];
}
else $str .= "Возникла ошибка при добавлении поста:<br> " . $posts["error"]["message"];

echo '
<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Добавление поста</h5>
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