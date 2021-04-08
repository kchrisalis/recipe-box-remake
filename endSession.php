<?php 

include('functions.php');

if(isset($_SESSION['userID'])) {
    session_unset();
    header('location: index.php');
}

?>