<?php
  if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {

    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($email == "hr@auphansoftware.com" && $password == "hello") {
      echo "Login Successful!";
      exit;
    } else {
      echo "Error";
      exit;
    }
  }
?>