<?php
/*
The main admin page for this plugin. The logic for different user input and form submittion is written here. 
*/

function featured_posts_list_admin_menu() 
{
    // add_options_page('FPK Featured Posts', 'FPK Featured Posts', 'manage_options', 'fpk-featured-posts-list', 'featured_posts_list_admin_page');
    add_posts_page('FPK Featured Posts', 'Featured Posts', 'edit_posts', 'fpk-featured-posts-list', 'featured_posts_list_admin_page');
}

function featured_posts_list_admin_page() 
{
	$option_name = 'featured_posts_list';
    
    /**
     * Check permissions for admin page
     */
    if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}

    /**
     * If POST twitter_linkedin_kindle_share_position
     */
	if (isset($_POST['Submit']))
    {
        if (isset($_POST['featured']) && count($_POST['featured']) > 0)
        {
            $list = array();
            foreach($_POST['featured'] AS $id)
            {
                $list[] = (int)$id;
            }
            update_option($option_name, $list);
            echo '<div class="updated"><p><strong>'.__('Featured List Saved.', 'menu-test' ).'</strong></p></div>';
        }
    }

    $posts = get_posts(array('post_type' => 'post', 'numberposts' => -1));
	$featured = featured_posts_list_get_options_stored();
?>
<div class="wrap">
    <?php screen_icon(); ?>
    <h2><?php echo __( 'Featured Posts List', 'menu-test' ); ?></h2>
    
    <div id="poststuff" style="padding-top:10px; position:relative;">
        <div style="float:left; width:74%; padding-right:1%;">
            <form name="form1" method="post" action="">
                <div class="postbox">
                    <h3><?php echo __("Select Featured Posts", 'menu-test' ); ?></h3>
                    <div class="inside">
                        <table class="optiontable form-table">
                            <?php 
                                foreach($posts AS $post): 
                                    if (is_array($featured)):
                                        $selected = (in_array($post->ID, $featured)) ? 'checked="checked"' : '';
                                    else:
                                        $selected = '';
                                    endif;
                            ?>
                            <tr>
                                <td style="width:20px;"><input type="checkbox" value="<?php echo $post->ID; ?>" name="featured[]" <?php echo $selected; ?>/></td>
                                <td><strong><?php echo $post->post_title; ?></strong></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
                <p class="submit">
                    <input type="submit" name="Submit" class="button-primary" value="<?php echo esc_attr('Save Changes'); ?>" />
                </p>
            </form>
        </div>
    </div>
</div>
<?php
}

/**
 * Retrieves share options previously stored
 * @return boolean
 */
function featured_posts_list_get_options_stored () {
    
	// Get option array
	$list = get_option('featured_posts_list');
	return $list;
}
?>