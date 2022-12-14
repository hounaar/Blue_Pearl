<?php
session_start();
include_once "/xampp/htdocs/blue-pearl/src/php/connection.php";

if(!isset($_SESSION['anon_id'])){
    header("location: /blue-pearl/index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/blue-pearl/src/css/chat.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> 
    <title>Blue Pearl</title>
</head>
<body>
<?php 
        if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($connection,$_GET['id']);
        }
        ?>
    <div class="container mt-5" id="chatplace">
    <?php include_once "/xampp/htdocs/blue-pearl/src/php/navbar.php";?>

       
            <div class="messages chat-box">
              
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
</body>
</html>
