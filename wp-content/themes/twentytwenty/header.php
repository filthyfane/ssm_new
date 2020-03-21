 <?php
/**
 * Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php
			// Print the <title> tag based on what is being viewed.
			global $page, $paged;

			wp_title( '|', true, 'right' );
			bloginfo( 'name' ); // Add the blog name.

			// Add the blog description for the home/front page.
			$site_description = get_bloginfo( 'description', 'display' );
			if ($site_description && ( is_home() || is_front_page())){
				echo " | $site_description";
			}

			// Add a page number if necessary:
			if(($paged >= 2 || $page >= 2 ) && ! is_404()){
				echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );
			}?>
		</title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php
			/*
			 * We add some JavaScript to pages with the comment form
			 * to support sites with threaded comments (when in use).
			 */
			if ( is_singular() && get_option( 'thread_comments' ) )
				wp_enqueue_script( 'comment-reply' );

			/*
			 * Always have wp_head() just before the closing </head>
			 * tag of your theme, or you will break many plugins, which
			 * generally use this hook to add elements to <head> such
			 * as styles, scripts, and meta tags.
			 */
			wp_head();
		?>
	</head>

<body <?php body_class(); ?> post-id="<?php echo get_the_ID(); ?>">
<div id="wrapper" class="hfeed">
	<div id="header">
		<div id="masthead">
			<div id="access" role="navigation">
			  <?php /* Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
				<!--<div class="skip-link screen-reader-text"><a href="#content" title="<?php //esc_attr_e( 'Skip to content', 'twentyten' ); ?>"><?php //_e( 'Skip to content', 'twentyten' ); ?></a></div>-->
				<?php /* Our navigation menu. If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used. */ ?>
				<?php //wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
				
				<!-- TOP MENU -->
				<div class="menu-header" data-kik="<?php echo site_url(); ?>">
					<ul id="menu-main-menu" class="menu">
						<li class="menu-item menu-item-type-post_type menu-item-object-page">
							<a href="<?php echo site_url(); ?>">Panou general</a>
						</li>
						<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children">
							<a href="<?php echo site_url(); ?>">Evidență firme</a>
							<ul class="sub-menu">
								<li class="menu-item menu-item-type-post_type menu-item-object-page">
									<a href="<?php echo site_url(); ?>/">Centralizator firme</a>
								</li>
								<li class="menu-item menu-item-type-post_type menu-item-object-page">
									<a href="<?php echo site_url(); ?>/evidenta-firme/firma-noua/">Firmă nouă</a>
								</li>
								<li class="menu-item menu-item-type-post_type menu-item-object-page">
									<a href="<?php echo site_url(); ?>/evidenta-firme/import-de-date/">Import de date</a>
								</li>
								<li class="menu-item menu-item-type-post_type menu-item-object-page">
									<a href="<?php echo site_url(); ?>/evidenta-firme/alerte-si-atentionari/">Alerte și atenționări</a>
								</li>
							</ul>
						</li>
						<li class="menu-item menu-item-type-post_type menu-item-object-page">
							<a href="<?php echo site_url(); ?>/rapoarte/">Rapoarte</a>
						</li><?php
							$currUser = wp_get_current_user();
							$currUserRoles = $currUser->roles;
							if (in_array('administrator', $currUserRoles)) { ?>
								<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children">
									<a href="<?php echo site_url(); ?>/administrare/administrare-utilizatori">Administrare</a>
									<ul class="sub-menu">
										<li class="menu-item menu-item-type-post_type menu-item-object-page">
											<a href="<?php echo site_url(); ?>/administrare/categorii-de-date/">Categorii de date</a>
										</li>
										<li class="menu-item menu-item-type-post_type menu-item-object-page">
											<a href="<?php echo site_url(); ?>/administrare/administrare-utilizatori/">Administrare utilizatori</a>
										</li>
										<li class="menu-item menu-item-type-post_type menu-item-object-page">
											<a href="<?php echo site_url(); ?>/administrare/rapoarte-utilizatori/">Rapoarte utilizatori</a>
										</li>
										<li class="menu-item menu-item-type-post_type menu-item-object-page">
											<a href="<?php echo site_url(); ?>/administrare/setari-companie/">Setări companie</a>
										</li>
									</ul>
								</li><?php 
							} ?>
						<li class="menu-item menu-item-type-post_type menu-item-object-page">
							<a href="<?php echo get_author_posts_url($currUser->ID); ?>">Contul meu</a>
						</li>
					</ul>
				</div>
				
			</div><!-- #access -->
			
			<div id="admin_holder">
				<div id="admin">
					<div class="kik_icons_container">
						<?php
							$kik_alerts = get_option('kik_alerts') ? CountObjectDeepestChildren(get_option('kik_alerts')['by_id']) : 0;
							$kik_notifications = get_option('kik_notifications') ? CountObjectDeepestChildren(get_option('kik_notifications')['by_id']) : 0;
							$kik_alerts_bills = get_option('kik_alerts_bills') ? CountObjectDeepestChildren(get_option('kik_alerts_bills')['by_id']) : 0;
							if ($kik_alerts) echo '<div class="kik_alerts" title="' . $kik_alerts . ' alerte">' . $kik_alerts . '</div>';
							if ($kik_notifications) echo '<div class="kik_notifications" title="' . $kik_notifications . ' atenționări">' . $kik_notifications . '</div>';
							if ($kik_alerts_bills) echo '<div class="kik_alerts_bills" title="' . $kik_alerts_bills . ' facturi neîncasate">' . $kik_alerts_bills . '</div>';
						?>
					</div>
					<?php if (is_user_logged_in()) { ?>
						<span class="salut">Bun venit</span>, <a href="<?php echo get_author_posts_url($currUser->ID); ?>"><?php echo $currUser->display_name; ?></a>! | <a href="<?php echo wp_logout_url(); ?>">Logout</a>
					<?php } else { ?>
						<span class="salut">Bun venit</span>! | <a href="<?php echo wp_login_url(get_permalink()); ?>">Login</a>
					<?php }	?>
				</div>
			</div>
			
		</div><!-- #masthead -->
	</div><!-- #header -->

	<div id="main">
