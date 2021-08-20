<?PHP

//connect to database
$conn = mysqli_connect('us-cdbr-east-04.cleardb.com', 'b79dfda3fca9ce', '83643a68', 'request');

//check connection
if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
}

?>