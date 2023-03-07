<?php
// global $post;
// $cat_id = get_the_category($post->ID)[0]->name;
// // echo $_SESSION['mag_category']['category_name'];
// // echo $cat_id;
// if(empty(strripos(@$_SESSION['mag_category']['category_name'], $cat_id)))
//     echo "<script>location.href='" . "http://info:6062/mag/" . "'</script>";
//     // echo "<script>location.href='" . "http://192.168.3.211:8011/mag/" . "'</script>";
echo "single";
echo '<pre>';
print_r($_SESSION);
echo '<pre>';
?>
<?php get_header(); ?>

<div class="main front">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            get_template_part("template-part/content", get_post_format());
        endwhile;
        wp_reset_postdata();
    else :
        get_template_part("template-part/content", "none");
    endif;
    ?>
</div>
<div class="sidebar">
    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>