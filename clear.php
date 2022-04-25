<?php
//clear session
session_start();
$destroy = $_POST['destroy'];
if ($destroy == 1) {
    session_destroy();

    $_POST = [];
    $_POST['amount'] == 25;
    $_POST['rating'] == 'g';
    $_POST['category'] == 'trending';
    ?>
    <script>window.location.replace("http://localhost/gifapiphp/index.php");</script><!--localhost url-->
<?php
}
