<?php

if ( ! function_exists( 'fuzzco_post_meta' ) ) :

function fuzzco_post_meta($post_id, $key) {
	global $wpdb;
	$sql = "SELECT m.meta_value FROM wp_postmeta m where m.meta_key = '".$key."' and m.post_id = '".	$post_id."' order by m.meta_id";
	$results = $wpdb->get_results( $sql );
	$meta_values = array();

	foreach($results as $result)
	{
		$meta_values[] = $result->meta_value;
	}
	return $meta_values;
}
endif;

if ( ! function_exists( 'fuzzco_comment' ) ) :

function fuzzco_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if (!have_comments())
	{
		return;
	}

	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class('clear'); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">

		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'fuzzco' ); ?></em>
		<?php endif; ?>

		<div class="clear">

			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, 40 ); ?>
				<?php printf( __( '%s <span class="says"></span>', 'fuzzco' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
			</div><!-- .comment-author .vcard -->

			<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php
					/* translators: 1: date, 2: time */
					printf( __( '%1$s', 'fuzzco' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'fuzzco' ), ' ' );
				?>
			</div><!-- .comment-meta .commentmetadata -->

		</div>

		<div class="comment-body clear"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'fuzzco' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'fuzzco' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

if ( ! function_exists( 'fuzzco_comment_form' ) ) :

function fuzzco_comment_form( $args = array(), $post_id = null ) {
	global $user_identity, $id;

	if ( null === $post_id )
		$post_id = $id;
	else
		$id = $post_id;

	$commenter = wp_get_current_commenter();

	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$fields =  array(
		'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
		            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
		            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
		'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label>' .
		            '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
	);

	$required_text = sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' );
	$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
		'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) . '</p>',
		'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => __( 'Leave a Comment' ),
		'title_reply_to'       => __( 'Leave a Comment to %s' ),
		'cancel_reply_link'    => __( 'Cancel Comment' ),
		'label_submit'         => __( 'Post Comment' ),
	);

	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	?>
		<?php if ( comments_open() ) : ?>
			<?php do_action( 'comment_form_before' ); ?>
			<div id="respond">
				<h3 id="reply-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h3>
				<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
					<?php echo $args['must_log_in']; ?>
					<?php do_action( 'comment_form_must_log_in_after' ); ?>
				<?php else : ?>
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>">
						<?php do_action( 'comment_form_top' ); ?>
						<?php if ( is_user_logged_in() ) : ?>
							<?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
							<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
						<?php else : ?>
							<?php echo $args['comment_notes_before']; ?>
							<?php
							do_action( 'comment_form_before_fields' );
							foreach ( (array) $args['fields'] as $name => $field ) {
								echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
							}
							do_action( 'comment_form_after_fields' );
							?>
						<?php endif; ?>
						<?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
						<?php echo $args['comment_notes_after']; ?>
						<p class="form-submit">
							<input name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
							<?php comment_id_fields( $post_id ); ?>
						</p>
						<?php do_action( 'comment_form', $post_id ); ?>
					</form>
				<?php endif; ?>
			</div><!-- #respond -->
			<?php do_action( 'comment_form_after' ); ?>
		<?php else : ?>
			<?php do_action( 'comment_form_comments_closed' ); ?>
		<?php endif; ?>
	<?php
}

endif;

if ( ! function_exists( 'fuzzco_posted_on' ) ) :

function fuzzco_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'fuzzco' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'fuzzco' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'fuzzco_posted_in' ) ) :

function fuzzco_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'fuzzco' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'fuzzco' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'fuzzco' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

if ( ! function_exists( 'fuzzco_posted_in_short' ) ) :

