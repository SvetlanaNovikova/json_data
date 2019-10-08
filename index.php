<?php
header("Content-Type: text/html; charset=UTF-8");

class POST
{
    public $id;
    public $domain;
    public $postik;
}
$myCar = new POST();
$myCar->id = 1;
$myCar->domain = 'LALA';
$myCar->postik = 'RARA';
$yourCar = new POST();
$yourCar->id = 2;
$yourCar->domain = 'BEBE';
$yourCar->postik = 'TYTY';
$cars = array($myCar, $yourCar);
$table = '<table width=90% height=70% border=1>';
foreach ($cars as $car) {
    $table .= '<tr>'.'<td>' . $car->id.'</td>'.'<td>' . $car->domain .'</td>' .'<td>' .$car->postik .'</td>'.'</tr>';
}
$table .= '</table>';
echo $table;
?>