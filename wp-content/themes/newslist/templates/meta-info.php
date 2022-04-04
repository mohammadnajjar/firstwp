<?php

/**
 * Displays the meta information
 *
 * @since 1.0.0
 *
 * @package Guternbiz WordPress Theme
 */ ?>

<?php if ( 'post' === get_post_type() ) : ?>
	<?php $author   = newslist_get( 'post-author' );
	$date     = newslist_get( 'post-date' );
	if ( $author || $date ) : ?>
		<div class="entry-meta 
			<?php
			if (is_single()) {
				echo esc_attr('single');
			}
			?>">
			<?php Newslist_Helper::get_author_image(); ?>
			<?php if ( $author || $date ) : ?>
				<div class="author-info">
					<?php
					Newslist_Helper::the_date();
					Newslist_Helper::posted_by();
					?>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
<?php endif; ?>