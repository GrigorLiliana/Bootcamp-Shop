<?php

//check if product is already in the cart
session_start();
if (!in_array($_GET['id'], $_SESSION['cart'])) {
    array_push($_SESSION['cart'], $_GET['id']);
    $_SESSION['message'] = 'Product added to cart';
} else {
    $_SESSION['message'] = 'Product already in cart';
}

header("location:" . $_GET['page']);
