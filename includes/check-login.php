<?php

session_start();

if (!isset($_SESSION['adminName'])) {
  header("location: ./index.php");
  exit();
}
