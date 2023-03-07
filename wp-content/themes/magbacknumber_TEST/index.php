<?php require_once $_SERVER["DOCUMENT_ROOT"]. "/../common_files/connect_db.php"; ?>
<?php get_header(); ?>
<div class="main front">
    <?php
                    // echo "<pre>";
                    // print_r($_ENV);
                    // echo "</pre>";
                    // echo $DB_CMS_SERVER_NAME;
             // session_start();
             // echo "<pre>";
             // print_r($_SESSION["mag_terms"]);
             // print_r($_SESSION["mag_category"]);
             // echo "3232";
             // session_destroy();
        // echo 23;
        // die();

        
        $query = new WP_Query($_SESSION['mag_category'] );
        if ( $query->have_posts() ) :
            while ( $query->have_posts() ) : $query->the_post();
                get_template_part( "template-part/content", get_post_format() );          
                              // echo "<pre>";
                              // print_r($query);
                              // echo "</pre>";
                    // echo $GLOBALS['wp_query']->request;
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
<?php get_footer(); 
?>


<script>

// window.addEventListener( "pageshow", function ( event ) {
//   var historyTraversal = event.persisted || 
//                          ( typeof window.performance != "undefined" && 
//                               window.performance.navigation.type === 2 );
//   if ( historyTraversal ) {
//     // Handle page restore.
//     window.location.reload();
//   }
// });
</script>

