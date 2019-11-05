<?php
  session_start();

  include_once "server.php";

  if (isset($_POST['signin'])) {
    //Fetch details from form
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
      header("location: ../index.php");
      $_SESSION['message'] = "Please provide both username and password!";
      exit();
    } else {
      
      $sql = "SELECT * FROM `admindetails` WHERE ad_username=? OR ad_email=?;";

      $stmt = mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?sqlerror");
        exit();
      } else {
        mysqli_stmt_bind_param($stmt,"ss",$username,$username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

          // Check for matching password
          if ($row = mysqli_fetch_assoc($result)) {
            $passwordCheck = password_verify($password, $row['ad_password']);
            if ($passwordCheck == false) {
              $_SESSION['message'] = "Invalid username or password!";
              header("location: ../index.php");
              exit();

            } else if ($passwordCheck == true) {
              $_SESSION['adminName'] = $row['ad_username'];
              header("location: ../dashboard.php");
              exit();

            } else {
              header("location: ../index.php");
              exit();
            }
          } else {
            header("location: ../index.php");
            $_SESSION['message'] = "User account not found!";
            exit();
          }
        }
    }

    //Fetch username and password from db.






  }

  if (isset($_GET['signout'])) {
    header("location: ../index.php");
    session_destroy();
  }

?>
