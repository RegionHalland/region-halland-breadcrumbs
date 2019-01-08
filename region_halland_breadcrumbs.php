<?php

	/**
	 * @package Region Halland Breadcrumbs
	 */
	/*
	Plugin Name: Region Halland Breadcrumbs
	Description: Front-end-plugin för breadcrumb
	Version: 1.0.0
	Author: Roland Hydén
	License: MIT
	Text Domain: region_halland_breadcrumbs
	*/

	// Returnera en array med breadcrumbs-info
	function get_region_halland_breadcrumbs()
	{
		
		// Wordpress funktion för aktuell post
		global $post;

		// Om detta inte är en post, returnera en tom variabel
		if (!is_a($post, 'WP_Post') || is_front_page()) {
			return;
		}
		
		// Titel för aktuell sida
		$title = get_the_title();
		
		// Hämta post_type objektet
		$post_type = get_post_type_object($post->post_type);
		
		// Lägg till första posten i arrayen med breadcrumbs
		$breadcrumbs = addBreadcrumb(array(), get_bloginfo('name'), get_home_url());

		// Om det är en arkiverad post
		if (is_single() && $post_type->has_archive) {
			$cpt_archive_link = (is_string($post_type->has_archive)) ? 
				get_permalink(get_page_by_path($post_type->has_archive)) : 
				get_post_type_archive_link($post_type->name);
			$breadcrumbs = addBreadcrumb($breadcrumbs, $post_type->label, $cpt_archive_link);
		}

		// Om man befinner sig på en enskild sida
		if (is_page() || (is_single() && $post_type->hierarchical == true)) {
			
			// Om posten har föräldrar
			if ($post->post_parent) {
				
				// Hämta alla föräldrar	
				$ancestors = array_reverse(get_post_ancestors($post->ID));
				
				// Titel för aktuell sida
				$title = get_the_title();

				// Loopa igenom alla föräldrar
				foreach ($ancestors as $ancestor) {
					
					// Om det inte är en privat post
					if (get_post_status($ancestor) != 'private') {
						
						// Lägg til i breadcrumen inklusive länk
						$breadcrumbs = addBreadcrumb($breadcrumbs, get_the_title($ancestor), get_permalink($ancestor));
					}
				}
					
				// Sist i breadcrumben exklusive länk
				$breadcrumbs = addBreadcrumb($breadcrumbs, $title, false);

			// Om posten INTE har föräldrar
			} else {
					
				// Sist i breadcrumben exklusive länk
				$breadcrumbs = addBreadcrumb($breadcrumbs, get_the_title(), false);
			
			}

		// Om det INTE är en sida
		} else {
			
			// Första-sdian	
			if (is_home()) {
				$title = single_post_title();
			
			// Taxonomi	
			} elseif (is_tax()) {
				$title = single_cat_title(null, false);
			
			// Kategori	
			} elseif (is_category()) {
				$title = single_term_title('', false);
			
			// Tag	
			} elseif (is_tag()) {
				$title =  single_tag_title('', false);
			
			// Arkiverad	
			} elseif (is_archive()) {
				$title = post_type_archive_title(null, false);
			
			// Som fallback, hämta sidans titel	
			} else {
				$title = get_the_title();
			}
			
			// Lägg til i breadcrumen inklusive länk
			$breadcrumbs = addBreadcrumb($breadcrumbs, $title, false);
		}

		// Returnera arrayen
		return $breadcrumbs;
	
	}

	// Lägg till ny breadcrumb till arrayen
	function addBreadcrumb($list, $name, $url) {
		
		// Array-element med "namn" och "url"
		$list[] = array(
			'name' => $name,
			'url' => $url
		);
		
		// Returnera array-element
		return $list;
	}

	// Metod som anropas när pluginen aktiveras
	function region_halland_breadcrumbs_activate() {
		// Ingenting just nu...
	}

	// Method when the plugin is deactivated
	function region_halland_breadcrumbs_deactivate() {
		// Ingenting just nu...
	}
	
	// Aktivera pluginen och anropa metod
	register_activation_hook( __FILE__, 'region_halland_breadcrumbs_activate');
	
	// Av-aktivera pluginen och anropa metod
	register_deactivation_hook( __FILE__, 'region_halland_breadcrumbs_deactivate');

?>	