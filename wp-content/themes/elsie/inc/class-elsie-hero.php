<?php
/**
 * Class to handle single post/page content
 *
 * @package Elsie
 */


if ( !class_exists( 'Elsie_Hero' ) ) :

	/**
	 * Elsie_Hero 
	 */
	Class Elsie_Hero {

		/**
		 * Instance
		 */		
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {		
			add_action( 'elsie_after_header', array( $this, 'template' ) );
		}

		/**
		 * Hero
		 */
		public function template() {

			$hero_type 			= get_theme_mod( 'elsie_hero_type', 'header_image' );
			$container			= get_theme_mod( 'header_hero_width', 'nocontainer' );
			$hero_front_page	= get_theme_mod( 'hero_front_page', 1 );
			$hero_blog_page		= get_theme_mod( 'hero_blog_page', 0 );

			if ( ( $hero_blog_page && is_home() ) || ( $hero_front_page && is_front_page() ) ) :

			if ( is_paged() ) {
				return;
			}

			?>

			<div class="hero-wrapper">
				<div class="<?php echo esc_attr( $container ); ?>">
					<?php
					if ( 'post_grid' === $hero_type ) {
						$this->post_grid();
					} elseif ( 'header_image' === $hero_type ) {
						$this->header_image();
					} else {
						return;
					}
					?>
				</div>
			</div>
			<?php endif;
		}

		/**
		 * Header image
		 */
		public function header_image() {	
			$hero_before_title 	= get_theme_mod( 'hero_before_title', esc_html__( 'Hello, I\'m Elsie', 'elsie') );
			$hero_title 		= get_theme_mod( 'hero_title', esc_html__( 'Welcome to my website', 'elsie') );
			$button_url			= get_theme_mod( 'hero_button_url', '#' );
			$button_text 		= get_theme_mod( 'hero_button_text', esc_html__( 'Learn more', 'elsie' ) );
			$newtab 			= '';
			$button_newtab 		= get_theme_mod( 'hero_button_newtab', 0 );
			if ( $button_newtab ) {
				$newtab = 'target="_blank"';
			}

			$hero_enable_overlay = get_theme_mod( 'hero_enable_overlay' , 1 );

			if ( $hero_enable_overlay ) {
				$overlay_class = 'header-overlay';
			} else {
				$overlay_class = 'header-overlay overlay-hidden';
			}

			echo '<div class="header-image">';
			the_header_image_tag();
			echo 	'<div class="' . esc_attr( $overlay_class ) . '">';
			echo 		'<div class="hero-text-wrapper">';
			echo 			'<div class="hero-before-title elsie-animated elsie-fadeInDown">' . esc_html( $hero_before_title ) . '</div>';
			echo 			'<h2 class="hero-title elsie-animated elsie-fadeInDown">' . esc_html( $hero_title ) . '</h2>';
			if ( $button_url ) {
				echo		'<a ' . $newtab . ' class="button elsie-animated elsie-fadeInUp" href="' . esc_url( $button_url ) . '">' . esc_html( $button_text ) . '</a>';
			}
			echo 		'</div>';
			echo 	'</div>';
			echo '</div>';
		}

		/**
		 * Grid post markup
		 */
		public function grid_post_markup( $hero_show_cats, $hero_show_author, $hero_show_date, $image_size ) {

			global $post;
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ), $image_size );

			if ( has_post_thumbnail() ) : ?>	
				<?php $element_style = "background-image:url(" . esc_url( $image[0] ) . ")"; ?>
			<?php else : ?>
				<?php $element_style = "background-color: #333;"; //set a bg color for the slide item if there is no image ?>
			<?php endif; ?>
			
			<div class="hero-element" style="<?php echo esc_attr( $element_style ); ?>">
				<div class="element-content">
					<div class="content-inner">
						<?php if ( $hero_show_cats ) : ?>
						<div class="post-cats"><?php elsie_entry_categories(); ?></div>
						<?php endif; ?>
						<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
						<span class="entry-meta">
							<?php elsie_post_date_author( $hero_show_author, $hero_show_date ); ?>
						</span>
					</div>
				</div>
			</div>	
			<?php
		}

		/**
		 * Post grid
		 */
		public function post_grid() {

			//Settings
			$ids 				= get_theme_mod( 'post_grid_ids' );
			$page_ids 			= get_theme_mod( 'pages_grid_ids' );

			$layout				= get_theme_mod( 'post_grid_layout', 'default' );
			$post_type			= get_theme_mod( 'post_grid_source', 'post' );

			//Elements
			$hero_show_cats		= get_theme_mod( 'hero_show_cats', 1 );
			$hero_show_author	= get_theme_mod( 'hero_show_author', 1);
			$hero_show_date		= get_theme_mod( 'hero_show_date', 1 );

			if ( 'default' === $layout ) {
				$posts_per_page = 3;
			} elseif ( 'grid5' === $layout ) {
				$posts_per_page = 5;
			} else {
				$posts_per_page = 4;
			}

			//Query
			$args = array(
				'post_type' 		=> $post_type,
				'post_status' 		=> 'publish',
				'ignore_sticky_posts' => 1,
				'posts_per_page' 	=> $posts_per_page
			);

			//Merge post/page ids into args
			if ( 'post' === $post_type ) {
				if ( is_array( $ids ) && array_filter( $ids ) ) {
					$postids 	= array( 'post__in' => $ids );
					$args 		= array_merge( $args, $postids );
				}
			} elseif ( 'page' === $post_type ) {
				if ( is_array( $page_ids ) && array_filter( $page_ids ) ) {
					$postids 	= array( 'post__in' => $page_ids );
					$args 		= array_merge( $args, $postids );
				}				
			} 

			$query = new WP_Query( $args );

			if ( $query->have_posts() ) { ?>
				<div class="hero-layout-<?php echo esc_attr( $layout ); ?>">
						<div class="hero-inner">
						<?php
							$counter = 0;
							while ( $query->have_posts() ) : $query->the_post(); ?>	

								<?php if ( 'mixed' !== $layout ) : ?>
									<?php if ( 0 === $counter ) : ?>
										<?php $this->grid_post_markup( $hero_show_cats, $hero_show_author, $hero_show_date, 'large' ); ?>
									<?php else : ?>
										<?php $this->grid_post_markup( $hero_show_cats, $hero_show_author, $hero_show_date, 'elsie-900x9999' ); ?>
									<?php endif; ?>
								<?php else : ?>
									<?php if ( 0 === $counter ) : ?>
										<?php $this->grid_post_markup( $hero_show_cats, $hero_show_author, $hero_show_date, 'large' ); ?>
									<?php else : ?>
									<div class="hero-element-list">
										<div class="post-thumbnail">
											<?php the_post_thumbnail(); ?>
										</div>
										<div class="element-content">
											<div class="content-inner">
												<?php if ( $hero_show_cats ) : ?>
												<div class="post-cats"><?php elsie_post_cats(); ?></div>
												<?php endif; ?>
												<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
												<span class="entry-meta">
													<?php elsie_post_date_author( $hero_show_author, $hero_show_date ); ?>
												</span>
											</div>
										</div>
									</div>											
									<?php endif; ?>
								<?php endif; //end layout check ?>
								<?php $counter++; ?>			
							<?php endwhile; ?>	
						</div>
				</div>
			<?php
			}
			wp_reset_postdata();
		}
	}

	/**
	 * Initialize class
	 */
	Elsie_Hero::get_instance();

endif;