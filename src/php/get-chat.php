<?php
session_start();
include_once "/xampp/htdocs/blue-pearl/src/php/connection.php";
if(!isset($_SESSION['anon_id'])){
    header("location: /blue-pearl/");
} else {
    $outgoing_id = $_SESSION['anon_id'];
    $incoming_id = mysqli_real_escape_string($connection,$_POST['incoming_id']);

        $query = $connection->query("SELECT * FROM messages 
        LEFT JOIN users ON users.anon_id = messages.outgoing_msg_id WHERE
        (outgoing_msg_id = '{$outgoing_id}' AND incoming_msg_id = '{$incoming_id}')
        OR
        (outgoing_msg_id = '{$incoming_id}' AND incoming_msg_id = '{$outgoing_id}') ORDER BY msg_id ASC");
        if($query->num_rows>0){
            while($row = $query->fetch_assoc()){
                if($row['outgoing_msg_id'] === $outgoing_id){ //msg sender 
                    echo '
                        <div class="col outgoing">
                        <span class="riddle">??</span>
                        <span>Blue Pearl >></span>
                        <span>'.$row['username'].'('.$row['status'].') : </span>
                        <span>'.$row['msg'].'</span>
                </div>';
                } else { //msg reciever
                    echo '               
                    <div class="col incomming">
                        <span class="riddle">??</span>
                        <span>Blue Pearl >></span>
                        <span>'.$row['username'].' ('.$row['status'].') : </span>
                        <span>'.$row['msg'].'</span>
                    </div>';
                }
        }


}
}

    ?>