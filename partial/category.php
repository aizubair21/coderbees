<div class="pb-3">
    <div class="bg-light py-2 px-4 mb-3">
        <h3 class="m-0">Categories</h3>
    </div>
    <div class="bg-light py-2 text-left mb-4">
        <style>
            a {
                text-decoration: none;
                color: black;
                ;
            }

            li:hover .fas {
                color: #DC472E;
                margin-left: 17px;
                transition: all linear .3s;
            }

            li:hover a {
                color: #DC472E;
                text-decoration: none;
            }

            li .fas {
                transition: all linear .3s;
            }
        </style>
        <ul style="list-style-type:none;">
            <?php
            $cat_qry = mysqli_query($conn, "SELECT catId, catName FROM category LIMIT 7");

            while ($category = mysqli_fetch_assoc($cat_qry)) {
                echo '<li class=" m-2"><a  href="category.php?category=' . $category["catName"] . '"style="font-size:18px;"> <i class="fas fa-caret-right px-2 ;" ></i>' . $category["catName"] . '</a></li>';
            }

            ?>

        </ul>
    </div>
</div>