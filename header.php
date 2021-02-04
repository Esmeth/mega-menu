<div class="navigation-part">
	<?php
	// Main Menu
	$args = array(
		'theme_location'  => 'main-menu',
		'container_class' => 'd-flex menu-navigation-regular',
		'menu_class'      => 'menu site-header-menu d-flex align-items-stretch sm sm-simple',
		'fallback_cb'     => 'top_navigation_fallback',
		'walker'          => new GradaStudio_MainMenu_Nav_Walker()
	);

	if (has_nav_menu('main-menu')) {
		wp_nav_menu($args);
	}
	?>
</div>