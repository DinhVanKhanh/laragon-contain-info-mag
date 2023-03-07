<?php get_header(); ?>

<div class="main front">
    <div class="search-info">
        <div class="ab"></div>
        <?php
            // $author = get_query_var('author');
            // $categories = $wpdb->get_results( "SELECT REGEXP_REPLACE(post_content, '<[^>]*>', ' ') AS content FROM post_content HAVING content LIKE '%セミナー%' ");
            
            // 'meta_query' => array(
            //     array(
            //       'key' => 'post_content',
            //       'value' => array( 1,200 ),
            //       'compare' => 'NOT LIKE'
            //     )
            //  ), 


            $flag = false;
            $search_keyword = esc_html( $s );
            $page = !empty( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 0;
            $query = "s=$search_keyword&paged=$page&orderby=date&order=DESC";
            if ( !empty( $_SESSION["mag_user"] ) || !empty( $_SESSION["mag_serial"] ) ) {
                $query .= "&category_name=" . $_SESSION["mag_category"]["category_name"];
            }
            $search_query = new WP_Query( $query );
            $search_count = $search_query->post_count;

            printf( __( '検索 『%2$s』', __TEXT_DOMAIN__ ), $search_count, $search_keyword );

        ?>
    </div>
    <?php
        if ( $search_query->have_posts() ) :
            while ( $search_query->have_posts() ) : $search_query->the_post();  ?>
                <section id="search-post-<?php the_ID(); ?>" class="search-post">
                    <?php 
                        $string = nv_get_plaintext($post->post_content);
                        $pos = mb_strpos($string, $search_keyword);
                        if ($pos){
                            $flag = true;
                            get_template_part( "template-part/content", get_post_format() );
                        }
                    ?>
                </section><?php
            endwhile;
            if ( get_query_var( 'paged' ) < $search_query->max_num_pages && 1 < $search_query->max_num_pages && $pos) {
                    posts_nav_link( " | ", __( '以前の記事を見る', __TEXT_DOMAIN__ ), __( '次の記事を見る', __TEXT_DOMAIN__ ) );
                }
            if ( get_query_var( 'paged' ) >= $search_query->max_num_pages && $pos) {
                    previous_posts_link( __( '以前の記事を見る', __TEXT_DOMAIN__ ) );
                }
            wp_reset_postdata();
        endif;
        if (isset($pos) && !$pos && !$flag):
            get_template_part( "template-part/content", "none" );
        endif;
    ?>
</div>

<div class="sidebar">
    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>

