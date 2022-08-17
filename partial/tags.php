<div class="pb-3">
    <div class="bg-light mb-4">
        <h3 class="m-0 bg-transparent">Tags</h3>
    </div>
    <div class="d-flex flex-wrap m-n1">
        <?php
        $mysqli = new DBSelect;
        //make select statement with OOP php
        $tag_sql = $mysqli->select(["postTag"])->from("posts GROUP BY postTag")->limit(10)->get();

        //call tags() function. located /coderbees/function/make_tag.php file
        //tags() function makes tags. and render to webpages.
        tags($tag_sql);

        // if ($tag_sql->num_rows > 0) {

        //     while ($result = $tag_sql->fetch_assoc()) {
        //         if (str_word_count($result['postTag']) > 1) {
        //             $tag = '';
        //             $tag = explode(",", $result['postTag']);
        //             foreach ($tag as $tags) {
        //                 echo "<a href='#' class='btn btn-outline-secondary btn-sm m-1'>{$tags}</a>";
        //             }
        //         } else {

        //             echo "<a  class='btn btn-outline-secondary btn-sm m-1'>{$result['postTag']}</a>";
        //         }
        //     }
        // }
        ?>
    </div>

</div>