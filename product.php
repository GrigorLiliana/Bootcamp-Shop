<?php
session_start();
//initialize cart if not set or is unset

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}

//unset quantity
unset($_SESSION['qty_array']);
?>
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
    <div class="container">
      <?php
      //info message
      if (isset($_SESSION['message'])) {
        ?>
        <div class="row">
          <div class="col-sm-6 col-sm-offset-6">
            <div class="alert alert-info text-center">
              <?php echo $_SESSION['message']; ?>
            </div>
          </div>
        </div>
        <?php
        unset($_SESSION['message']);
      } ?>

      <?php include_once 'db_connect.php';

      $query = "select c.*, k.* from Courses c inner join categories k on c.id_categorie = k.id_categorie where course_id =" . $_GET['id'];
      $result1 = mysqli_query($conn, $query);
      while ($course = mysqli_fetch_assoc($result1)) {
        $courseId = $course['course_id'];
        $courseImage = $course['image_src'];
        $courseTitle = $course['title'];
        $coursePrice = $course['price'];
        $courseDetails = $course['description'];
        $courseAuthor = $course['author'];
        $courseDate = $course['date'];
        $courseRating = $course['rating'];
        $courseEnrolled = $course['nr_enrolled'];
        $courseCategory = $course['categorie'];
        ?>

        <section id="detailsProduct">
          <img src="<?php echo $courseImage ?>" id="imgDet" class="card-img-top" alt="...">
          <div id="prodDet">
            <h3 class="card-title"><?php echo $courseTitle ?></h3>
            <ul>
              <li><strong>Author: </strong><?php echo $courseAuthor ?></li>
              <li><strong>Date:</strong> <?php echo $courseDate ?></li>
              <li><strong>Students enrolleded:</strong> <?php echo $courseEnrolled ?></li>
              <li><strong>Category:</strong> <?php echo $courseCategory ?></li>
              <li><strong>Crazy Price!</strong> Only <?php echo $coursePrice ?>€!!</li>
              <li><strong>Rating </strong><?php echo $courseRating ?></li>
            </ul>
            <button><a href="add_cart.php?id=<?php echo $courseId ?>&page=product.php" class="card-link">Add to cart</a></button>
          </div>
        </section>
      <?php }

      mysqli_close($conn);
      ?>

      <section id='productDescription'>
        <strong>Description:</strong>
        <p><?php echo $courseDetails ?></p>
      </section>
    </div>
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