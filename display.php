<?php 

 include "database.php";
 $obj = new query();
 


if(isset($_GET['id'])){

     $id = $_GET['id'];

     if($obj->delete("user",$id)){
        ?>
        <script>alert('data deleted successfully!');</script>
        <?php

        header("location:display.php");
     }
     else{
        ?>
        <script>alert('some error occured while deleting the data');</script>
        <?php
     }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "links.php"; ?>
    <title>Display</title>
</head>
<body>
<?php include "navbar.php"; ?>
    <div class="container">
        <table class= "table table-dark table-striped table-hover table-responsive">
            <thead >
                <th scope='col'>id</th>
                <th scope="col">name</th>
                <th scope = "col" >email</th>
                <th scope = "col" >password</th>
                <th colspan='2' = "col" >operations</th>
            </thead>
            <tbody >
            <?php
 
           

           

            $query = $obj->get_data("user");


            while( $res = mysqli_fetch_array($query)){
               
                ?>
                
                
                <tr>
                        <td><?php echo $res['id'] ?></td>
                        <td><?php echo $res['name'] ?></td>
                        <td><?php echo $res['email'] ?></td>
                        <td><?php echo $res['password'] ?></td>
                        <td><a href="update.php?id=<?php echo $res['id'] ?>">edit</a></td>
                        <td><a href="?id=<?php echo $res['id']?>">delete</a></td>
                    </tr>

            
                <?php
            }
                ?>
               
            </tbody>
        </table>
    </div>
</body>
</html>