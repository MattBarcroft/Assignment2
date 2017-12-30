    <div class="container theme-showcase" role="main">
      <div class="jumbotron">
        <form method="POST" action="/users/insert_user">
          <h1>Register<h1>
          <h3>Create Your Account</h3>
          <div class="col-md-6">
            <div class="form-group">
              <label for="name">Name:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user fa"></i></span>
                <input type="text" class="form-control" id="name" name="name">
              </div>
            </div>

            <div class="form-group">
              <label for="pwd">Username:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users fa"></i></span>
                <input type="text" class="form-control" id="username" name="username">
              </div>
            </div>

            <div class="form-group">
              <label for="pwd">Email:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope fa"></i></span>
                <input type="text" class="form-control" id="email" name="email">
              </div>
              <p id="email-validation"></p>
            </div>
          
            <div class="form-group">
              <label for="pwd">Password:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock fa"></i></span>
                <input type="password" class="form-control" id="password" name="password">
              </div>
            </div>
            <div>
              <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
            </div>
          </div>
          <div class="col-md-6"></div>
        <form>
      </div>
    </div>

    <script>
    $(document).ready(function(){
      $("#email").keypress(function(){
        function validateEmail(email) {
          var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          return regex.test(email);
        }
        var email = $("#email").val();
        validateEmail(email);
        if (!validateEmail(email)) {
          $("#email-validation").text(email + " is not valid");
          $("#email-validation").css("color", "red");
        } else {
          $("#email-validation").text("");
          
        }
      });
    });

    </script>