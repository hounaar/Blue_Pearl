<?php
session_start();
include_once "/xampp/htdocs/blue-pearl/src/php/connection.php";

if(isset($_POST['username']) && isset($_POST['password']) && isset($connection)){
    $username = mysqli_real_escape_string($connection,$_POST['username']);
    $password = mysqli_real_escape_string($connection,$_POST['password']);
    $date = date("Y-m-d H:i:s");


        $query = $connection->query("SELECT * FROM users WHERE
        username = '{$username}' AND password = '{$password}'
        ");
        if($query->num_rows>0){
            while($row = $query->fetch_assoc()){
                $status = 'Online';
                $status_updator = $connection->query("UPDATE users 
                    SET status = '{$status}' WHERE anon_id = '{$row['anon_id']}'
                ");
                if($status_updator){
                    $_SESSION['anon_id'] = $row['anon_id'];
                    echo "success";
                } else {
                    echo "Something went wrong";
                }
            }
        } else {
            
            $anon_id = rand(time(),1000000000);
            $signup = $connection->query("INSERT INTO users
            VALUES('{$anon_id}','{$username}','$password','Roockie','Online','{$date}')");
            if($signup){
                $checker = $connection->query("SELECT * FROM users WHERE 
                username = '{$username}' AND password = '{$password}'");
                if($checker->num_rows>0){
                    while($rows2 = $checker->fetch_assoc()){
                        $_SESSION['anon_id'] = $rows2['anon_id'];
                        echo "success";
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