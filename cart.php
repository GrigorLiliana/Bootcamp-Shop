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
        <div class="container">
            <h1 class="page-header text-center">Cart Details</h1>
            <div class="row">
                <div class="col-sm col-sm-offset-2">
                    <?php
                    if (isset($_SESSION['message'])) {
                        ?>
                        <div class="alert alert-info text-center">
                            <?php echo $_SESSION['message']; ?>
                        </div>
                        <?php
                        unset($_SESSION['message']);
                    }

                    ?>
                    <form method="POST" action="save_cart.php">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th></th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </thead>
                            <tbody>
                                <?php
                                //initialize total
                                $total = 0;
                                if (!empty($_SESSION['cart'])) {

                                    //create array of initail qty which is 1
                                    $index = 0;
                                    if (!isset($_SESSION['qty_array'])) {
                                        $_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
                                    }
                                    $query = "SELECT * FROM Courses WHERE course_id IN (" . implode(',', $_SESSION['cart']) . ")";
                                    $results = mysqli_query($conn, $query);
                                    //var_dump($query);
                                    //var_dump($results);
                                    while ($db_record = mysqli_fetch_assoc($results)) {
                                        $courseId = $db_record['course_id'];
                                        $courseTitle = $db_record['title'];
                                        $coursePrice = $db_record['price'];
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="delete_item.php?id=<?php echo $courseId; ?>&index=<?php echo $index; ?>" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></span></a>
                                            </td>
                                            <td><?php echo $courseTitle; ?></td>
                                            <td><?php echo number_format('id', 2); ?></td>
                                            <input type="hidden" name="indexes[]" value="<?php echo $index; ?>">
                                            <td><input type="text" class="form-control" value="<?php echo $_SESSION['qty_array'][$index]; ?>" name="qty_<?php echo $index; ?>"></td>
                                            <td><?php echo number_format($_SESSION['qty_array'][$index] * $coursePrice, 2); ?></td>
                                            <?php $total += $_SESSION['qty_array'][$index] * $coursePrice; ?>
                                        </tr>
                                        <?php
                                        $index++;
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="4" class="text-center">No Itens in Cart</td>
                                    </tr>
                                <?php
                                }

                                ?>
                                <tr>
                                    <td colspan="4" align="right"><b>Total</b></td>
                                    <td><b><?php echo number_format($total, 2); ?></b></td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
                        <button type="submit" class="btn btn-success" name="save">Save Changes</button>
                        <a href="clear_cart.php" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Clear Cart</a>
                        <a href="order.php" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Checkout</a>
                    </form>
                </div>
            </div>
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