function fuzzco_posted_in_short() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( '%1$s and tagged %2$s', 'fuzzco' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( '%1$s', 'fuzzco' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'fuzzco' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( '' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

function fuzzco_body_classes( $classes ) {
	global $post;
	if (isset($post->post_name))
	{
		$classes[] = $post->post_name;
	}

	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	}

	if (is_archive() || is_category() || is_singular('post'))
	{
		$classes[] = 'blog';
	}

	if ( is_singular() && ! is_home() && ! is_page_template( 'showcase.php' ) && ! is_page_template( 'sidebar-page.php' ) )
		$classes[] = 'singular';

	return $classes;
}
add_filter( 'body_class', 'fuzzco_body_classes' );

if ( ! function_exists( 'fuzzco_title' ) ) :

function fuzzco_title()
{
	global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && !is_front_page())
		echo '';
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'fuzzco' ), max( $paged, $page ) );
}

endif;

if ( ! function_exists( 'fuzzco_description' ) ) :

function fuzzco_description()
{
	global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description )
		echo ' | ' . $site_description;
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'fuzzco' ), max( $paged, $page ) );
}

endif;

if ( ! function_exists( 'fuzzco_head' ) ) :

function fuzzco_head()
{
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	wp_head();
}

endif;

if ( ! function_exists( 'fuzzco_check_current' ) ) :

function fuzzco_check_current($current_id, $check_id)
{
	if (get_permalink($current_id) == get_permalink($check_id))
	{
		echo 'current';
	}
}

endif;

function fuzzco_the_excerpt($text)
{
	return str_replace('[...]', '...', $text);
}
//add_filter('the_excerpt', 'fuzzco_the_excerpt');

function fuzzco_excerpt_length($length)
{
	return 16;
}
//add_filter('excerpt_length', 'fuzzco_excerpt_length');

if ( ! function_exists( 'fuzzco_feed_request' ) ) :

function fuzzco_feed_request($qv)
{
    if (isset($qv['feed']) && !isset($qv['post_type']))
    {
        $qv['post_type'] = array('post', 'photo-albums', 'projects');
    }

    return $qv;
}
//add_filter('request', 'fuzzco_feed_request');

endif;

if ( ! function_exists( 'fuzzco_find_wp_config' ) ) :

function fuzzco_find_wp_config($dirrectory)
{
	global $confroot;

	foreach(glob($dirrectory."/*") as $f)
	{
		if (basename($f) == 'wp-config.php' )
		{
			$confroot = str_replace("\\", "/", dirname($f));
			return true;
		}

		if (is_dir($f))
		{
			$newdir = dirname(dirname($f));
		}
	}

	if (isset($newdir) && $newdir != $dirrectory)
	{
		if (fuzzco_find_wp_config($newdir))
		{
			return false;
		}
	}

	return false;
}

endif;

if ( ! function_exists( 'fuzzco_include_wp_config' ) ) :

function fuzzco_include_wp_config()
{
	if (!isset($table_prefix))
	{
		global $confroot;
		fuzzco_find_wp_config(dirname(dirname(__FILE__)));
		include_once($confroot.'/wp-config.php');
		include_once($confroot.'/wp-load.php');
	}
}

endif;

/* instagram

1. Go to URL

https://api.instagram.com/oauth/authorize/?client_id=7bdbbe63ab92423482d9f1c1532a1065&redirect_uri=http://fuzzco.com&response_type=code

2. Plug code in and execute in Terminal

curl \-F 'client_id=7bdbbe63ab92423482d9f1c1532a1065' \
    -F 'client_secret=dbcc38e5a3b24bcd90f7b929744f6abb' \
    -F 'grant_type=authorization_code' \
    -F 'redirect_uri=http://fuzzco.com' \
    -F 'code=CODE' \https://api.instagram.com/oauth/access_token

3. Call in page code

fuzzco_get_instagrams(array(
	'access_token' => '195189208.7bdbbe6.6asd876as876876876',
	'instagram_name' => 'erikholmberg',
	'count' => 5,
	'cacheduration' => 60
));

--------------------------------------------- */
if ( ! function_exists( 'fuzzco_get_instagrams' ) ) :

