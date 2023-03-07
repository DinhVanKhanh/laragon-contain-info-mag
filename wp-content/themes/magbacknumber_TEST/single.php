<?php get_header(); ?>

<div class="main front">
    <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                get_template_part( "template-part/content", get_post_format() );
            endwhile;
            wp_reset_postdata();
        else:
            get_template_part( "template-part/content", "none" );
        endif;
    ?>
</div>
<div class="sidebar">
    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
