<?php
include '../config.php';
use name\Configuration;

class Class_methods
{
    function Main($type, $data){
        switch($type){
            case  "get_domains": $this->get_domains(); break;
            case  "add_domains": $this->add_domains($data); break;
        }
    }
    /*получение всех доменов из бд*/
    function get_domains()
    {
        $result = file_get_contents(Configuration::$url.'domains', false);
        return $result;
    }
    /*создание нового домена*/
    function add_domains($data)
    {
        $data = array("domainName" => $data["domainName"]);
        $data_string = json_encode($data);
        $rezult = $this->post_execute($data_string, 'domains');
        if (!empty( $rezult["id"])){
            return true;
        }
        else return false;
    }

    function post_execute($data, $method)
    {
        $ch = curl_init(Configuration::$url.$method);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        $result = curl_exec($ch);
        return json_decode($result, true);
    }
}
?>