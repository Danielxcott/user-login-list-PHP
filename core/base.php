<?php 

function connSql(){
    return mysqli_connect("localhost","root","","social");
}

$url = "http://{$_SERVER['HTTP_HOST']}/tuto/";

$imageAccept = array("image/png","image/jpeg");
$genderArr = array("male","female");