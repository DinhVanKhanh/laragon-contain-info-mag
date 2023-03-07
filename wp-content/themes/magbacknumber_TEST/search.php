<?php get_header(); ?>

<div class="main front">
    <div class="search-info">
        <div class="ab"></div>
        <?php
            global $wpdb;
        $s = esc_html( $s );
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $post_per_page = intval(get_query_var('posts_per_page'));
        $offset = ($paged - 1)*$post_per_page;
        // $wpdb->posts.post_title
        $a = "SELECT SQL_CALC_FOUND_ROWS * FROM $wpdb->posts  

        LEFT JOIN $wpdb->postmeta ON($wpdb->posts.ID = $wpdb->postmeta.post_id)
        LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
        LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
        LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)


        WHERE 1=1  
        AND $wpdb->terms.name = 'saag'
        AND $wpdb->term_taxonomy.taxonomy = 'category'
        AND ( $wpdb->term_relationships.term_taxonomy_id IN (9) ) 
        AND ((($wpdb->posts.post_content REGEXP '>[^<]*$s')))  
        AND $wpdb->posts.post_type = 'post' 
        AND ($wpdb->posts.post_status = 'publish') 
        GROUP BY $wpdb->posts.ID 
        ORDER BY $wpdb->posts.post_date DESC
        LIMIT ".$offset.", ".$post_per_page;



        // echo $post_per_page . "<br>" . $offset;

            // $author = get_query_var('author');
            $pageposts = $wpdb->get_results( $a, OBJECT); 
                    // echo "<pre>";
                    // print_r($pageposts);
                    // echo "</pre>";
            // 'meta_query' => array(
            //     array(
            //       'key' => 'post_content',
            //       'value' => array( 1,200 ),
            //       'compare' => 'NOT LIKE'
            //     )
            //  ), 

        $sql_posts_total = $wpdb->get_var( "SELECT FOUND_ROWS();" );
        $max_num_pages = ceil($sql_posts_total / $post_per_page);
        echo "<br/>" . $max_num_pages;
        echo "<br> count". count($pageposts);

        // foreach($categories as $item){
        //     echo $item->post_title.'<br/>';
        //     get_template_part( "template-part/content", get_post_format() );
        // }


        if ($pageposts): ?>
  <?php global $post; ?>
  
  <?php foreach ($pageposts as $post): ?>
  
    <?php setup_postdata($post); ?>

      <section id="search-post-<?php the_ID(); ?>" class="search-post">
         <?php get_template_part( "template-part/content", get_post_format() ); ?>
      </section>

  <?php endforeach; ?>
<?php posts_nav_link( " | ", __( '以前の記事を見る', __TEXT_DOMAIN__ ), __( '次の記事を見る', __TEXT_DOMAIN__ ) ); ?>

  
  <?php else : ?>
    <?php get_template_part( "template-part/content", "none" ); ?>
    
 <?php endif;


            // $flag = false;
            // $search_keyword = wp_specialchars( $s );
            // // echo $search_keyword;
            // $page = !empty( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 0;
            // $query = "s=$search_keyword&paged=$page&post_type=post&orderby=date&order=DESC";
            // if ( !empty( $_SESSION["$wpdb->user"])  || !empty($_SESSION["$wpdb->serial"]) ) {
            //     $query .= "&category_name=" . $_SESSION["$wpdb->category"]["category_name"];
            // }
            // $search_query = new WP_Query( $query );
            //         // echo "<pre>";
            //         // print_r($search_query->request);
            //         // echo "</pre>";
            // $search_count = $search_query->post_count;
            // // echo $search_count;
            // printf( __( '検索 『%2$s』', __TEXT_DOMAIN__ ), $search_count, $search_keyword );

        ?>
    </div>

<!--     <div class="navigation">
    <div class="previous panel"><?php previous_posts_link('以前の記事を見る',$max_num_pages) ?></div>
    <div class="next panel"><?php next_posts_link('以前の記事を見る',$max_num_pages) ?></div>
    </div> -->
    
</div>

<div class="sidebar">
    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>

