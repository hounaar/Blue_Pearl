<?php
session_start();
include_once "/src/php/connection.php";

if(isset($_POST['username']) && isset($_POST['passcode'])
 && isset($_POST['repeat'])){
     $username = mysqli_real_escape_string($connection,$_POST['username']);
     $passcode = mysqli_real_escape_string($connection,$_POST['passcode']);
     $repeat = mysqli_real_escape_string($connection,$_POST['repeat']);

     $id_checker = $connection->query("SELECT username 
     FROM users WHERE username = '{$username}'
     ");
     if($id_checker->num_rows == 0){
        if($passcode === $repeat){
            $newpass = md5($passcode);
            $updator = $connection->query("UPDATE users SET
            password = '{$newpass}' WHERE username = '{$username}'
        ");
        if($updator){
            echo "success";
        } else {
            echo "Something is blocking the server";
        }
        } else {
            echo "Passwords must be the same";
        }
        
     } else {
        echo "Username not found";
     }
} else {
    echo "Something went wrong";
}


?>