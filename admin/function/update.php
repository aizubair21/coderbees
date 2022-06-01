<?php


// require "connection.php";
// include "nav.php";

// if(!$_SESSION["key"]) {
//     header("location: login.php");
// }


// //session_unset();
// $id = $_REQUEST["uid"] ?? "";
// $row = getCurd($id);

// $caption = $_POST["caption"] ?? "";
// $description = $_POST['description'] ?? "";
// $image = $_FILES["image"]['name'] ?? "";


// if (isset($_POST["submit"])) {
  
//     //get id from input
//     $uid = $_POST['update_id'] ?? ""; 

//     //get datbase data
//     $row = getCurd($uid);

//     //if i chose an another image
//     if($_FILES['image']['name']) {
//         $insert = "UPDATE crud SET caption='$caption', description='$description', image='$image' WHERE id = $uid ";
//         if(mysqli_query($conn,$insert)){
            
//             if (move_uploaded_file($_FILES["image"]["tmp_name"], "image/". $_FILES["image"]['name'])) {
            
//             $_SESSION['status'] = "Successfully Updated with Image Update. Your previous image has deleted from server !";    
//             @unlink('image/'.$row["image"]);
//             header("location: dashboard.php");
//         }
//     }
        
//     }else {
        
//         $insert = "UPDATE crud SET caption ='$caption', description='$description' WHERE id = $uid ";
//         if(mysqli_query($conn,$insert)){

//             $_SESSION['status'] = "Successfully Updated";

//             header("location: dashboard.php");
//         }
//     }
 
// }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data - Nww data insert to database</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-6">
                <div class="card">
                <div class="bg-primary text-white p-3" style="font-size:20px; text-align:center; font-weight:bold">
                        Update Data
                    </div>

                   
                    <div class="card-body">

                        <form action="update.php" method="POST" enctype="multipart/form-data">
                            <div>
                                <input type="hidden" name="update_id" value="<?php echo ($_REQUEST['uid']) ?>">

                                <div style="padding:3px 0px">
                                    <label for="previous_image">Previous image :</label><br>
                                    <img width="300"  src="image/<?php echo $row['image'] ?>" alt="Not found!" name="previous_image" id="previous_image">
                                </div><br>

                                <div>
                                    <label for="image">Image :</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div><br>
                             
                                
                                <div>
                                    <label class="form-label" for="caption ">Caption  :</label>
                                    <input type="text" name="caption" value="<?php echo $row['caption'] ?>" id="caption" placeholder="Your Image caption..." class="form-control">
                                </div><br>

                                <div>
                                    <label class="form-label" for="Description ">Description  :</label>
                                    <input type="text" name="description" value="<?php echo $row['description'] ?>" id="description" placeholder="Your Image Description..." class="form-control">
                                </div><hr>

                                <div class="d-flex justify-content-between align-items-baseline">
                                    <a class="btn btn-danger" href="dashboard.php">Cancel</a>
                                    <strong>OR</strong>
                                    <button type="submit" name="submit"  class="btn btn-primary">Update</button>
                                </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
