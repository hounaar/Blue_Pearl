<?php
    session_start();
    if(isset($_SESSION['anon_id'])){
        include_once "/xampp/htdocs/blue-pearl/src/php/connection.php";
        $id= mysqli_real_escape_string($connection, $_GET['id']);
        if(isset($id)){
            $sql = mysqli_query($connection, "UPDATE users SET status = 'Offline' WHERE anon_id='{$id}'");
            if($sql){
                session_unset();
                session_destroy();
                header("location: /blue-pearl/index.php");
            }
        }else{
            header("location: /blue-pearl/portal/index.php");
        }
    }else{  
        header("location: /blue-pearl/index.php");
    }
?>