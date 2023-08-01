<?php

$name = '';
$email = '';
$id="";
$update_status = "";

include "database.php";

$obj = new query();

if(isset($_GET['id'])){

  $id = $_GET['id'];

  $result = $obj->get_data('user',"*",$id,"");

  $row = $result->fetch_assoc();
  
  $name = $row['name'];
  $email = $row['email'];  

}

if(isset($_POST['submit'])){
     
   $name = $obj->validate_str($_POST['name']);
   $email = $obj->validate_str($_POST['email']);
   $password = $obj->validate_str($_POST['password']);

   $check_password = $obj->get_data("user",'password',$id,'');
   
   $pswd = $check_password->fetch_assoc();

   
   if($password != $pswd['password'] ){
         $update_status = "incorrect password";
   }
   else{

    $data_arr = array("name"=>$name,"email"=> $email);
    if($obj->update('user',$data_arr,$id)){
      $update_status = "data updated successfully";
      header("location:display.php");
    }
    else{
      $update_status="some error occured please try again later";
    }
   }

}






?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include "links.php" ; ?>

  <style>
    .background{
      background-color : #878c89eb;
    }
  </style>
  <title>registration</title>
</head>
<body>

<div class="row mt-5 ">
  <div class="mx-auto col-6 col-md-4 col-lg-3 background">

    <form method="POST">
      <div class="mb-3">
        <div style="color:red"><?php echo $update_status ?></div>
        <label for="exampleInputName" class="form-label">Name</label>
        <input type="text" name="name" class="form-control  rounded-0" id="exampleInputName" required="true" value="<?php echo $name; ?>">
        <div id="emailHelp" class="form-text">This field is mandatory</div>
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control rounded-0" id="exampleInputEmail1" aria-describedby="emailHelp" required = "true" value="<?php echo $email; ?>">
        <div id="emailHelp" class="form-text">This field is mandatory</div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" name = "password" class="form-control rounded-0" id="exampleInputPassword1" required="true" >
        <div id="emailHelp" class="form-text">This field is mandatory</div>
      </div>
    
      <button type="submit" name ="submit" class="btn btn-dark rounded-0 d-block  w-25 mx-auto my-2  ">update</button>
    </form>
  </div> 
</div>
</body>
</html>
<?php 


 