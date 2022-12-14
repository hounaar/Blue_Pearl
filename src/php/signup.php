<?php
session_start();
include_once "/blue-pearl/src/php/connection.php";

    $username = mysqli_real_escape_string($connection,$_POST['username']);
    $email = mysqli_real_escape_string($connection,$_POST['email']);
    $password = mysqli_real_escape_string($connection,$_POST['password']);
    $date = date("Y-m-d H:i:s");

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "Please enter a valid email address";
    } else {
    $new_pass = md5($password);
    $checkout = $connection->query("SELECT username FROM users WHERE username = '{$username}'");
    if($checkeout->num_rows == 1){

    } else {
            $anon_id = rand(time(),1000000000);
            $signup = $connection->query("INSERT INTO users
            VALUES('{$anon_id}','{$username}','$new_pass','Online','Rookie','{$date}')");
            if($signup){
                $checker = $connection->query("SELECT * FROM users WHERE 
                username = '{$username}' AND password = '{$new_pass}'");
                if($checker->num_rows>0){
                    while($rows = $checker->fetch_assoc()){
                        $_SESSION['anon_id'] = $rows['anon_id'];
                        echo "success2";
                    }
                } else {
                    echo "something went wrong with signup";
                }
            } else {
                echo "Something is blocking the servers";
            }
        }
    }
        ?>