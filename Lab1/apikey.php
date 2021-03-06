<?php
include_once 'DBConnector.php';
session_start();
$_SESSION['id'];
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            header('HTTP/1.0 403 Forbidden');
            echo "You are forbidden!";
        }
else{
    $api_key = null;
    $api_key = generateApiKey(64);
    $id =  $_SESSION['id'];
    echo $id;
    header('Content-type: application/json');

    echo generateResponse($api_key);
}

function generateApiKey($str_length){
    $chars = '0123456789abcdefghijklmnopqrstuvwyxzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$bytes = openssl_random_pseudo_bytes(3*$str_length/4+1);
$repl = unpack('C2', $bytes);

$first = $chars[$repl[1]%62];
$second = $chars[$repl[2]%62];
return strtr(substr(base64_encode($bytes), 0, $str_length), '+/', "$first$second");
}

function saveApiKey($api_key){
    $con = new DBConnector();
    $id = $_SESSION['id'];
    $sql = "INSERT INTO api_keys(user_id,api_key) VALUES('$id','$api_key')";
    $res = $con->conn->query($sql)or die("Error:".$con->conn->error);

    return $res;

}

function generateResponse ($api_key){
    if(saveApiKey($api_key)){
        $res = [ 'success' => 1, ' message' => $api_key];
    }else{
        $res = ['success' => 0, 'message' => 'Something went wrong. Please regenerate the API key'];
    }
    return json_encode($res);
}

?>
