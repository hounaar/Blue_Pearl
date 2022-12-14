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
        if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($connection,$_GET['id']);
        }
        ?>
            <div class="messages chat-box" style="max-height: 460px; overflow:auto;">
              
            </div>
    </div>


    <div class="container" id="type">
        <form class="form-group typing-area">
            <div class="row">
                <div class="col-lg-11">
                    <input type="text" class="incoming_id form-control" name="incoming_id" value="<?php echo $id; ?>" hidden>
                    <input type="text" name="message" required placeholder="Type command" class="typing-input form-control">
                </div>
                <div class="col-sm">
                    <button class="btn btn-primary typing-send">Apply</button>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript" src="/blue-pearl/src/js/chat.js"></script>