function fuzzco_get_instagrams($args)
{
	$html = '';

	if (isset($args['access_token']))
	{
		fuzzco_check_instagram_args($args);
		$instagrams = wp_cache_get($args['access_token'], 'instagram_cache');

		if ($instagrams === false)
		{
			$instagrams = fuzzco_get_user_instagrams($args);
			wp_cache_set($args['access_token'], $instagrams, 'instagram_cache', $args['cacheduration']);
		}

		$html = fuzzco_get_instagram_html($instagrams, $args);
	}

	echo $html;
}

endif;

if ( ! function_exists( 'fuzzco_get_user_instagrams' ) ) :

function fuzzco_get_user_instagrams($args)
{
	$images = array();

	if(isset($args['hash_tag']) && trim($args['hash_tag']) != "" && preg_match("/[a-zA-Z0-9_\-]+/i", $args['hash_tag']))
	{
		$apiurl = "https://api.instagram.com/v1/tags/";
		$apiurl .= $args['hash_tag']."/media/recent?count=".$args['count'];
		$apiurl .= "&access_token=".$args['access_token'];
	}
	else if(isset($args['instagram_name']) && trim($args['instagram_name']) != "")
	{
		$apiurl = "https://api.instagram.com/v1/users/search?q=";
		$apiurl .= $args['instagram_name']."&access_token=".$args['access_token'];

		$user_response = wp_remote_get($apiurl, array('sslverify' => apply_filters('https_local_ssl_verify', false)));

		if(!is_wp_error($user_response) && $user_response['response']['code'] < 400 && $user_response['response']['code'] >= 200)
		{
			$data = json_decode($user_response['body']);

			if($data->meta->code == 200)
			{
				$user_id = $data->data[0]->id;

				$apiurl = "https://api.instagram.com/v1/users/".$user_id."/media/recent?count=".$args['count']."&access_token=".$args['access_token'];
			}
		}
	}
	else
	{
		$apiurl = "https://api.instagram.com/v1/users/self/media/recent?count=".$args['count']."&access_token=".$args['access_token'];
	}

	$response = wp_remote_get($apiurl, array('sslverify' => apply_filters('https_local_ssl_verify', false)));

	if(!is_wp_error($response) && $response['response']['code'] < 400 && $response['response']['code'] >= 200)
	{
		$data = json_decode($response['body']);

		if($data->meta->code == 200)
		{
			foreach($data->data as $item)
			{
				$like_count = isset($item->likes->count) ? $item->likes->count : 0;

				$images[] = array(
					'title' => isset($item->caption->text) ? $item->caption->text : '',
					'image_small' => $item->images->thumbnail->url,
					'image_medium' => $item->images->low_resolution->url,
					'image_large' => $item->images->standard_resolution->url,
					'username' => $item->user->username,
					'url' => $item->link,
					'like_count' => $like_count
				);
			}
		}
	}

	return $images;
}

endif;

if ( ! function_exists( 'fuzzco_get_instagram_html' ) ) :

function fuzzco_get_instagram_html($instagrams, $args)
{
	$html = '<ul class="instagrams">';

	if (count($instagrams) != 0)
	{
		for ($index = 0; $index < $args['count']; $index++)
		{
			$html .= '<li class="instagram"><a href="'.$instagrams[$index]['url'].'" target="_blank"><img src="'.$instagrams[$index]['image_small'].'" alt="" title="'.$instagrams[$index]['title'].'" /></a></li>';
		}
	}

	$html .= '</ul>';

	return $html;
}

endif;

if ( ! function_exists( 'fuzzco_check_instagram_args' ) ) :

function fuzzco_check_instagram_args(&$args)
{
	if (!isset($args['count']))
	{
		$args['count'] = '10';
	}

	if (!isset($args['cacheduration']))
	{
		$args['cacheduration'] = 600;
	}

	if (!isset($args['hashtag']))
	{
		$args['hashtag'] = '';
	}

	if (!isset($args['instagram_name']))
	{
		$args['instagram_name'] = '';
	}

	if (!isset($args['access_token']))
	{
		$args['access_token'] = '';
	}

	if (!isset($args['instagram_name']))
	{
		$args['instagram_name'] = '';
	}
}

endif;

