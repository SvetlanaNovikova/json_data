<?php
include '../model/Class_methods.php';

$model = new Class_methods();
$domains = $model->get_domains('domains');
$domains = json_decode($domains);

$table = '<table width=90% height=70% border=1>';
foreach ($domains as $domain) {
    $table .= '<tr>'.'<td>' . $domain->id.'</td>'.'<td>' . $domain->domainName .'</td>'.'</tr>';
}
$table .= '</table>';
echo $table;

