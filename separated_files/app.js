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
                          .append($(`<p>Thank you for reviewing my application! Please checkout my resume <a href="https://jennypoon.github.io/" target="_blank">here</a><br><br>You may reach me by <a href="mailto:jenny.poon@live.ca">email</a>`));
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