/* twitter

1. Call in page code

fuzzco_get_tweets(array(
	'twitter_name' => '@erikholmberg',
	'count' => 2,
	'cacheduration' => 60
));

--------------------------------------------- */
if ( ! function_exists( 'fuzzco_get_tweets' ) ) :

function fuzzco_get_tweets($args)
{
	$html = '';
	fuzzco_check_tweet_args($args);
	$tweets = wp_cache_get($args['twitter_name'], 'twitter_cache');

	if ($tweets === false)
	{
		$tweets = fuzzco_get_user_tweets($args['twitter_name']);
		wp_cache_set($args['twitter_name'], $tweets, 'twitter_cache', $args['cacheduration']);
	}

	$html = fuzzco_get_tweet_html($tweets, $args);

	echo $html;
}

endif;

if ( ! function_exists( 'fuzzco_get_tweet_html' ) ) :

function fuzzco_get_tweet_html($tweets, $args)
{
	$html = '<ul class="tweets">';

	if (count($tweets) != 0)
	{
		for ($index = 0; $index < $args['count']; $index++)
		{
			$html .= '<li class="tweet">'.fuzzco_format_tweet_links($tweets[$index]->text).'</li>';
		}
	}

	$html .= '</ul>';

	return $html;
}

endif;

if ( ! function_exists( 'fuzzco_check_tweet_args' ) ) :

function fuzzco_check_tweet_args(&$args)
{
	if (!isset($args['count']))
	{
		$args['count'] = '10';
	}

	if (!isset($args['cacheduration']))
	{
		$args['cacheduration'] = 600;
	}

	if (!isset($args['twitter_name']))
	{
		$args['twitter_name'] = '';
	}
}

endif;

if ( ! function_exists( 'fuzzco_get_user_tweets' ) ) :

function fuzzco_get_user_tweets($screenname)
{
	$url = "http://api.twitter.com/1/statuses/user_timeline.json?exclude_replies=1&screen_name=".$screenname;

	$response = wp_remote_post($url, array('method' => 'GET'));

	if(!is_wp_error($response) && $response['response']['code'] < 400 && $response['response']['code'] >= 200)
	{
		$tweets = json_decode($response['body']);
		return $tweets;
	}
	else
	{
		return array();
	}
}

endif;

if ( ! function_exists( 'fuzzco_format_tweet_links' ) ) :

function fuzzco_format_tweet_links($text)
{
    // convert URLs into links
    $text = preg_replace(
        "#(https?://([-a-z0-9]+\.)+[a-z]{2,5}([/?][-a-z0-9!\#()/?&+]*)?)#i", "<a href='$1' target='_blank'>$1</a>",
        $text);
    // convert protocol-less URLs into links
    $text = preg_replace(
        "#(?!https?://|<a[^>]+>)(^|\s)(([-a-z0-9]+\.)+[a-z]{2,5}([/?][-a-z0-9!\#()/?&+.]*)?)\b#i", "$1<a href='http://$2'>$2</a>",
        $text);
    // convert @mentions into follow links
    $text = preg_replace(
        "#(?!https?://|<a[^>]+>)(^|\s)(@([_a-z0-9\-]+))#i", "$1<a href=\"http://twitter.com/$3\" title=\"Follow $3\" target=\"_blank\">@$3</a>",
        $text);
    // convert #hashtags into tag search links
    $text = preg_replace(
        "#(?!https?://|<a[^>]+>)(^|\s)(\#([_a-z0-9\-]+))#i", "$1<a href='http://twitter.com/search?q=%23$3' title='Search tag: $3' target='_blank'>#$3</a>",
        $text);
    return $text;
}

endif;

/* dribbble

1. Call in page code

fuzzco_get_dribbbles(array(
	'dribbble_name' => 'fuzzco',
	'count' => 6,
	'cacheduration' => 60
));

--------------------------------------------- */

if ( ! function_exists( 'fuzzco_get_dribbbles' ) ) :

