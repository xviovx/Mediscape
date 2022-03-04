<?php include '../server/sign_user.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--library-files-->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@300;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Varta:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!--local files-->
    <link rel="stylesheet" type="text/css" href="../css/sign_in.css">

    <title>Mediscape | Sign In</title>
</head>
<body>
    <div class="header-con">
        <div class="logo-con">

        </div>
    </div>

    <div class="body-con">
        <div class="content-con">
            <div class="image-holder">
                <div class="sign-in-img">

                </div>
            </div>
            <div class="form-holder">
                <h1>SIGN IN</h1>
                <h3>Mediscape management portal</h3>
                <form action="sign_in.php" method="post">
                    <input type="email" name="email" placeholder="EMAIL ADDRESS" required>
                    <br>
                    <input type="password" name="pass_1" placeholder="PASSWORD" required>
                    <br>
                    <button type="submit" name="sign_in_btn">SIGN IN</button>
                </form>
                <p>Don't have an account yet? <span>Register <a href="register.php">here</a></span></p>
                
                <div class="error-block">
                    <?php include '../server/error.php'; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>