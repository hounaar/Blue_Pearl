<?php
session_start();
if(!isset($_SESSION['anon_id'])){
    header("location: /blue-pearl/");
}

?>

<?php include_once "/xampp/htdocs/blue-pearl/src/php/header.php";?>
    <div class="container mt-5" id="main-body">
        <?php include_once "/xampp/htdocs/blue-pearl/src/php/navbar.php";?>
        <?php include_once "/xampp/htdocs/blue-pearl/src/php/connection.php";?>
  

            <div class="content">
                <div class="col">
                    <h3>Select a user to start the chat</h3>
                </div>
                <?php 
                if(isset($connection)){
                $anon_id = $_SESSION['anon_id'];
                $query = $connection->query("SELECT * FROM users
                WHERE NOT anon_id = '{$anon_id}';
                ");
                
                if($query->num_rows > 0 ){
                    while($row = $query->fetch_assoc()){
                        echo '<a href="/blue-pearl/portal/chatportal/index.php?id='.$row['anon_id'].'">
                        <div class="col">'.$row['username'].'>>>>'.($row['status']).'
                        
                        </div>
                    </a>';
                    }
                } else {
                    echo 'No users found.';

                   
                } 
            }
                ?>

               

            </div>




    </div>


</body>
</html>
