<?php
include "../configuration/controller.php";

class postController extends controller
{
    protected $title, $post, $postId, $publisher, $category, $created_at, $updated_at, $kdy, $meta, $image, $tag;
    public $titleErr, $postErr, $postIdErr, $publisherErr, $categoryErr, $tagErr, $keyErr, $metaErr, $imgErr;
}