function fuzzco_get_dribbbles($args)
{
	$html = '';
	fuzzco_check_dribbble_args($args);
	$dribbbles = wp_cache_get($args['dribbble_name'], 'dribbble_cache');

	if ($dribbbles === false)
	{
		$dribbbles = fuzzco_get_user_dribbbles($args['dribbble_name'], $args['count']);
		wp_cache_set($args['dribbble_name'], $dribbbles, 'dribbble_cache', $args['cacheduration']);
	}

	$html = fuzzco_get_dribbble_html($dribbbles, $args);

	echo $html;
}

endif;

if ( ! function_exists( 'fuzzco_get_user_dribbbles' ) ) :

function fuzzco_get_user_dribbbles($username, $count)
{
	$dribbbles = array();
	$url = "http://api.dribbble.com/players/".$username."/shots?per_page=".$count;

	$response = wp_remote_post($url, array('method' => 'GET'));

	if(!is_wp_error($response) && $response['response']['code'] < 400 && $response['response']['code'] >= 200)
	{
		$data = json_decode($response['body']);

		foreach($data->shots as $shot)
		{
			$dribbbles[] = array(
				'short_url' => $shot->short_url,
				'created_at' => $shot->created_at,
				'image_url' => $shot->image_url,
				'title' => $shot->title,
				'likes_count' => $shot->likes_count,
				'url' => $shot->url,
				'rebounds_count' => $shot->rebounds_count,
				'id' => $shot->id,
				'image_teaser_url' => $shot->image_teaser_url,
				'height' => $shot->height,
				'views_count' => $shot->views_count,
				'comments_count' => $shot->comments_count,
				'width' => $shot->width
			);
		}

		return $dribbbles;
	}
	else
	{
		return array();
	}
}

endif;

if ( ! function_exists( 'fuzzco_get_dribbble_html' ) ) :

function fuzzco_get_dribbble_html($dribbbles, $args)
{
	$html = '<ul class="dribbbles">';

	if (count($dribbbles) != 0)
	{
		for ($index = 0; $index < $args['count']; $index++)
		{
			$html .= '<li class="dribbble"><a href="'.$dribbbles[$index]['url'].'" target="_blank"><img src="'.$dribbbles[$index]['image_url'].'" alt="" title="'.$dribbbles[$index]['title'].'" /></a></li>';
		}
	}

	$html .= '</ul>';

	return $html;
}

endif;

if ( ! function_exists( 'fuzzco_check_dribbble_args' ) ) :

function fuzzco_check_dribbble_args(&$args)
{
	if (!isset($args['count']))
	{
		$args['count'] = '5';
	}

	if (!isset($args['cacheduration']))
	{
		$args['cacheduration'] = 600;
	}

	if (!isset($args['dribbble_name']))
	{
		$args['dribbble_name'] = '';
	}
}

endif;

/* flickr

1. Call in page code

fuzzco_get_flickrs(array(
	'flickr_name' => 'erikholmberg',
	'count' => 6,
	'cacheduration' => 60
));

--------------------------------------------- */

if ( ! function_exists( 'fuzzco_get_flickrs' ) ) :

function fuzzco_get_flickrs($args)
{
	$html = '';
	fuzzco_check_flickr_args($args);
	$flickrs = wp_cache_get($args['flickr_name'], 'flickr_cache');

	if ($flickrs === false)
	{
		$flickrs = fuzzco_get_user_flickrs($args);
		wp_cache_set($args['flickr_name'], $flickrs, 'flickr_cache', $args['cacheduration']);
	}

	$html = fuzzco_get_flickr_html($flickrs, $args);

	echo $html;
}

endif;

if ( ! function_exists( 'fuzzco_get_user_flickrs' ) ) :

