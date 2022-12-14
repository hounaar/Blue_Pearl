<?php
session_start();
include_once "/xampp/htdocs/blue-pearl/src/php/connection.php";
if(!isset($_SESSION['anon_id'])){
    header("location: /blue-pearl/index.php");
} else {
    $outgoing_id = $_SESSION['anon_id'];
    $incoming_id = mysqli_real_escape_string($connection,$_POST['incoming_id']);
    $message = mysqli_real_escape_string($connection,$_POST['message']);

    $query = $connection->query("INSERT INTO messages (incoming_msg_id,outgoing_msg_id,msg)
    VALUES ('{$incoming_id}','{$outgoing_id}','{$message}')
    ");
    

}




?>