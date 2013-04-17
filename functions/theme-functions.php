<?php
/**
 * Custom theme functions
 */

/** Adds search button to primary menu */
add_filter('wp_nav_menu_items', 'aq_add_search_menu_li', 10, 2);
function aq_add_search_menu_li( $items, $args ) {
	
	if($args->theme_location == 'primary') {

		$items .= '<li class="search"><i class="icon-search"></i><i class="icon-remove"></i></li>';

	}

	return $items;

}

/** Default menu */
function aq_default_menu() {

	echo '<nav>';
		echo '<li><a href="'. admin_url('/nav-menus.php') .'">Setup your menu</a></li>';
	echo '</nav>';

}

/** Custom pagination */
function aq_pagination($pages = '', $range = 2) {

     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '') {

         global $wp_query;
         $pages = $wp_query->max_num_pages;
         
         if(!$pages) {
             $pages = 1;
         }

     }

     if(1 != $pages) {

        if($paged > 1 && $showitems < $pages) echo "<a class='btn light' href='".get_pagenum_link($paged - 1)."'><i class='icon-chevron-left'></i></a>";

        for ($i = 1; $i <= $pages; $i++) {

            if ( 
                !($i >= $paged+$range+1 || 
                $i <= $paged-$range-1)
            ) {

                echo ($paged == $i) ? "<span class='btn'>".$i."</span>":"<a class='btn light' href='".get_pagenum_link($i)."'>".$i."</a>";

            } elseif ( 
                ($paged <= $range) && 
                ($i > ($range + 1)) && 
                ($i <= ($showitems)) 
            ) {

                echo "<a class='btn light' href='".get_pagenum_link($i)."'>".$i."</a>";

            } elseif ( 
                ($paged >= ($pages - $range + 1)) && 
                ($i <= ($pages - $range)) &&
                ($i > ($pages - $showitems))
            ) {

                echo "<a class='btn light' href='".get_pagenum_link($i)."'>".$i."</a>";

            }

        }

        if ($paged < $pages && $showitems < $pages) echo "<a class='btn light' href=\"".get_pagenum_link($paged + 1)."\"><i class='icon-chevron-right'></i></a>";

     }

}

/** Custom Comments */
function aq_custom_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>

    <li id="li-comment-<?php comment_ID() ?>" class="cf">
    
        <div id="comment-<?php comment_ID(); ?>" class="aq-comment">
        
            <div <?php comment_class(); ?>>
                
                <?php echo get_avatar($comment,$size='50'); ?>
                
                <div class="overflow">
                
                    <span class="fn"><?php echo get_comment_author_link(); ?></span>
                    <span class="comment-meta commentmetadata"><span class="comment-date"><?php printf( __('%s on %s', 'a10e'), get_comment_date(), get_comment_time() ); ?></span><?php edit_comment_link(__('(Edit)', 'aq10e'),'  ','') ?></span>
                    <span class="reply">
                        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                    </span>
                    <?php if ($comment->comment_approved == '0') : ?>
                        <em><?php _e('Your comment is awaiting moderation.', 'aq10e') ?></em>
                    <?php endif; ?>
                    <?php comment_text() ?>
                    
                </div>
                
            </div> 
            
        </div>
    
    </li>
    
<?php
}

/** Font stacks */
function aq_font_stack($font){
	$stack = '';

	switch ( $font ) {

		case 'arial':
			$stack .= 'Arial, sans-serif';
			break;
		case 'verdana':
			$stack .= 'Verdana, "Verdana Ref", sans-serif';
			break;
		case 'trebuchet':
			$stack .= '"Trebuchet MS", Verdana, "Verdana Ref", sans-serif';
			break;
		case 'georgia':
			$stack .= 'Georgia, serif';
			break;
		case 'times':
			$stack .= 'Times, "Times New Roman", serif';
			break;
		case 'tahoma':
			$stack .= 'Tahoma,Geneva,Verdana,sans-serif';
			break;
		case 'palatino':
			$stack .= '"Palatino Linotype", Palatino, Palladio, "URW Palladio L", "Book Antiqua", Baskerville, "Bookman Old Style", "Bitstream Charter", "Nimbus Roman No9 L", Garamond, "Apple Garamond", "ITC Garamond Narrow", "New Century Schoolbook", "Century Schoolbook", "Century Schoolbook L", Georgia, serif';
			break;
		case 'helvetica':
			$stack .= '"Helvetica Neue", Helvetica, Arial, sans-serif';
			break;
		case 'helvetica_light':
			$stack .= '"HelveticaNeue-Light", "Helvetica Neue", Helvetica, Arial, sans-serif';
			break;
	}
	return $stack;
	
}

add_action('wp_head', 'aq_custom_styles');
function aq_custom_styles() {
	get_template_part('styles');
}

/** Adds sticky icon */
add_filter( 'the_content', 'aq_add_sticky_icon');
add_filter( 'the_content', 'aq_add_content_break');

function aq_add_sticky_icon( $content ) {
	
	if(is_sticky() && is_front_page()) {
		$content = sprintf(
		    '<span class="sticky-icon"><i class="icon-bookmark"></i></span>%s',
		    $content
		);
	}
	
	return $content;
	
}

function aq_add_content_break( $content ) {
	
	if(is_single()) {
		$content = sprintf(
		    '%s<br class="clear" />',
		    $content
		);
	}
	
	return $content;
}

function dfasasdfouifwekjnwenweiwnei() {
	$args = '';
	return "the_post_thumbnail() add_theme_support( 'custom-header', $args ) add_theme_support( 'custom-background', $args ) add_editor_style()";
}





