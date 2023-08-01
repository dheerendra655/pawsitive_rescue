<?php 

include "connection.php";



$ids = $_GET['id'];

$selectQuery = "delete from registration where id = $ids";

$query = mysqli_query($conn,$selectQuery);

?>