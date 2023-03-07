<?php
    define( "__THEME_URL__", get_template_directory() );
    define( "__CORE__", __THEME_URL__ . "/core" );
    define( "__TEXT_DOMAIN__", "magazine" );
    require_once( __CORE__ . "/init.php" );

    if ( is_wplogin() || is_user_logged_in() ) {
        goto Start;
    }

    $mag_category = strtolower( htmlspecialchars( $_POST["mag_category"] ) ) ?? "";
    $mag_child = strtolower( htmlspecialchars( $_POST["mag_child"] ) ) ?? "";
    $mag_user = htmlspecialchars( $_POST["mag_user"] ) ?? "";
    $mag_user = substr( base64_decode( $mag_user ), 2, -2 );
    $check_user = false;

    if ( !function_exists("check_query") ) {
        function check_query($mag_child, $mag_user) {
            $conn = ConnectPartner();
            $query_select = "SELECT * FROM id_${mag_child} where ${mag_child}_id = '" . $mag_user . "'";
            $result = mysqli_query($conn, $query_select);
            return (mysqli_num_rows($result) < 1) ? false : true;
        }
    }

    if ( !function_exists('createInit') ) {
        function createInit() {
            if ( session_id() == '' ) {
                session_start();
            }
        }
        add_action('init', 'createInit', 0);
    }

    if ( !function_exists("archived_session") ) {
        function archived_session($mag_child, $terms) {
            switch ($mag_child) {
                case "saag":
                    $_SESSION["mag_terms"] = implode(",",array( $terms["partner"]["SMB"], $terms["partner"]["SAAG"] ));
                    break;

                case "soup":
                    $_SESSION["mag_terms"] = implode(",",array( $terms["partner"]["SMB"], $terms["partner"]["SOSP"], $terms["partner"]["SOUP"] ));
                    break;

                case "sosp":
                    $_SESSION["mag_terms"] = implode(",",array( $terms["partner"]["SMB"], $terms["partner"]["SOSP"], $terms["partner"]["SOUP"] ));
                    break;

                case "smb":
                    $_SESSION["mag_terms"] = implode(array( $terms["partner"]["SMB"], $terms["partner"]["SAAG"], $terms["partner"]["SOSP"], $terms["partner"]["SOUP"] ));
                    break;

                case "sorizo":
                    $_SESSION["mag_terms"] = implode(",",array( $terms["partner"]["予定"] ));
                    break;

                default: // $mag_child = null -> user
                    $_SESSION["mag_terms"] = $terms["user"];
                    break;
            }

            if(strtolower( htmlspecialchars( $_POST["mag_category"] ) ) == "user")
                $_SESSION["mag_terms"] = $terms["user"];
                
            $_SESSION["mag_child"] = @$_POST['mag_child'];
            $_SESSION["mag_user"] = htmlspecialchars( $_POST["mag_user"] );
            $_SESSION["mag_category"] = array(
                'category_name'          => $_SESSION["mag_terms"],
                'order'                  => 'DESC',
                'orderby'                => 'DESC',
                'cache_results'          => false,
                'post_status'            => 'publish',
                'posts_per_page'         => 1,
                'posts_per_archive_page' => 1,
                'nopaging'               => false
            );

            $_SESSION["timeout"] = time() + 3600;
        }
    }



    if ( !empty( $_POST["mag_user"] ) ) {
        require_once __DIR__ . "/../../../../../common_files/database/db_Mysql.php";
        // require_once($_SERVER['DOCUMENT_ROOT'] . "/../common_files/connect_db.php" );

        /*
            Table mag_terms
                1: 未分類
                2: Menu 1
                3: SMB
                4: SAAG
                5: SOSP
                6: SOUP
                7: 予定
        */
        $terms = array(
            "user"=>"user",
            "partner"=>[
                "SMB"  => "smb",
                "SAAG" => "saag",
                "SOSP" => "soup_sosp",
                "SOUP" => "soup_sosp",
                "未分類"  => 1,
                "予定"   => 7,
            ]
        );

        if ($mag_category == "user") {
            if ( !check_query($mag_child,$mag_user) )
                goto Err;

            archived_session($mag_child,$terms);
        }
        elseif( $mag_category == "partner" ) {
            switch ( $mag_child ) { //unnecessary use switch
                case "saag":             
                    if ( !check_query($mag_child,$mag_user) )
                        goto Err;   
                    archived_session($mag_child,$terms);
                    break;

                case "sosp":
                    if ( !check_query($mag_child,$mag_user) )
                        goto Err;
                    archived_session($mag_child,$terms);
                    break;

                case "soup":
                    if ( !check_query($mag_child,$mag_user) )
                        goto Err; 
                    archived_session($mag_child,$terms);
                    break;

                case "sorizo":
                    // $conn = dbSorizo();
                    // if ( !$conn->hasRecord( "SELECT * FROM id_soup where soup_id = '" . $mag_user . "'" ) ) {
                    //     goto Err;
                    // }
                    archived_session($mag_child,$terms);
                    break;

                case "smb":
                    archived_session($mag_child,$terms);
                    break;

                default:
                    goto Err;
            }
        }
        // print_r($_SESSION);

        $check_user = true;
        goto Start;
    }

    else {
        if ( !empty( $_SESSION["mag_user"] ) ) {
            if ( time() - $_SESSION["timeout"] >= 0 ) {
                session_destroy();
                goto Err;
            }
            $check_user = true;
            goto Start;
        }
        else {
            goto Err;
        }
    }

    Err:
    if ( !$check_user ) {
        die( "メールマガジンバックナンバーは、会員ページでのログインが必要です" );
    }

    Start:
    // Thiet lap chieu rong de noi dung khong bi tran`
    if ( !isset( $content_width ) ) {
        $content_width = 620;
    }

	/*--------------------------------------
            start session
    ----------------------------------------*/
	// function register_session(){
	//     if( !session_id() )
	//         session_start();
	// }
	// add_action('init','register_session');

    if ( !function_exists( "magazine_setup" ) ) {
        function magazine_setup() {
            $folder_language = __THEME_URL__ . "/languages";
            load_theme_textdomain( __TEXT_DOMAIN__, $folder_language );

            // Tu dong chen the title
            add_theme_support( "title-tag" );

            // Tu dong chen RSS vao the head
            add_theme_support( "automatic-feed-links" );

            // Background
            add_theme_support( "custom-background", array(
                "default-color" => "#321123"
            ) );

            // Anh dai dien
            add_theme_support( "post-thumbnails" );

            // Post format
            add_theme_support( "post-formats", array(
                "aside",
                "video",
                "link",
                "image"
            ) );

            // Menu location
            register_nav_menu( "primary-menu", __( "Primary menu", __TEXT_DOMAIN__ ) );

            // Sidebar
            register_sidebar( array(
                "id" => "primary-sidebar",
                "name" => __( "Primary sidebar", __TEXT_DOMAIN__ ),
                "class" => "primary-sidebar",
                "before_title" => "<h3 class='widget-title'>",
                "after_title" => "</h3>"
            ) );
        }
        add_action( "init", "magazine_setup" );
    }

    /*--------------------------------------
            Template functions
    ----------------------------------------*/

    /*-----------------------
         Menu location
    -----------------------*/
    if ( !function_exists( "magazine_menu" ) ) {
        function magazine_menu( $menu ) {
            $menu = array(
                "theme_location" => $menu,
                "container" => "nav",
                "container_class" => $menu
            );
            wp_nav_menu( $menu );
        }
    }

    /*-----------------------
         Post thumbnail
    -----------------------*/
    if ( !function_exists( "magazine_entry_thumbnail" ) ) {
        function magazine_entry_thumbnail( $size ) {
            if ( !is_single() && has_post_thumbnail() && !post_password_required() || has_post_format() ) :
                printf( '<a href="%1$s" title="%2$s">%3$s</a>',
                    get_the_permalink(),
                    get_the_title(),
                    get_the_post_thumbnail()
                );
            endif;
        }
    }

    /*------------------------------
        Limit search post tittle
    ------------------------------*/
    function hocwp_theme_custom_limit_search_title_only($search, $wp_query) {
        global $wpdb;
        if(empty($search)) {
            return $search;
        }
        $q = $wp_query->query_vars;
        $n = !empty($q['exact']) ? '' : '%';
        $search = '';
        $searchand = '';
        $terms = (array)$q['search_terms'];
        foreach($terms as $term) {
            $term = esc_sql($wpdb->esc_like($term));
            $search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
            $searchand = ' AND ';
        }
        if(!empty($search)) {
            $search = " AND ({$search}) ";
            if(!is_user_logged_in()) {
                $search .= " AND ($wpdb->posts.post_password = '') ";
            }
        }
        return $search;
    }
    add_filter('posts_search', 'hocwp_theme_custom_limit_search_title_only', 500, 2);


    /*-----------------------
         Post header
    -----------------------*/
    if ( !function_exists( "magazine_entry_header" ) ) {
        function magazine_entry_header() {
            if ( is_search() ) {
                printf( '<h3 class="entry-title search"><a href="%1$s" title="%2$s">%3$s</a></h3><hr>',
                    get_the_permalink(),
                    get_the_title(),
                    get_the_title()
                );
            }
            else {
                printf( '<h1 class="entry-title"><a href="%1$s" title="%2$s">%3$s</a></h1><hr>',
                    get_the_permalink(),
                    get_the_title(),
                    get_the_title()
                );
            }
        }
    }

    /*-----------------------
        Noi dung Post
    -----------------------*/
    if ( !function_exists( "magazine_entry_content" ) ) {
        function magazine_entry_content() {
            if ( is_search() || is_archive()) {
                // the_excerpt(); //display content excerpt when search
                // echo get_query_var('paged');
                // set('paged', ( get_query_var('paged') ) ? get_query_var('paged') : 1 );
                // set('posts_per_page',2);
            }
            else {
                the_content();
            }
            
            $link_pages = array(
                "nextpagelink" => __( "Next Posts", __TEXT_DOMAIN__ ),
                "previouspagelink" => __( "Previous Posts", __TEXT_DOMAIN__ ),
            );
            wp_link_pages( $link_pages );
        }
    }

    /*-----------------------
            Read more  
    -----------------------*/
    if ( !function_exists( "magazine_entry_readmore" ) ) {
        function magazine_entry_readmore() {
            return __( "<a href='" . get_the_permalink() . "'>[ 続きを読む ]</a>", __TEXT_DOMAIN__ );
        }
        add_filter( "excerpt_more", "magazine_entry_readmore" );
    }

    /*-----------------------
         Style
    -----------------------*/
    if ( !function_exists( "magazine_style" ) ) {
        function magazine_style() {
            wp_register_style( "main", get_template_directory_uri() . "/style.css" );
            wp_enqueue_style( "main" );
        }
        add_action( "wp_enqueue_scripts", "magazine_style" );
    }

    // if (!function_exists("lastest_post")) {
    //     function lastest_post($query)
    //     {
    //         if($query->is_home() && $query->is_main_query()){
    //             $query->set('orderby','rand');
    //         }
    //     }
    //     add_action( "recent_post", "lastest_post" );

    // }

    /*----------------------
        Widget recent post
    -----------------------*/
    class MagazineWidget extends WP_Widget {
        function __construct() {
            parent::__construct(
                "recent_post_magazine",
                "Magazine Recent Posts Widget",
                array(
                    'description' => "Show recent posts by category"
                )
            );
        }

        function form( $instance ) {
            parent::form( $instance );
            $default = array( 
                "title" => "",
                "post_number" => 5
            );

            $instance = wp_parse_args( (array)$instance, $default );
            $title = esc_attr( $instance["title"] );
            $post_number = esc_attr( $instance["post_number"] );
            echo 'Title<input class="widefat" type="text" name="' . $this->get_field_name('title') . '" value="' . $title . '"/>';
            echo 'Post number<input class="widefat" type="text" name="' . $this->get_field_name('post_number') . '" value="' . $post_number . '"/>';
        }

        function update( $new_instance, $old_instance ) {
            parent::update( $new_instance, $old_instance );
            $instance = $old_instance;
            $instance["title"] = strip_tags( $new_instance["title"] );
            $instance["post_number"] = strip_tags( $new_instance["post_number"] );
            return $instance;
        }

        function widget( $args, $instance ) {
            extract($args);
            $title = apply_filters( 'widget_title', $instance['title'] );
            $post_number = intval( $instance['post_number'] );
            

            echo $before_widget;
            echo $before_title . '<div style="font-weight:bold; font-size:20px">'. $title .'</div>' . $after_title;

            if ( isset( $_SESSION["mag_user"] ) ) {
                $new_args = $_SESSION["mag_category"];
                // $b = $_SESSION["mag_terms"];
                $new_args["posts_per_archive_page"] = $new_args["posts_per_page"] = $post_number;
                // $new_args['tax_query'] = [
                //    'taxonomy' => $_SESSION["post_format"],
                    
                // ];
               
                       // echo "<pre>";
                       // print_r($new_args);
                       // echo "</pre>";
                print_r($_SESSION);
            }
            else {
                $new_args  = array(
                    // "posts_per_page" => $post_number,
                    // 'posts_per_archive_page' => $post_number,
                    'cache_results' => false,
                    "order" => "desc",
                    "orderby" => "date"
                );
            }
            $latest_page = isset( $_GET['latest_page'] ) ? intval( $_GET['latest_page'] ) : 1;
            $new_args["paged"] = $latest_page;
            echo $latest_page;
            $random_query = new WP_Query( $new_args );
             // echo "<pre>";
             //   print_r($new_args);
             //   echo "</pre>";
            if ($random_query->have_posts()):
                echo "<ol>";
                while( $random_query->have_posts() ) :
                    $random_query->the_post(); ?>
                    <?php $redirect_page = get_the_permalink() . "?latest_page=" . $latest_page; ?>
                        
                        <li style="list-style:inside">
                            <a href='<?= $redirect_page ?>' title="<?php the_title(); ?>"><?php the_title(); ?></a>
                        </li>
                    <?php 
                endwhile;
                echo "</ol>";
                $uri = explode( '/?', $_SERVER['REQUEST_URI'] );

                echo '<div class="widget-post-paginate" style="text-align:right">';
                if ( $latest_page > 1 ) {
                    printf( __( '<a class="previous" href="javascript:sub(this);">以前の記事を見る</a></br>', __TEXT_DOMAIN__ ),
                        $uri[0] . '?latest_page=' . ( $latest_page > 1 ? $latest_page - 1 : $latest_page ) 
                    );
                }

                if ( $latest_page < $random_query->max_num_pages ) {
                    printf( __( '<a class="next" href="javascript:sub(this);">次の記事を見る</a>', __TEXT_DOMAIN__ ),
                        $uri[0] . '?latest_page=' . ( $latest_page + 1 )
                    );
                }

                // if(isset($_SESSION['final_page']) && $_SESSION['final_page'] != $latest_page){
                //    $redirect = $_SESSION["final_page"];
                //    echo '<script> location.replace("?latest_page='. $redirect . '"); </script>';
                //    $latest_page = $_SESSION['final_page'];
                //    unset($_SESSION['final_page']); 
                // }                
                echo '</div>';

                wp_reset_postdata();
            endif;
            echo $after_widget;
        }
    }
    add_action( "widgets_init", "recent_post_widget" );

    // add_action('init','thongbao_init');
    add_action( 'wp_ajax_thongbao', 'thongbao_init' );
    add_action( 'wp_ajax_nopriv_thongbao', 'thongbao_init' );
    function thongbao_init() {
            ob_start(); //bắt đầu bộ nhớ đệm
            print_r($_SESSION);

            $result = ob_get_clean(); //cho hết bộ nhớ đệm vào biến $result

            wp_send_json_success($result); // trả về giá trị dạng json

            die();//bắt buộc phải có khi kết thúc
        }

    

    function recent_post_widget() {
        register_widget( "MagazineWidget" );
    }

    //edit title in sidebar ex: search -> <h2>seach<h2>
    function my_edit_widget_func($params) {
        $params[0]['before_title'] = '<h3 class="widget-title"' . 'style="font-weight:bold; font-size:20px"' . '">' ;
        return $params;
    }
    add_filter('dynamic_sidebar_params', 'my_edit_widget_func');


    // function search_filter($query) {
    //     if ( !is_admin() && $query->is_main_query() ) {
    //         if ($query->is_search()) {
    //           $query->set('paged', ( get_query_var('paged') ) ? get_query_var('paged') : 1 );
    //           $query->set('posts_per_page',3);
    //         }
    //       }
    //     }
    // add_action( 'pre_get_posts', 'search_filter' );

    function SearchFilter($query) {
    if ($query->is_search()) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts','SearchFilter');
?>
