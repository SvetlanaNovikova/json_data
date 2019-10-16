<?php
include 'config.php';

class Class_methods
{
    function Main($type, $data){
        switch($type){
            case  "get_domains": $this->get_domains(); break;
            case  "add_domains": $this->add_domains($data); break;
        }
    }
    /*получение всех доменов из бд*/
    function get_domains(){
        $result = file_get_contents('http://vulture-tm.ru:3000/domains', false);
        return $result;
    }
    /*создание нового домена*/
    function add_domains($data){
        $rezult = [];
        $rezult['name'] = $data['name'];
        $rezult = json_encode($rezult);

        $json='{"name": "Test Case","desc": "This is test task"}';
        $ch = curl_init('https://some.host/hooks/fa63636975788d7cd80/execute');
        curl_setopt($ch, CURLOPT_POST, true); //переключаем запрос в POST
        curl_setopt($ch, CURLOPT_POSTFIELDS,$json); //Это POST данные
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //Отключим проверку сертификата https
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //из той же оперы
        curl_exec($ch);
        curl_close($ch);

        $ch = curl_init("REMOTE XML FILE URL GOES HERE"); // such as http://example.com/example.xml
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json); //Это POST данные
        $data = curl_exec($ch);
        curl_close($ch);

        $data = get_domains;
        var_dump($data);
        $data = json_decode($_REQUEST[json_encode($data)]);
        var_dump($data);
        return $data;
    }
}
?>