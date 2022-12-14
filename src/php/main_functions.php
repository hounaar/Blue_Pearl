<?php
session_start();
include_once "/blue-pearl/src/php/connection.php";

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = mysqli_real_escape_string($connection,$_POST['username']);
    $password = mysqli_real_escape_string($connection,$_POST['password']);
}
function login(){
    global $connection;
    global $username;
    global $password;
    $new_pass = md5($password);
    if($new_pass === $password){
        $query = $connection->query("SELECT * FROM users WHERE 
        username = '{$username}' AND password = '{$new_pass}'
        ");
        if($query->num_rows>0){
            while($row = $query->fetch_assoc()){
               $status_updator = $connection->query("UPDATE users SET
               status = 'Online' WHERE username = '{$row['username']}'");
               if($status_updator){
                $_SESSION['anon_id'] = $row['anon_id'];
                echo "success";
               }
            }
        } else {
            echo "Something went wrong logging in";
        }
    } else {
        echo "Something is blocking logining process";
    }
}

function signup(){
    global $connection;
    global $username;
    global $password;
    $new_pass = md5($password);
    if($new_pass === $password){
        $anon_id = rand(time(), 100000000);
        $date = date("Y-m-d H:i:s");
        $query = $connection->query("INSERT INTO users
        VALUES('{$anon_id}','{$username}','$new_pass','Online','Rookie','{$date}')
        ");
        if($query){
            $new_query = $connection->query("SELECT * FROM users WHERE
            username = '{$username}'
            ");
            if($new_query->num_rows>0){
                while($row = $new_query->fetch_assoc()){
                    $_SESSION['anon_id'] = $row['anon_id'];
                    echo "success";
                }
            }
        }
    }
}



?>