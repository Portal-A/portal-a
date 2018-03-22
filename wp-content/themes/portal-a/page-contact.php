<?php
/*
TEMPLATE NAME: Contact
*/
?>

<?php get_header(); ?>
<?php if (have_posts()) while (have_posts()) : the_post(); ?>

<!--
<div class="top">
	<?php
	$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full-size');
	$image_info = get_post(get_post_thumbnail_id($post->ID));
	?>
	<?php if ($image != false) : ?>				
	<img src="<?php bloginfo('template_directory'); ?>/-/img/blank.gif" data-src="<?= $image[0] ?>" alt="<?= $image_info->post_title ?>" title="<?= $image_info->post_excerpt ?>" />
	<?php endif; ?>
	
	<h2>Here's our number:</h2>
	<h6><?= get_post_meta(2, 'phone', TRUE) ?></h6>
	
</div>
-->

<?php											
$args = array(
	'numberposts' => -1,
	'post_type' => 'locations',
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'post_status' => 'publish'
);
					    
$items = get_posts($args);
$item_index = 1;
?>

<div class="offices-wrapper">
	
	<h2 class="page-headline">
		<?php if (trim(get_post_meta(2, 'locations_title', TRUE)) != ''): ?>
			<?= get_post_meta(2, 'locations_title', TRUE); ?>
		<?php else: ?>
			Our Offices
		<?php endif; ?>
	</h2>
	
	<div class="offices clear">
		<?php foreach ($items as $item) : ?>
		<div class="location <?= $item_index % 2 == 0 ? 'last' : '' ?>">
		
			<div class="location-imagery">
				
				<?php if (has_post_thumbnail($item->ID)): ?>
					<div class="location-photo"><?= get_the_post_thumbnail($item->ID); ?></div>
				<?php endif; ?>
			
				<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
				<?php if ($item->ID == 21): ?>
					<div id="map_sanfran" class="location-map" style="height: 280px; width: 480px;"></div>
					<script>
				      var sf_map;
				      var image = '<?= get_template_directory_uri(); ?>/-/img/map-pin.png';
				      
				      function initialize() {
				        var mapOptions = {
				          zoom: 8,
				          center: new google.maps.LatLng(37.7717739, -122.4096384),
				          mapTypeId: google.maps.MapTypeId.SATELLITE,
				          zoom: 18
				        };
				        sf_map = new google.maps.Map(document.getElementById('map_sanfran'),
				            mapOptions);
				        
				        var myPos = new google.maps.LatLng(37.7717739, -122.4096384); 
						var myMarker = new google.maps.Marker({position: myPos, map: sf_map, icon: image });
				      }
				
				      google.maps.event.addDomListener(window, 'load', initialize);
				    </script>
	
				<?php elseif ($item->ID == 18): ?>
					<div id="map_la" class="location-map" style="height: 280px; width: 480px;"></div>
					<script>
				      var la_map;
				      function initialize() {
				        var mapOptions = {
				          zoom: 8,
				        //   center: new google.maps.LatLng(34.033984, -118.229647),
						  center: new google.maps.LatLng(34.047943, -118.256483),
				          mapTypeId: google.maps.MapTypeId.SATELLITE,
				          zoom: 18
				        };
				        la_map = new google.maps.Map(document.getElementById('map_la'),
				            mapOptions);
				        
				        // var myPos = new google.maps.LatLng(34.033984, -118.229647); 
						var myPos = new google.maps.LatLng(34.047943, -118.256483); 
						var myMarker = new google.maps.Marker({position: myPos, map: la_map, icon: image });
				      }
				
				      google.maps.event.addDomListener(window, 'load', initialize);
				    </script>
				<?php endif; ?>
				
			</div>
			
			<h3><?= $item->post_title ?> <a href="<?= get_post_meta($item->ID, 'map_url', TRUE) ?>" target="_blank">(Map)</a></h3>
			<p><?= get_post_meta($item->ID, 'address', TRUE) ?></p>
		</div>
		<?php $item_index++; endforeach; ?>
	</div>
	
</div>

<div class="email-wrapper clear">

	<?php
		$biz_title = get_post_meta(2, 'biz_email_headline', TRUE);
		$biz_email = get_post_meta(2, 'biz_email', TRUE);
		$job_title = get_post_meta(2, 'job_email_headline', TRUE);
		$job_email = get_post_meta(2, 'job_email', TRUE);
		$info_title = get_post_meta(2, 'info_email_headline', TRUE);
		$info_email = get_post_meta(2, 'info_email', TRUE);
		$media_title = get_post_meta(2, 'media_title', TRUE);
		$phone_title = get_post_meta(2, 'phone_title', TRUE);
	?>

	<div class="quarter">
		<h2><a href="mailto:<?= $biz_email ?>"><?= $biz_title ?></a></h2>
		<p><a href="mailto:<?= $biz_email ?>"><?= $biz_email ?></a></p>
	</div>
	<div class="quarter">
		<h2><a href="mailto:<?= $job_email ?>"><?= $job_title ?></a></h2>
		<p><a href="mailto:<?= $job_email ?>"><?= $job_email ?></a></p>
	</div>
	<div class="quarter">
		<h2><a href="mailto:<?= $info_email ?>"><?= $info_title ?></a></h2>
		<p><a href="mailto:<?= $info_email ?>"><?= $info_email ?></a></p>
	</div>
	
	<div class="quarter quarter-last">
		<h2><a href="<?= get_post_meta(2, 'facebook_url', TRUE) ?>" target="_blank"><?= $media_title ?></a></h2>
		<span class="social clear"><a href="<?= get_post_meta(2, 'facebook_url', TRUE) ?>" target="_blank" class="facebook">Facebook</a> <a href="<?= get_post_meta(2, 'twitter_url', TRUE) ?>" target="_blank" class="twitter">Twitter</a> <a href="<?= get_post_meta(2, 'youtube_url', TRUE) ?>" target="_blank" class="youtube">YouTube</a></span>
	</div>
</div>

<?php endwhile; ?>
<?php get_footer(); ?>