function fuzzco_get_user_flickrs(&$args)
{
	$flickr_api_key = "1fb013ed053fe1eee1548f1eaabc4e70";
	$flickrs = array();
	$user_id = '';

	$user_url = "http://api.flickr.com/services/rest/?method=flickr.people.findByUsername&api_key=".$flickr_api_key."&username=".$args['flickr_name']."&format=json&nojsoncallback=1";

	$user_response = wp_remote_post($user_url, array('method' => 'GET'));

	if(!is_wp_error($user_response) && $user_response['response']['code'] < 400 && $user_response['response']['code'] >= 200)
	{
		$data = json_decode($user_response['body']);

		$user_id = $args['user_id'] = $data->user->id;
	}

	if ($user_id != '')
	{
		$url = "http://api.flickr.com/services/rest/?method=flickr.people.getPublicPhotos&api_key=".$flickr_api_key."&user_id=".$user_id."&format=json&nojsoncallback=1&extras=description,license,date_upload,date_taken,owner_name,icon_server,original_format,last_update,geo,tags,o_dims,views,media,url_sq,url_t,url_s,url_q,url_m,url_n,url_z,url_c,url_l,url_o&per_page=".$args['count'];

		$response = wp_remote_post($url, array('method' => 'GET'));

		if(!is_wp_error($response) && $response['response']['code'] < 400 && $response['response']['code'] >= 200)
		{
			$data = json_decode($response['body']);

			foreach($data->photos->photo as $photo)
			{
				$flickrs[] = array(
					'id' => $photo->id,
					'title' => $photo->title,
					'description' => $photo->description->_content,
					'date_taken' => $photo->datetaken,
					'url_sq' => $photo->url_sq,
					'url_s' => $photo->url_s,
					'url_m' => $photo->url_m,
					'url_l' => isset($photo->url_l) ? $photo->url_l : '',
					'url_o' => isset($photo->url_o) ? $photo->url_o : ''
				);
			}

			return $flickrs;
		}
		else
		{
			return array();
		}
	}
}

endif;

if ( ! function_exists( 'fuzzco_get_flickr_html' ) ) :

function fuzzco_get_flickr_html($flickrs, $args)
{
	$html = '<ul class="flickrs">';

	if (count($flickrs) != 0)
	{
		for ($index = 0; $index < $args['count']; $index++)
		{
			$html .= '<li class="flickr"><a href="http://www.flickr.com/photos/'.$args['user_id'].'/'.$flickrs[$index]['id'].'/" target="_blank"><img src="'.$flickrs[$index]['url_sq'].'" alt="" title="'.$flickrs[$index]['title'].'" /></a></li>';
		}
	}

	$html .= '</ul>';

	return $html;
}

endif;

if ( ! function_exists( 'fuzzco_check_flickr_args' ) ) :

function fuzzco_check_flickr_args(&$args)
{
	if (!isset($args['count']))
	{
		$args['count'] = '5';
	}

	if (!isset($args['cacheduration']))
	{
		$args['cacheduration'] = 600;
	}

	if (!isset($args['flickr_name']))
	{
		$args['flickr_name'] = '';
	}
}

endif;

if ( ! function_exists( 'fuzzco_check_flickr_args' ) ) :

function fuzzco_list_categories()
{
	$needle = '</a>';
	$separator = '<span class="cat-bullet"> &bull; </span>'; // fill in your separator here
	$cat_list_args = array(
	        'echo'  	=> __( 0 ),  // sends output to variable
		'title_li'	=> __( '' ), // removes title of list (optional)
		'hierarchical'	=> __( 0 ), // makes subcategories not show as inner list items (optional)
		'exclude'	=> __( 1 ), // excludes uncategorized (optional)
	);
	$cat_list_arr = wp_list_categories( $cat_list_args );
	$cat_list_mod = str_replace($needle,$needle.$separator,$cat_list_arr); // switch to $separator.$needle if you want separator inside a tag
	echo $cat_list_mod;
}

endif;

// Remove heights and widths from thumbnails for responsive
//add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );

// Remove heights and widths from inserted images for responsive
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}

if (!function_exists('fuzzco_vars')) :

  function fuzzco_vars() {
  	echo '<script type="text/javascript">
  	     var themeUrl = \''.get_template_directory_uri().'/\';
  	     var homeUrl = \''.home_url().'/\';
  	     </script>';
  }
  add_action('wp_footer', 'fuzzco_vars');

endif;