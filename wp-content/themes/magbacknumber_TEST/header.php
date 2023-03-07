<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div id="wrapper">
        <header class="site-header">
            <div class="header">
                <div class="logo">
                    <h3 class="site-title" ><a href="<?php bloginfo( "url" ); ?>" title="<?php bloginfo( "description" ); ?>"><?php bloginfo( "sitename" ); ?></a></h3>
                    <h1 class="site-title-mobile"><a href="<?php bloginfo( "url" ); ?>" title="<?php bloginfo( "description" ); ?>"><?php bloginfo( "sitename" ); ?></a></h1>
                </div>
                <?php magazine_menu( "primary-menu" ); ?>
                <div class="logo1">
                    <div class="site-title-1">メールマガジン バックナンバー</div>
                    <div class="site-title-2"><a href="javascript:">→ バックナンバーを見る</a></div>
                </div>
            </div>
        </header>
        <main class="site-main">
            <div class="content">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(".site-title-2").click(function() {
        $('html,body').animate({
            scrollTop: $(".sidebar").offset().top},
            'slow');
    });

    // $(".widget-post-paginate a").click(function() {
    //     alert('234');
    //     // $('html,body').animate({
    //     //     scrollTop: $(".sidebar").offset().top},
    //     //     'slow');
    // });
</script>