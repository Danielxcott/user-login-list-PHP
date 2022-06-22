<?php
require_once "core/auth.php";
require_once "core/base.php";
require_once "core/function.php";

$id = $_GET['id'];
if(deleteUser($id)){
    location("index.php");
}
