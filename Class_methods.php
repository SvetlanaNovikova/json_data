<?php

abstract class Class_methods
{
    function Main($type, $data){
        switch($type){
            case  "get_domains": get_domains;
            case  "add_domains":add_domains;
        }
    }
    /*получение всех доменов из бд*/
    function get_domains(){
        $result = file_get_contents('http://vulture-tm.ru:3000/domains', false);
        return $result;
    }
    /*создание нового домена*/
    function add_domains($type, $data){
       /* $data = get_domains;
        var_dump($data);
        $data = json_decode($_REQUEST[json_encode($data)]);
        var_dump($data);
        return $data;*/
    }
}
?>