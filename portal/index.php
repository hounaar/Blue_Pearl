<?php
session_start();
if(!isset($_SESSION['anon_id'])){
    header("location: /blue-pearl/index.php");
}

?>

<?php include_once "/xampp/htdocs/blue-pearl/src/php/header.php";?>
    <div class="container mt-5" id="main-body">
        <?php include_once "/xampp/htdocs/blue-pearl/src/php/navbar.php";?>
        <?php include_once "/xampp/htdocs/blue-pearl/src/php/connection.php";?>


        <?php 
        if(isset($connection)){
        $query = $connection->query("SELECT * FROM users
        WHERE anon_id = '{$_SESSION['anon_id']}'");
        if($query->num_rows>0){
            while($row = $query->fetch_assoc()){
             
        ?>
        <div class="content">

            <div class="col">id: <?php echo $row['anon_id'];?></div>
            <div class="col">Username: <?php echo $row['username']; ?></div>
            <div class="col">Status: <?php echo $row['status'];?></div>
            <div class="col">Rank: <?php echo $row['rank'];?></div>
            
            <?php }}}?>
        </div>
    </div>

    

