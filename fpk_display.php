<?php
/**
 * Core logic to display featured posts list at required location
 */
require_once('fpk_admin_page.php');

/**
 * Initialize Featured_Posts_List view
 */
function featured_posts_list_init()
{
    /**
     * Disabled in admin view
     */
	if (is_admin()) {
		return;
	}
}

/**
 * Call featured list for list insert
 */
function insert_fpk_featured_list ()
{
	$output = fpk_featured_list(true);
    echo $output;
}

/**
 * Call featured list for menu insert
 */
function insert_fpk_featured_menu()
{
    $output = fpk_featured_list(false);
    echo $output;
}

/**
 * Generate the output for the featured list
 * @return string 
 */
function fpk_featured_list($full = true)
{
    /**
     * Get Featured list from options table
     */
    $featured = featured_posts_list_get_options_stored();
    
    /**
     * Display the featured list
     */    
    if ($featured)
    {
        $output = ($full) ? '<ul class="featured-posts-list">' : '';
        foreach ($featured AS $postId)
        {
            $output .= '<li>';
            $output .= '<a href="' . get_permalink($postId) . '">' . get_the_title($postId) . '</a>';
            $output .= '</li>';
        }
        $output .= ($full) ? '</ul>' : '';
    }
    return $output;
}