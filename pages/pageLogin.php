<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <title>Login Form</title>



        <link rel="stylesheet" href="../styles/login.css">


    </head>

    <body>
        <div class="login">
            <div class="login-screen">
                <div class="app-title">
                    <h1>Login</h1>
                </div>
        	    <form action = "../php/login.php" method = "post">
                    <div class="login-form">
                        
                        <?php
                            ini_set('display_errors',"1");
                            if(isset($_GET["error"]))
                            {
                                 if($_GET["error"] == 1)
                                 {
                                    echo "wrong password or username";
                                 }
                            }
                        ?>
                        
                        <div class="control-group">
                            <input type="text" class="login-field" value="" placeholder="username"  id="username" name = "username">
                            <label class="login-field-icon fui-user" for="login-name"></label>
                        </div>

                        <div class="control-group">
                            <input type="password" class="login-field" value="" placeholder="password" id="password" name = "password">
                            <label class="login-field-icon fui-lock" for="login-pass"></label>
                        </div>

                        <input type = "submit" value = "login" class="btn btn-primary btn-large btn-block"/>
<!--                  <a class="login-link" href="#">Lost your password?</a>-->
                    </div>
                </form>
            </div>
        </div>

    </body>

</html>