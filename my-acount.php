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
    <script src="https://kit.fontawesome.com/80c962dd4c.js"></script>
</head>
<body>
    <header>
    <?php include_once 'header.php' ?>
    </header>
<main>


<?php
if($_SESSION['user']){
    $myAc = $_SESSION['user'];
    $queryAc = "select * from users where name = '$myAc'";
    $resultAc = mysqli_query($conn, $queryAc);

    // generate dinamic categories options linked to the DB

    while ($db_recordAc = mysqli_fetch_assoc($resultAc)) {
        $acountName = $db_recordAc['name'];
        $acountEmail = $db_recordAc['email']; 
        $acountAdress = $db_recordAc['adress'];
    }

        ?>

        <!-- Profil -->
        <div class="container">
        <h1><?php echo $acountName; ?>, welcome to your space</h1>
        <div style="display: flex;" >
    <div class="card" style="width: 18rem;">
    <div class="card-body">
    <h5 class="card-title"><i class="fas fa-user"></i> My profil</h5>
    <h6 class="card-subtitle mb-2 text-muted"><strong>Name: </strong> <?php echo $acountName; ?></h6>

    <!-- Edit name -->
    <?php if(isset($_GET['edit'])){
        if($_GET['edit'] == "name"){ ?>
        <form action="" method="get">
        <input type="text" placeholder="Enter your name" name="newName">
    <input type="submit" name="submit" value="Edit">
        </form>

      <?php }
      
      if($_GET['change'] == "name"){
        echo "name changed";
      };} ?>
    
    
    <h6 class="card-subtitle mb-2 text-muted"><strong>Email: </strong><?php echo $acountEmail; ?></h6>
    <h6 class="card-subtitle mb-2 text-muted"><strong>Adress: </strong><?php echo $acountAdress; ?></h6>
    <a href="my-acount.php?edit=name" class="card-link">Edit name</a>
    <a href="my-acount.php?edit=adress" class="card-link">Edit adress</a>
  </div>
</div>

<!-- Settings -->
<div class="card" style="width: 18rem;">
    <div class="card-body">
    <h5 class="card-title"><i class="fas fa-user-cog"></i> Advanced settings</h5>
    <h6 class="card-subtitle mb-2 text-muted">

    <strong>Password: </strong> 
    <input type="password" placeholder="Enter your password" name="password">
    </h6>
    <h6 class="card-subtitle mb-2 text-muted">

    <strong>New password: </strong> 
    <input type="password" placeholder="Enter other password" name="newPassword">
    </h6><h6 class="card-subtitle mb-2 text-muted">

    <strong>Confirm new password: </strong> 
    <input type="password" placeholder="Confirm your password" name="confirmPassword">
    </h6>
    <a href="my-acount.php?edit=password" class="card-link">Define new password</a>
  </div>
</div>

<!-- Delete User -->
<div class="card" style="width: 18rem;">
    <div class="card-body">
    <h5 class="card-title"><i class="fas fa-exclamation-triangle"></i> Delete account</h5>
    <h6 class="card-subtitle mb-2 text-muted">

    <strong>Warning: this step is irreversible! </strong> 
    </h6>
    <a href="my-acount.php?edit=delete" class="card-link">Delete account</a>
  </div>
</div>

<!-- Consult orders -->
<div class="card" style="width: 18rem;">
    <div class="card-body">
    <h5 class="card-title"><i class="fas fa-people-carry"></i> Consult previuos orders</h5>
    <a href="my-acount.php?edit=details" class="card-link">Details</a>
  </div>
</div>
</div>
</div>

<?php } 

if(!$_SESSION['user']){
    header("location: login.php");}

?>


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