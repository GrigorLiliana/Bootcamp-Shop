<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">BOOTCAMP SHOP</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="products.php">All Courses</a>

                    <?php include_once 'db_connect.php';

                    $queryCat = "select * from categories";
                    $resultCat = mysqli_query($conn, $queryCat);

                    // generate dinamic categories options linked to the DB

                    while ($db_recordCat = mysqli_fetch_assoc($resultCat)) {
                        $categorieId = $db_recordCat['id_categorie'];
                        $categorieName = $db_recordCat['categorie']; ?>

                        <!-- dinamic link -->
                        <a class="dropdown-item" href="products.php?category=<?php echo $categorieName; ?> ">
                            <?php echo $categorieName; ?>
                        </a>
                    <?php }
                    ?>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link enable" href="my-acount.php" tabindex="-1" aria-disabled="false">My Account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link enable login" href="login.php" tabindex="-1" aria-disabled="false">LOGIN</a>
            </li>
            <li class="nav-item">
                <a class="nav-link enable signup" href="signup.php" tabindex="-1" aria-disabled="false">SIGNUP</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <!-- Add to Cart Button -->
        <div class='cart'>
            <a href="cart.php"><span class="badge"><?php echo count($_SESSION['cart']); ?></span><i class="fas fa-shopping-cart"></i></a>
        </div>
    </div>
</nav>