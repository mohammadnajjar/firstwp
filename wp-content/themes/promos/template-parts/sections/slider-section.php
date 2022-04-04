<?php 
/**
 * Promos Slider Function
 * @since Promos 1.0.0
 *
 * @param null
 * @return void
 *
 */
global $promos_theme_options;
$slide_id = absint($promos_theme_options['promos-select-category']);
        $slick_args = array(
            'slidesToShow'      => 1,
            'slidesToScroll'    => 1,
            'dots'              => false,
            'arrows'            => false,
        );
      $args = array(
			'posts_per_page' => 3,
			'paged' => 1,
			'cat' => $slide_id,
			'post_type' => 'post'
		);
		$slider_query = new WP_Query($args);
		if ($slider_query->have_posts()): ?>
    <div class="container">
       <div class="modern-slider" data-slick='<?php echo isset( $slick_args_encoded ) ? $slick_args_encoded : ''; ?>'>
				<?php while ($slider_query->have_posts()) : $slider_query->the_post(); 
          if(has_post_thumbnail()){
          $image_id = get_post_thumbnail_id();
          $image_url = wp_get_attachment_image_src( $image_id,'',true );
        ?>
				
          <div class="slide-post td-md-table">
            <div class="slide-info td-table-cell">
              <div class="inner-wrapper">
                <div class="entry-meta">
                  <ul>
                    <li>
                        <?php
                          $categories = get_the_category();
                          if ( ! empty( $categories ) ) {
                          echo '<a class="s-cat" href="'.esc_url( get_category_link( $categories[0]->term_id ) ).'">'.esc_html( $categories[0]->name ).'</a>';
                        }                                 
                        ?>
                    </li>
                  </ul>
                </div>
        		    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="entry-meta">
                  <ul>
                    <li><?php promos_posted_on(); ?></li>
                    <li><?php promos_read_time(); ?></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="slide-image td-table-cell">
              <?php the_post_thumbnail('full'); ?>
            </div>
          </div>
          <?php } endwhile;
          wp_reset_postdata(); ?>
      </div>
  </div>
<?php endif; ?>