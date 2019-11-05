<?php
  $dbServername = "localhost";
  $dbUsername = "root";
  $dbPassword = "DBtcby2120";
  $dbName = "terracom";

  $conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);

  if (!$conn) {
    echo "Connection failed!";
  }
  
?>
