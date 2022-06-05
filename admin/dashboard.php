<?php
include "connection.php";
if(!isset($_SESSION["admin_key"])){
    header("location: login.php");
}

$key = $_SESSION["admin_key"] ?? "";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
</head>
<body>


    <div class="main_body" >
        <?php include "topBar.php" ?>
       <div id="main_body">
            <div class="row">
                
                <!-- side bar -->
                <div class="col-4 p-2">
                    <?php include "sideBar.php" ?>
                </div>


                <!-- main body -->
                <div class="col-8 p-2">
                    <div class="alert alert-success">main body</div>
                </div>


                <!-- <div class="card">
                    <div class="card-body">
                        <div class="row">
                            
                            <div class="col-8">
                                
                                <form action="dashboard.php" method="POST">
                                    <div class="d-flex">
                                        <input class="form-control" type="search" name="search" id="search" placeholder="Search....">
                                        <input class="btn btn-info" name="submit" type="submit"  value="search">
                                    </div>
                                </form>
                                
                            </div>
                            
                            <div class="col-4">
                                <a style="float:right" class="btn btn-primary btn-nd" href="insert.php">Add New</a>
                                <a class="btn btn-success" href="dashboard.php">Show All</a>
                            </div>

                        </div>
                        <?php 
                            if (isset($admin_key)){ ?>
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sl :</th>
                                            <th>Caption :</th>
                                            <th>Description :</th>
                                            <th>image :</th>
                                            <th>Action :</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                                if(isset($_POST['submit'])){
                                                    $value = $_POST["search"];
                                                    $data = "SELECT * FROM crud WHERE caption like '%$value%' OR description like '%$value%'";
                                                    $result = mysqli_query($conn, $data);
                                                    while($row = mysqli_fetch_assoc($result)){ ?>
                                                        <tr>
                                                            <td><?php echo $row["id"] ?? "Not Found !"; ?></td>
                                                            <td><?php echo $row["caption"] ?? "Not Found !"; ?></td>
                                                            <td><?php echo $row["description"] ?? "Not Found !"; ?></td>
                                                            <td>
                                                                <img width="70" src="image/<?php echo $row['image'] ?? "" ?>" alt="">
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-center align-items-center">
                                                                        <a class="btn btn-primary btn-sm" href="update.php?uid=<?php echo $row["id"] ?>"><i class="fas fa-pen"></i></a>
                                                                        <form action="delete.php?id=<?php echo $row['id'] ?>" method="POST" enctype="multipart/form-data">
                                                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                                        </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                <?php }
                                                }else{
                                                    $data = "SELECT * FROM crud";
                                                    $result = mysqli_query($conn, $data);
                                                    while ($row = mysqli_fetch_assoc($result)) {?>
                                                        <tr>
                                                            <td><?php echo $row["id"] ?? "Not Found !"; ?></td>
                                                            <td><?php echo $row["caption"] ?? "Not Found !"; ?></td>
                                                            <td><?php echo $row["description"] ?? "Not Found !"; ?></td>
                                                            <td>
                                                                <img width="70" src="image/<?php echo $row['image'] ?? "" ?>" alt="">
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-center align-items-center">
                                                                        <a class="btn btn-primary btn-sm" href="update.php?uid=<?php echo $row["id"] ?>"><i class="fas fa-pen"></i></a>
                                                                        <form action="delete.php?id=<?php echo $row['id'] ?>" method="POST" enctype="multipart/form-data">
                                                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                                        </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                        <?php } }; ?>
                                    </tbody>
                                </table>
                        <?php }; ?>
                    </div>
                </div> -->
            </div>
       </div>
    </div>
</body>
</html>
