<?php 

    include "nav.php";
    require "connection.php";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page </title>
    <style>
        .card-text {
            line-height: 18px;
        }
        .card {
            position: relative;
            overflow: hidden;

            
        }
        #wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(10,10,10,0.8);
            opacity: 0;
            transform: scale(1.5);
            transition: all linear .3s;
        }
        .card:hover #wrapper {
            opacity: 1;
            transform: scale(1);
            transition: all linear .3s;
        }
        .down_btn {
            padding:5px 10px;
            font-size:25px;
            cursor:pointer;
        }
        .down_btn:hover {
            color:green; 
        }

    </style>
</head>
<body>

    <div class="container">
        <div class="mt-10 alert alert-info">
            Submitted Data
        </div>
        <div class="row">
            <?php 
                $data = "SELECT * FROM crud";
                $result = mysqli_query($conn, $data);
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>

                        <div class="col-3 mb-3">
                            <div class="card">
                                <div id="wrapper" class="d-flex justify-content-center align-items-center " >
                                    <div style="color:white; padding:15px;text-align:center">
                                        <strong>Today</strong><hr>
                                        <a href="download.php?img=<?php echo $row['image'] ?>" name="down" class="down_btn"><i class="fas fa-download"></i></a>
                                    </div>
                                </div>
                                <img style="width: 100%; height:220px"  src="image/<?php echo $row['image']?>" alt="not fount">
                                <div class="card-body bg-info">
                                    <strong class="card-title"><?php echo $row['caption']?></strong>
                                    <p class="card-text"><?php echo $row['description']?></p>
                                </div>
                            </div>
                        </div>

                    <?php
                }?>

        </div>
    </div>
</body>
</html>