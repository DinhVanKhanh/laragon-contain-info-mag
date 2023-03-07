<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-thumbnail">
        <?php theme1_entry_thumbnail( "large" ); ?>
    </div>
    <div class="entry-header">
        <?php theme1_entry_header(); ?>
    </div>
    <div class="entry-content">
        <?php theme1_entry_content(); ?>
    </div>
</article>
