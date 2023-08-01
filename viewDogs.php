<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "links.php"; ?>
    <title>View Dogs</title>
    <Style>
        .buttonContainer{
            display: flex;
            justify-content:space-between;


        }
        .imageContainer{
            margin-top: 10vh;
            display: flex;
            justify-content : center;
            flex-direction : column;
            align-items : center;
        }

    </Style>
</head>
<body>
<?php include "navbar.php"; ?>
 <div class="opacitor" style="opacity : .9">
     <div class="imageContainer">
    <img id="image" src="" alt="" height="500px" width="500px">
</div>
<div class="buttonContainer">
    <button id="prev" >prev</button>
    <button id="next">next</button>
</div>
</div>

  <script>
    let url = "https://dog.ceo/api/breeds/image/random";
    let image = document.getElementById("image");
    let prev = document.getElementById("prev");
    let next = document.getElementById("next");

    let dogs = [];
    let current=0;

    if(current === 0){
        prev.disabled = true;
    }
    else{
        prev.disabled = false;
    }

    next.onclick =( ()=>{
       console.log("hello");
        fetch(url)
        .then(response =>{
            if(!response.ok){
                throw new Error("network response was not ok");
            } 
            return response.json();
        })
        .then(data=>{
            dogs.push(data.message);
            console.log(data);
            

            image.src= dogs[current++];
            if(current === 2 )prev.disabled = false;
            console.log(dogs[current]);
        })
        .catch(error=>{
            console.log("Error:",error);
        })
    })

    prev.onclick=()=>{

        if(current > 1)
             { image.src = dogs[current-2];
              current--;
              if(current === 1) prev.disabled = true;
            }
    }


  </script>
</body>
</html>