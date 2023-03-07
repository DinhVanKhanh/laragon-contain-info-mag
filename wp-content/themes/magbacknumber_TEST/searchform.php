<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<!-- <label for="s">記事を検索</label> -->
	<input type="search" id="<?php echo $unique_id; ?>" class="search-field" value="<?php echo get_search_query(); ?>" name="s"/><br><br>
	<!-- <input type="text" name="lang" value="<?php echo get_locale()?>" /> -->
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo _x( '検索', 'submit button', __TEXT_DOMAIN__ ); ?></span></button>
</form>
