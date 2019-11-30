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
$table .='<font face="algerian">'.'<font color="#008B8B">'.'<h2>'."All Domains".'</h2>'.'</font>'.'</font>';
$table .= '<tr>'.'<th>'.'<font face="arial black">'.'<font color="#2E8B57">'."ID".'</font>'.'</font>'.'</th>'.'<th>'.'<font face="arial black">'.'<font color="#2E8B57">'."Domains".'</font>'.'</font>'.'</th>'.'</tr>';
foreach ($domains as $domain) {
    $table .= '<tr>'.'<td>' .'<font face="comic sans ms">'. $domain->id.'</font>'.'</td>'.'<td>' .'<font face="comic sans ms">'. $domain->domainName .'</font>'.'</td>'.'</tr>';
}
$table .= '</table>';
echo $table;

