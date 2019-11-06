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
        include 'config.php';
        $result = file_get_contents($url.'domains', false);
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

/*
///public $apiName = 'users';

//$result = file_get_contents($url.'domains', false);
//echo $result;
function get_domains(){
include 'config.php';
$result = file_get_contents($url.'domains', false);
return $result;
}
$json='{"domainName": "This_is_test_task"}';
$ch = curl_init($url.'domains');
//убрать все кроме цифр
//$ch = preg_replace('~[^0-9]+~','',$ch);
//$json='{"domainName": "This is test task"}';

curl_setopt($ch, CURLOPT_POST, true); //переключаем запрос в POST
curl_setopt($ch, CURLOPT_POSTFIELDS,$json); //Это POST данные

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //Отключим проверку сертификата https
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //из той же оперы
curl_exec($ch);
curl_close($ch);
$ch = curl_init($url.'domains'); // such as http://example.com/example.xml

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json); //Это POST данные
$data = curl_exec($ch);
curl_close($ch);
$data = get_domains();

var_dump($data);
$data = json_decode($_REQUEST[json_encode($data)]);
var_dump($data);
//  echo $data;


//echo $json;

/**
* Метод GET
* Вывод списка всех записей
* http://ДОМЕН/users
* @return string


//$db = (new Db())->getConnect($url.'domains');
$users = Users::getAll($url.'domains');
if($users){
echo $this->response($users, 200);
}
echo $this->response('Data not found', 404);
*/
/**
* Метод GET
* Просмотр отдельной записи (по id)
* http://ДОМЕН/users/1
* @return string

public function viewAction()
{
//id должен быть первым параметром после /users/x
$id = array_shift($this->requestUri);

if($id){
$db = (new Db())->getConnect();
$user = Users::getById($db, $id);
if($user){
return $this->response($user, 200);
}
}
return $this->response('Data not found', 404);
}

/**
* Метод POST
* Создание новой записи
* http://ДОМЕН/users + параметры запроса name, email
* @return string

public function createAction()
{
$name = $this->requestParams['name'] ?? '';
$email = $this->requestParams['email'] ?? '';
if($name && $email){
$db = (new Db())->getConnect();
$user = new Users($db, [
'name' => $name,
'email' => $email
]);
if($user = $user->saveNew()){
return $this->response('Data saved.', 200);
}
}
return $this->response("Saving error", 500);
}

/**
* Метод PUT
* Обновление отдельной записи (по ее id)
* http://ДОМЕН/users/1 + параметры запроса name, email
* @return string

public function updateAction()
{
$parse_url = parse_url($this->requestUri[0]);
$userId = $parse_url['path'] ?? null;

$db = (new Db())->getConnect();

if(!$userId || !Users::getById($db, $userId)){
return $this->response("User with id=$userId not found", 404);
}

$name = $this->requestParams['name'] ?? '';
$email = $this->requestParams['email'] ?? '';

if($name && $email){
if($user = Users::update($db, $userId, $name, $email)){
return $this->response('Data updated.', 200);
}
}
return $this->response("Update error", 400);
}

/**
* Метод DELETE
* Удаление отдельной записи (по ее id)
* http://ДОМЕН/users/1
* @return string

public function deleteAction()
{
$parse_url = parse_url($this->requestUri[0]);
$userId = $parse_url['path'] ?? null;

$db = (new Db())->getConnect();

if(!$userId || !Users::getById($db, $userId)){
return $this->response("User with id=$userId not found", 404);
}
if(Users::deleteById($db, $userId)){
return $this->response('Data deleted.', 200);
}
return $this->response("Delete error", 500);
}
*/?>