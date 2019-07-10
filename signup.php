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


    $nameErr = $adressErr = $emailErr = $passErr = $repPassErr = "";
    $name = $adress = $email = $pass = $repPass = $signin = "";


    if (isset($_POST['submit'])) {
      //check complet name

      if (empty($_POST['name'])) {
        $nameErr = "**Name is required";
      } else
        $name = test_input($_POST["name"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $nameErr = "**Only letters and white space allowed";
      }

      //check last name

      if (empty($_POST['adress'])) {
        $adressErr = "**Adress is required";
      }
      if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $adressErr = "**Only letters and white space allowed";
      } else $adress = test_input($_POST["adress"]);

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
        };

        $checkEmailExists = in_array($checkEmail,  $emailArray);

        if ($checkEmailExists) {
          $emailErr = "**This email alread exists";
        } else {
          $email = htmlspecialchars($_POST["email"]);
        }
      } else {

        $emailErr = "**Invalid email format";
      }


      // password requirements

      $pass = htmlspecialchars($_POST['password']);
      $uppercase = preg_match('@[A-Z]@', $pass);
      $lowercase = preg_match('@[a-z]@', $pass);
      $number = preg_match('@[0-9]@', $pass);
      $specialChars = preg_match('@[^\w]@', $pass);

      //check password

      if (empty($_POST['password'])) {
        $passErr = "**Password is required";
      }
      if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
        $passErr = '**Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
      } else $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

      //check repeat pass

      if (empty($_POST['repeatpassword'])) {
        $repPassErr = "**Confirm your password";
      }
      if (isset($_POST['repeatpassword'])) {
        $repPass = password_verify(htmlspecialchars($_POST['repeatpassword']), $pass);
        echo $repPass;
      }

      // All required fields are well filled
      if ($name && $adress && $email && $pass && $repPass) {
        echo $name . " " . $adress . " " . $email . " " . $pass . " " . $repPass;
        $queryValid = "INSERT INTO users (user_id, name, adress, email, hash_pass) VALUES (NULL,'$name','$adress','$email', '$pass');";

        $resultValid = mysqli_query($conn, $queryValid);
        var_dump($resultValid);
        if ($resultValid) {
          $signin = "**Congratulations, you are successiful signin!**";
        }
      }
    }

    function test_input($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    ?>


    <form id="signup" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

      <h3>Sign-in</h3>

      <!--Complet name-->

      <label for="firstName"> Complet name:* </label>
      <input required type="text" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>" name="name" placeholder="Enter your complet name">
      <small><?php echo ($nameErr); ?></small>

      <!--Adress-->

      <label for="adress">Adress:*</label>
      <input required type="text" name="adress" value="<?php if (isset($_POST['adress'])) echo $_POST['adress']; ?>" placeholder="Enter your adress">
      <small><?php echo ($adressErr); ?></small>
      <!--E-mail-->

      <label for="email">E-mail:*</label>
      <input required type="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" placeholder="exemplo@mail.com">
      <small><?php echo ($emailErr); ?></small>

      <!--Password-->

      <label for="password">Password:*</label>
      <input required type="password" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>" name="password" placeholder="Choose your password">
      <small><?php echo ($passErr); ?></small>

      <!--Confirm password-->

      <label for="repeatpassword">Repeat password:* </label>
      <input reauired type="password" name="repeatpassword" placeholder="Confirm your password">
      <small><?php echo ($repPassErr); ?> </small>
      <!-- submit -->

      <input type="submit" value="Join us!" name="submit">

      <!-- Message if all fields are well filled -->
      <strong><?php echo ($signin); ?></strong>
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