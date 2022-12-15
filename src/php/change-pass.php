<?php
session_start();
include_once "/home/hounaarc/bluepearl.hounaar.com/src/php/connection.php";

if(isset($_POST['username']) && isset($_POST['passcode'])
 && isset($_POST['repeat'])){
     $username = mysqli_real_escape_string($connection,$_POST['username']);
     $passcode = mysqli_real_escape_string($connection,$_POST['passcode']);
     $repeat = mysqli_real_escape_string($connection,$_POST['repeat']);

     $id_checker = $connection->query("SELECT * 
     FROM users WHERE username = '{$username}'
     ");
     if($id_checker->num_rows == 1){
        if($passcode === $repeat){
            
            $updator = $connection->query("UPDATE users SET
            password = '{$passcode}' WHERE username = '{$username}'
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