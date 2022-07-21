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
?>
                        <a href="tag.php?tags=<?php echo $tags ?>" class='btn btn-outline-secondary btn-sm m-1'> <?php echo $tags ?> </a>

                    <?php
                    endif;
                }
            } else {
                if (!empty($result['postTaag'])) :

                    ?>

                    <a href="tag.php?tags=<?php echo $result['postTag'] ?>" class='btn btn-outline-secondary btn-sm m-1'> <?php echo $result['postTag'] ?></a>

            <?php
                endif;
            }
        }
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
            <a class="btn btn-outline-secondary btn-sm" href="tag.php?tags=<?php echo $tags ?>"> <i class="px-1 fas fa-caret-right"></i> <?php echo $tags ?> </a>
        <?php
        }
    } else {
        ?>
        <a class="btn btn-outline-secondary btn-sm" href="tag.php?tags=<?php echo $string_tags ?>"> <i class="px-1 fas fa-caret-right"></i> <?php echo $string_tags ?> </a>
<?php
    }
}
