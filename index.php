<?php
session_start();

if(isset($_SESSION["Login"])){
    ?>
    <script>
        location.href = "overview.php";
    </script>
    <?php
exit();
}



?>
<html>
<head>
    <title>Klanus Login</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/login.js" ></script>

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #17a2b8;
            height: 100vh;
        }
        #login .container #login-row #login-column #login-box {
            margin-top: 120px;
            max-width: 600px;
            height: 400px;
            border: 1px solid #9C9C9C;
            background-color: #EAEAEA;
        }
        #login .container #login-row #login-column #login-box #login-form {
            padding: 20px;
        }
        #login .container #login-row #login-column #login-box #login-form #register-link {
            margin-top: -85px;
        }
    </style>
</head>

<body>
<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <div id="login-form" class="form" action="" method="post">
                        <h3 class="text-center text-info">Login</h3>
                        <div class="form-group">
                            <label for="username" class="text-info">Name oder E-mail:</label><br>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Password:</label><br>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">

                            <br/>
                            <input onclick="login(document.getElementById('username').value, document.getElementById('password').value)" type="submit" name="submit" class="btn btn-info btn-md" value="senden">
                        </div>
                        <div id="register-link" class="text-right">
                            <a href="register.php" class="text-info">Hier Registern</a>
                        </div>
                        <br/>
                        <br/>
                        <br/>
                        <span id="res" ></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>