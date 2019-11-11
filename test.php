<?php
include 'config.php';
use name\Configuration;

function get_domains($method)
{
    $result = file_get_contents(Configuration::$url.$method, false);
    return $result;
}

/*создание нового домена*/
function add_domains($data)
{
    $data = array("domainName" => $data["domainName"]);
    //$data = array("domainName" => $data["domainName"]);
    $data_string = json_encode($data);
    $rezult = $this->post_execute($data_string, 'domains');
    if (!empty( $rezult["id"])){
        return true;
    }
    else return false;
}

/*создание нового поста*/
function add_post($data)
{
    //новое id поста (НУЖНО ПОМЕНЯТЬ, ТУТ ВОЗВРАЩАЕТСЯ ЛИМИТ)
    $ch = curl_init(Configuration::$url.'domains/'.$data["id"].'/post/all');
    //убрать все кроме цифр
    $ch = preg_replace('~[^0-9]+~','',$ch);

    $data = array("title" => $data["title"],
        "content"=> $data["content"],
        "author"=> $data["author"],
        "excerpt"=> $data["excerpt"],
        "status"=> $data["status"],
        "postParent"=> $data["id"],
        "url"=> Configuration::$url.'domains/'.$data["id"].'/post/'.$ch,
        "thumbnailUrl"=> $data["content"],
        "postType"=> $data["postType"]);

    $data_string = json_encode($data);
    $rezult = $this->post_execute($data_string, 'domains/'.$data["id"].'/post');
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


$id='9';

//$result1 = file_get_contents(Configuration::$url.'domains/'.$id.'/post/all', false);
//echo $result1;
$ch = curl_init(Configuration::$url.'domains/'.$id.'/post/all');
//убрать все кроме цифр
$ch = preg_replace('~[^0-9]+~','',$ch);
echo $ch;
$t= Configuration::$url.'domains/'.$id.'/post';
$data = "test1";
$data = array("title" => $data,
    "content"=> "content_1",
  "author"=> "author_1",
  "excerpt"=> "excerpt_1",
  "status"=> "private",
  "postParent"=> $id,
  "url"=> Configuration::$url.'domains/'.$id.'/post/1',
  "thumbnailUrl"=> "thumbnailUrl_1",
  "postType"=> "postType_1");

print_r ($data);
$data_string = json_encode($data);
echo $data_string;
$rezult = post_execute($data_string, 'domains/'.$id.'/post');
print_r($rezult);
$result1 = file_get_contents(Configuration::$url.'domains/'.$id.'/post/all', false);
echo $result1;
//$dd = get_domains();
//echo $dd;