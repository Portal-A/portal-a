<?php
/*
TEMPLATE NAME: Blog
*/
?>

<?php get_header(); ?>

<?php											
$args = array(
	'posts_per_page' => 5,
	'post_type' => 'post',
	'orderby' => 'date',
	'order' => 'DESC',
	'post_status' => 'publish',
	'paged' => $paged
);

query_posts($args);

include('posts.php');

?>

<?php get_footer(); ?>
