<?php
include '../model/Class_methods.php';

$model = new Class_methods();
$domains = $model->get_domains('domains');
$domains = json_decode($domains);

if (empty($domains)){
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
        Сервет не отвечает, пожалуста, подождите некоторое время и попробуййте снова.
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

$table = '<table class="table table-hover table-bordered table-striped">';
//$table .='<font color="#808080">'.Текст серого цвета.'</font>';
$table .='<h2>'.'<div style="text-align: center;">'."Все Домены".'</div>'.'</h2>';
$table .= '<tr>'.'<th>'."ID".'</th>'.'<th>'."Домены".'</th>'.'</tr>';
foreach ($domains as $domain) {
    $table .= '<tr>'.'<td>'. $domain->id.'</td>'.'<td>' . $domain->domainName .'</td>'.'</tr>';
}
$table .= '</table>';
echo $table;

