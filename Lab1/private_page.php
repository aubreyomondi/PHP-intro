<?php
include_once 'DBConnector.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:login.php");
}
$con = new DBConnector();
$username = $_SESSION['username'];
echo $username;
$sql = "SELECT id FROM user WHERE username = '$username'";
$res = $con->conn->query($sql) or die("Error:".$con->conn->error);
while($row = $res->fetch_array()){
    $_SESSION['id'] = $row['id'];
}

function fetchUserApiKey(){
    $id = $_SESSION['id'];
    $con = new DBConnector();
    $sql = "SELECT api_key FROM api_keys WHERE `user_id` = '$id'";
    $result = $con->conn->query($sql) or die("Error:".$con->conn->error);
    if ($result->num_rows>0){
        $row = $result->fetch_array();
        foreach ($row as $value){
            return $value;
        }

    }else
    return "Click button to Generate API key";
}
?>
 <!DOCTYPE html>
 <html>
 <head>
 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Private Page</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript" src="validate.js"></script>
    <link rel="stylesheet" type="text/css" href="validate.css">

    <script src="apikey.js"></script>
 </head>
 <body>
 <p align="right"><a href="logout.php">Logout</a></p>
        <hr>
        <h3>Here, we will create an API that will allow Users/Developer to order items from external</h3>
        <hr>
        <h4>We now put this feature of allowing users to generate an API key. Click the button to generate the API key</h4>
        <button class="btn btn-primary" id="api-key-btn">Generate API key</button><br><br>
        <strong>You API key: </strong>(Note that if your API key is already in use by already running applications, generating a new key will stop the application from functioning)<br>
        <textarea cols="100" rows="2" id="api_key" name="api_key" readonly><?php echo fetchUserApiKey();?></textarea>
        <h3>Service description</h3>
        We have a service/API that allows external applications to order food and also pull all order status by using order id. Let's do it
        <hr>
 	<p><a href="logout.php">Logout</a></p>
 </body>
 </html>