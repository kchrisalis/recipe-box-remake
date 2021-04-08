<?php

// establish connection with database
$conn = mysqli_connect('192.168.64.2', 'admin', 'cooking', 'recipe-box');

// check connection
if (!$conn) {
    echo 'connection error' . mysqli_connect_error();
}

// start session for use across the website
session_start();

function explodeContent($explodeBy, $explodee) {
    $exploded = explode($explodeBy, $explodee);
    return $exploded;
}

$faveRec = [];

if (isset($_SESSION['userID']) && $_SESSION['userID'] != 'Admin') {
    $user = $_SESSION['userID'];
    $sql = "SELECT faves FROM users WHERE username = '$user'";
    $results = mysqli_query($conn, $sql);
    $faves = mysqli_fetch_row($results);

    // check if cart is empty
    $EmptyTestArray = array_filter($faves);

    if (!empty($EmptyTestArray)) {
        foreach($faves as $n) {
            $faveRec = explodeContent(',', $n);
        }
    }
}
?>