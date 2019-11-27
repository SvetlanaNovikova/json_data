<?php

include '../model/Class_methods.php';

$model = new Class_methods();
$data = array();
$data["domainName"] = $_POST["name"];

$domains = $model->add_domains($data);
$str = "";
if (!empty($domains["id"])){
    $str .= "Домен успешно добавлен<br> Id домена - " . $domains["id"];
}
else $str .= "Возникла ошибка при добавлении домена:<br> " . $domains["error"]["message"];

echo '
<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Добавление домена</h5>
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