<?php
    $servername = 'localhost';
    $username = 'root';
    $password = 'joe_mama69420';
    $dbName = 'database_pvbm';

    $conn = mysqli_connect($servername,$username,$password,$dbName);

    if (!$conn) {
        die('Error: ' . mysqli_connect_error());
    }
    
?>    