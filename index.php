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

<!DOCTYPE html>
<html>
  <head>
    <title>Auphan Software - Application</title>
    <link rel="shortcut icon" href="http://www.auphansoftware.com/templates/standard/images/auphan_logo_no_text.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
      console.log(`Thank you for reviewing my application. This is my solution to the question posted http://www.auphansoftware.com/dev.txt`)
      //EMAIL VALIDATION FUNCTION
      function validateEmail(input) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        return re.test(String(input).toLowerCase());
      }
      //JQUERY & AJAX
      $(() => {

        $("#submit_login").on("click", (e) => {
          e.preventDefault();
          $('.incorrect_login').hide();
          $('.missinfo_login').hide();
          $('.invalid_login').hide();

          let email = $('#username').val();
          let password = $('#userpassword').val();

          let dataString = 'email=' + email + '&password=' + password;

          //EMPTY INPUT
          if (!email || !password) {
            $('.missinfo_login').show();

          //VALID EMAIL
          } else if (validateEmail(email)) {
            $.ajax({
              data: dataString,
              type:'POST',
              success: function(result) {
                if (result === "Error" ) {
                  $('#username').val("");
                  $('#userpassword').val("");
                  $('.incorrect_login').show();
                } else {
                  $('.login').hide()
                  $('#response').append($(`<h2 class="title_login">${result}</h2>`))
                                .append($(`<p>Thank you for reviewing my application! Please checkout my resume <a href="https://jennypoon.github.io/" target="_blank">here</a><br><br>You may reach me by <a href="mailto:jenny.poon@live.ca">email</a><br> or at: 604-716-7891.</p>`));
                };
              },
              error: function(error) {
                console.log("ERROR - FAILED AJAX REQUEST");
                $('.incorrect_login').show();
                $('#username').val("");
                $('#userpassword').val("");
              }
            });
          //INVALID EMAIL
          } else {
            $('.invalid_login').show()
          }
        });
      });
    </script>

  <!-- STYLING -->
    <style>
      html {
        background-image: url(http://www.auphansoftware.com/templates/standard/images/techstrategy.jpg);
        font-family: sans-serif;
      }

      a {
        color: #54C7E3;
        text-decoration: none ;
      }

      a:hover
      {
        color: #FB6B6B;
        text-decoration:none;
        cursor:pointer;
       }

      #submit_login {
        font-size: 1em;
        margin-top: 10px;
        padding: 10px;
        border-radius: 5px;
        width: 50%;
      }

      #overlay {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0,0,0,0.5);
      }

      .login,.success_login,#response {
        color: black;
        z-index: 2;
        position:fixed;
        top: 50%;
        left: 50%;
        width:20em;
        margin-top: -8em;
        margin-left: -10em;
        border: 1px solid #eee;
        background-color: #f3f3f3;
        padding: 15px;
        text-align: center;
        border-radius: 5px;
        box-shadow: 2px 4px #888888;
      }

      .input_login {
        padding: 5px;
        border-radius: 5px;
        border:solid 1px #ccc;
      }

      .success_login,.incorrect_login,.missinfo_login,.invalid_login {
        display: none;
        color: #FB6B6B;
      }

      .title_login {
        color: #FEE35B;
        letter-spacing: 3px;
        border: 1px;
        -webkit-text-stroke-width: 0.5px;
        -webkit-text-stroke-color: black;
      }
    </style>
  </head>
  <body>
    <div id="overlay"></div>
    <div id="response"></div>

    <div>
      <form class="login">
        <h2 class="title_login">LOGIN</h2>
        <div class="incorrect_login">Incorrect Username/Password</div>
        <div class="missinfo_login">Missing Username/Password</div>
        <div class="invalid_login">Invalid Email Entered</div>
        <p>
          <label for="username"><span>Username:</span></label>
          <input class="input_login" type="text" id="username" name="username" required>
        </p>
        <p>
          <label for="password"><span>Password:</span></label>
          <input class="input_login" type="password" id="userpassword" name="userpassword" required>
        </p>
        <button id="submit_login" type="submit">Login</button>
      </form>
    </div>
  </body>
</html>