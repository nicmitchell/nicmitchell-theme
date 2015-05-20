<?php
/*
Template Name: Blog Page
*/
?>
<?php
$et_ptemplate_settings = array();
$et_ptemplate_settings = maybe_unserialize( get_post_meta( get_the_ID(), 'et_ptemplate_settings', true ) );

$fullwidth = isset( $et_ptemplate_settings['et_fullwidthpage'] ) ? (bool) $et_ptemplate_settings['et_fullwidthpage'] : false;

$et_ptemplate_blogstyle = isset( $et_ptemplate_settings['et_ptemplate_blogstyle'] ) ? (bool) $et_ptemplate_settings['et_ptemplate_blogstyle'] : false;

$et_ptemplate_showthumb = isset( $et_ptemplate_settings['et_ptemplate_showthumb'] ) ? (bool) $et_ptemplate_settings['et_ptemplate_showthumb'] : false;

$blog_cats = isset( $et_ptemplate_settings['et_ptemplate_blogcats'] ) ? (array) array_map( 'intval', $et_ptemplate_settings['et_ptemplate_blogcats'] ) : array();
$et_ptemplate_blog_perpage = isset( $et_ptemplate_settings['et_ptemplate_blog_perpage'] ) ? (int) $et_ptemplate_settings['et_ptemplate_blog_perpage'] : 10;
?>
<?php get_header(); ?>

<div id="content-area">
	<div class="container clearfix fullwidth">
		<div id="main-area">

		<?php while ( have_posts() ) : the_post(); ?>

				<?php
				the_content();

				wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'Vertex' ), 'after' => '</div>' ) );
				?>


					<?php $cat_query = '';
					if ( !empty($blog_cats) ) $cat_query = '&cat=' . implode(",", $blog_cats);
					else echo '<!-- blog category is not selected -->'; ?>
					<?php
						$et_paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );
					?>
					<?php query_posts("posts_per_page=$et_ptemplate_blog_perpage&paged=" . $et_paged . $cat_query); ?>
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article class="entry clearfix et-no-image">
						<div class="alt-description">
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<br />
							<?php et_vertex_post_meta(); ?>
						</div>

						<?php 
							$thumb = '';
							$width = (int) apply_filters( 'et_index_image_width', 640 );
							$height = (int) apply_filters( 'et_index_image_height', 280 );
							$classtext = '';
							$titletext = get_the_title();
							$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
							$thumb = $thumbnail["thumb"]; 
						?>

						<?php echo '<p>' . truncate_post( 440, false ) . '</p>'; ?>
						<a class="read-more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'Vertex' ); ?></a>
					</article> <!-- .entry -->
					<?php endwhile; ?>
						<div class="page-nav clearfix">
							<?php 
							if(function_exists('wp_pagenavi')) { 
								wp_pagenavi(); 
							} else { 
								get_template_part('includes/navigation'); 
							}?>
						</div> <!-- end .entry -->
					<?php else : ?>
						<?php get_template_part('includes/no-results'); ?>
					<?php endif; wp_reset_query(); ?>
				</div> <!-- end #et_pt_blog -->

			

		<?php endwhile; ?>

		</div> <!-- #main-area -->

		<?php if ( ! $fullwidth ) get_sidebar(); ?>
	</div> <!-- .container -->
</div> <!-- #content-area -->

<?php get_footer(); ?>