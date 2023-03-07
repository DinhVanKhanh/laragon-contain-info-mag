<?php get_header(); ?>
<div class="content" style="display: flex; flex-direction: column;">
    <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post(); ?>
                <div class="archive">
                    <?php get_template_part( "template-part/content", get_post_format() ); ?>
                </div><?php
            endwhile;
            // posts_nav_link( " | ", __( '以前の記事を見る', __TEXT_DOMAIN__ ), __( '次の記事を見る', __TEXT_DOMAIN__ ) );
            // wp_reset_postdata();
        else:
            get_template_part( "template-part/content", "none" );
        endif;
    ?>
</div>

<div class="sidebar">
    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
