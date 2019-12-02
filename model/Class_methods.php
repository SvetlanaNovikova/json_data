<?php
include '../config.php';
use name\Configuration;

class Class_methods
{
    function Main($type, $data, $method){
        switch($type){
            case  "get_domains": $this->get_domains($method); break;
            case  "add_domains": $this->add_domains($data); break;
            case  "add_post": $this->add_post($data); break;
        }
    }
    /*получение всех доменов из бд*/
    function get_domains($method)
    {
        $result = file_get_contents(Configuration::$url.$method, false);
        /*if (!empty( $result["id"])){
            return $result;
        }
        else return false;*/
        return $result;
    }
    /*создание нового домена*/
    function add_domains($data)
    {
        $data = array("domainName" => $data["domainName"]);
        $data_string = json_encode($data);
        $rezult = $this->post_execute($data_string, 'domains');
        /*if (!empty( $rezult["id"])){
            return true;
        }
        else return false;*/
        return $rezult;
    }

    /*создание нового поста*/
    function add_post($data)
    {
        $data = array("title" => $data["title"],
            "content"=> $data["content"],
            "author"=> $data["author"],
            "excerpt"=> $data["excerpt"],
            "status"=> $data["status"],
            "postParent"=> $data["postParent"],
            "url"=> $data["url"],
            "thumbnailUrl"=> $data["thumbnailUrl"],
            "postType"=> $data["postType"]);

        $data_string = json_encode($data);
        $rezult = $this->post_execute($data_string, 'domains/'.Configuration::$domenId.'/post');
        /*if (!empty( $rezult["id"])){
            return $rezult;
        }
        else return false;*/
        return $rezult;
    }

    function get_post($post_id)
    {
        $result = file_get_contents(Configuration::$url.'domains/'.Configuration::$domenId.'/post/'.$post_id, false);
        if (!empty( $result["id"])){
            return $result;
        }
        else return false;
    }

    function update_post($data, $post_id)
    {
        $data_string = array();
        if (!empty($data["title"]))
            $data_string["title"] = $data["title"];
        if (!empty($data["content"]))
            $data_string["content"] = $data["content"];
        if (!empty($data["author"]))
            $data_string["author"] = $data["author"];
        if (!empty($data["excerpt"]))
            $data_string["excerpt"] = $data["excerpt"];
        if (!empty($data["status"]))
            $data_string["status"] = $data["status"];
        if (!empty($data["postParent"]))
            $data_string["postParent"] = $data["postParent"];
        if (!empty($data["url"]))
            $data_string["url"] = $data["url"];
        if (!empty($data["thumbnailUrl"]))
            $data_string["thumbnailUrl"] = $data["thumbnailUrl"];
        if (!empty($data["postType"]))
            $data_string["postType"] = $data["postType"];

        $data_string = json_encode($data_string);
        $rezult = $this->patch_execute($data_string, 'domains/'.Configuration::$domenId.'/post/'.$post_id.'/update');
        if (!empty( $rezult["id"])){
            return $rezult;
        }
        else return false;
    }

    function delete_post($post_id)
    {
        $result = $this->delete_execute(Configuration::$url.'domains/'.Configuration::$domenId.'/post/'.$post_id.'/delete');
        if (!empty( $result["status"]) && $result["status"]){
            return true;
        }
        else return false;
    }

    function all_post()
    {
        $result = file_get_contents(Configuration::$url.'domains/'.Configuration::$domenId.'/post/all', false);
        /*if (!empty( $result["status"])){
            return $result;
        }
        else return false;*/
        return $result;
    }

    function publish_post()
    {
        $result = file_get_contents(Configuration::$url.'domains/'.Configuration::$domenId.'/post/publish', false);
        return $result;
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

    function delete_execute($method)
    {
        $url = Configuration::$url.$method;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_POSTFIELDS, '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }

    function patch_execute($data, $method)
    {
        $url = Configuration::$url.$method;
        $headers = array('Content-Type: application/json');
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }
}
?>