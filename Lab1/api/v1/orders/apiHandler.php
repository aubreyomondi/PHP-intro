<?php

include_once '../../../DBConnector.php';
class apiHandler
{
    private $meal_name;
    private $meal_units;
    private $unit_price;
    private $status;
    private $user_api_key;
    private $order_id;


    public function setMealName($meal_name){
        $this->meal_name = $meal_name;
    }
    public function getMealName(){
        return $this->meal_name;
    }
    public function setMealUnits($meal_units){
        $this->meal_units = $meal_units;
    }
    public function getMealUnits(){
        return $this->meal_units;
    }
    public function setUnitPrice($unit_price){
        $this->unit_price = $unit_price;
    }
    public function getUnitPrice(){
        return $this->unit_price;
    }
    public function setStatus($status){
        $this->status = $status;
    }
    public function getStatus(){
        return $this->status;
    }
    public function setUserApiKey($key){
        $this->user_api_key = $key;
    }
    public function getUserApiKey(){
        return $this->user_api_key;
    }
    public function setOrderKey($id){
        $this->order_id = $id;
    }
    public function getOrderKey(){
        return $this->order_id;
    }
    public function createOrder(){
        $con = new DBConnector();
        $sql = "INSERT INTO orders (order_name,units,unit_price,order_status) VALUES ('$this->meal_name','$this->meal_units','$this->unit_price','$this->status')";
        $res = $con->conn->query($sql)or die("Error:".$con->conn->error);
        return $res;
    }
    public function checkOrderStatus(){
        $con = new DBConnector();
        $sql = "SELECT order_status FROM orders where `order_id` = '$this->order_id'";
        $res = $con->conn->query($sql)or die("Error:".$con->conn->error);

        if ($res->num_rows>0){
            while ($row = $res->fetch_array()){
                $order_status = $row['order_status'];
            }
            return $order_status;
    
        }else
        return false;
    }
    public function fetchAllOrders(){

    }
    public function checkApiKey(){
        return true;
    }
    public function checkContentType(){

    }

}