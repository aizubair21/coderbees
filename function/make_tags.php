<?php

//mae tags for widgets
function tags($tag_sql)
{
    if ($tag_sql->num_rows > 0) {

        while ($result = $tag_sql->fetch_assoc()) {
            if (str_word_count($result['postTag']) > 1) {
                $tag = '';
                $tag = explode(",", $result['postTag']);
                foreach ($tag as $tags) {
                    if (!empty($tags)) :
?><a href="tag.php?tags=<?php echo trim($tags) ?>" class='btn btn-outline-secondary btn-sm m-1'> <?php echo trim($tags) ?> </a>
                    <?php
                    endif;
                }
            } else {
                //if every post have a tag
                if (!empty($result['postTag'])) :
                    ?>
                    <a href="tag.php?tags=<?php echo trim($result['postTag']) ?>" class='btn btn-outline-secondary btn-sm m-1'> <?php echo trim($result['postTag']) ?></a>

            <?php

                endif;
            }
        }
    } else {
        echo "<strong class='text text-warning'> No Tags Found in post!</strong>";
    }
}


//make tags for post
function make_tag_for_posts($string_tags)
{

    if (str_word_count($string_tags) > 1) {
        $tag = '';
        $tag = explode(",", $string_tags);
        foreach ($tag as $tags) {

            ?>
            <a class="btn btn-outline-secondary btn-sm" href="tag.php?tags=<?php echo trim($tags) ?>"> <i class="px-1 fas fa-caret-right"></i> <?php echo trim($tags) ?> </a>
        <?php
        }
    } else {
        ?>
        <a class="btn btn-outline-secondary btn-sm" href="tag.php?tags=<?php echo trim($string_tags) ?>"> <i class="px-1 fas fa-caret-right"></i> <?php echo trim($string_tags) ?> </a>
<?php
    }
}
