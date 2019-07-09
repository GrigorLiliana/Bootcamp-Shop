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
<?php include_once 'db_connect.php';

$query = "select * from Courses";
$result = mysqli_query($conn, $query);

echo "<section class = 'allCourses'>";
while ($db_record = mysqli_fetch_assoc($result)) {
    $courseId = $db_record['course_id'];
    $courseImage = $db_record['image_src'];
    $courseTitle = $db_record['title'];
    $coursePrice = $db_record['price'];
    $courseDetails = $db_record['description'];
?>

<div class="card" style="width: 18rem;">
  <img src="<?php echo $courseImage?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?php echo $courseTitle?></h5>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Only <?php echo $coursePrice?>€!!</li>
  </ul>
  <div class="card-body">
    <a href="product.php?id=<?php echo $courseId;?>" class="card-link">More details</a>
    <a href="#" class="card-link">Add to cart</a>
  </div>
</div>

<?php }
echo "</section>";
mysqli_close($conn);
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