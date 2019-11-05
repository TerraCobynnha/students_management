<?php

include 'server.php';

// No. of Students
$sql = "SELECT * FROM studentdetails;";
$result = mysqli_query($conn, $sql);
$numOfStudents = mysqli_num_rows($result);

$sql = "SELECT * FROM admindetails;";
$result = mysqli_query($conn, $sql);
$numOfAdmins = mysqli_num_rows($result);

$sql = "SELECT * FROM staffdetails;";
$result = mysqli_query($conn, $sql);
$numOfStaff = mysqli_num_rows($result);


$sql = "SELECT * FROM studentdetails ORDER BY std_joined DESC LIMIT 3;";
$result = mysqli_query($conn, $sql);
