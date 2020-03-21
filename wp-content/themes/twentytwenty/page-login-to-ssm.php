<?php get_header('login');?>
	<div class="main">
		<div class="content">
			<div class="container mb100 text-justify text-expo">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php if ( has_post_thumbnail() ) { echo '<div class="pb20">'.the_post_thumbnail().'</div>'; } ?>
					<?php echo wp_login_form(
						['echo' => false,
						 'redirect'=> site_url('home')]
					); ?>
				<?php endwhile; else : ?>
					Nothing posted yet
				<?php endif; ?>
			</div>
		</div>
	</div>
	
<?php get_footer(); ?>