<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel='stylesheet' href='styles/style.css'>
</head>

<body>
    <header>
        <?php include_once 'header.php' ?>
    </header>
    <main>
        <?php

        $emailErr = $passErr = "";
        $email = $pass = $login = "";

        if (isset($_POST['submit'])) {

            //check email
            if (empty($_POST["email"])) {
                $emailErr = "**Email is required";
            }
            if ($checkEmail = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $queryEmail = "SELECT email FROM users";
                $allEmail = mysqli_query($conn, $queryEmail);
                $emailArray = [];
                $i = 0;
                while ($emails = mysqli_fetch_assoc($allEmail)) {
                    $emailArray[$i] = $emails['email'];
                    $i++;
                }

                $checkEmailExists = in_array($checkEmail, $emailArray);

                if (!$checkEmailExists) {
                    $emailErr = "**This email doesn't exists";
                } else {
                    //define email value
                    $email = htmlspecialchars($_POST["email"]);

                    //get password hashed from DB from this email
                    $queryPass = "SELECT hash_pass from users where email = '$email'";
                    $resultPass = mysqli_query($conn, $queryPass);
                    $passSaved = "";
                    if ($resultPass) {
                        while ($pass = mysqli_fetch_assoc($resultPass)) {
                            $passSaved = $pass['hash_pass'];
                        }
                    }
                }
            } else {
                $emailErr = "**Invalid email format";
            };



            // password requirements

            $pass = htmlspecialchars($_POST['password']);
            $uppercase = preg_match('@[A-Z]@', $pass);
            $lowercase = preg_match('@[a-z]@', $pass);
            $number = preg_match('@[0-9]@', $pass);
            $specialChars = preg_match('@[^\w]@', $pass);

            //check password

            if (empty($pass)) {
                $passErr = "**Password is required";
            }
            if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
                $passErr = '**Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
            } else {
                //check repeat pas
                $confPass = password_verify($pass, $passSaved);
                echo $confPass;
                if (!$confPass) {
                    $passErr = "Your password doesn't match";
                }
            }

            // All required fields are well filled
            if ($email && $confPass) {
                $login = 1;
                
            }
            if ($login) {

                $lastQuery = "SELECT * FROM users WHERE email = '$email'";
                $lastResult = mysqli_query($conn, $lastQuery);
                while($resu = mysqli_fetch_assoc($lastResult)) {
                    $name = $resu['name'];
                }

                $_SESSION["user"] = $name;
                header("location: index.php?user=$name");
            }
        }
        ?>

        <form id="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <h3>Login</h3>

            <!--E-mail-->

            <label for="email">E-mail:*</label>
            <input required type="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" placeholder="exemplo@mail.com">
            <small><?php echo ($emailErr); ?></small>

            <!--Password-->

            <label for="password">Password:*</label>
            <input required type="password" name="password" placeholder="Choose your password">
            <small><?php echo ($passErr); ?></small>


            <input type="submit" value="Login" name="submit">
            <a href="forgot.php">Are you forgot the password?</a>
            <!-- Message if all fields are well filled -->
            <strong><?php echo ($login); ?></strong>
        </form>


    </main>
    <footer>
        <?php include_once 'footer.php' ?>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/ff9603d652.js"></script>
</body>

</html>