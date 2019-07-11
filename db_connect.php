
/*--------------- ------------------- Data connection -----------------------------------------*/

//connect to database server
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD);
//echo 'Connection successufull' . '<br>';

// choose database to use
$db_name = 'sta38';
$db_found = mysqli_select_db($conn, $db_name);

//mysqli_close($conn);
