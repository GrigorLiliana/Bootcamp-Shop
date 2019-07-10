<?php
session_start();

//check if product is already in the cart
if (!in_array($_GET['course_id'], $_SESSION['cart'])) {
    array_push($_SESSION['cart'], $_GET['course_id']);
    $_SESSION['message'] = 'Product added to cart';
} else {
    $_SESSION['message'] = 'Product already in cart';
}

//header('location: Home.php');
