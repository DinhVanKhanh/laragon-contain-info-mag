<?php get_header(); ?>
<div class="main front">
    <?php
	// echo "index";
	// echo '<pre>';
	// print_r($_SESSION);
	// echo '<pre>';
        // echo @$_SESSION["mag_child"];
        // echo '<pre>';
        // print_r($_SESSION["mag_terms"]);
        // echo '<pre>';
		
        $query = new WP_Query(@$_SESSION['mag_category'] );
        if ( $query->have_posts() ) :
            while ( $query->have_posts() ) : $query->the_post();
				// echo 123 . get_the_category( get_the_ID() )[0]->name;
				// print_r($posts);
				// print_r(get_the_category());
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

