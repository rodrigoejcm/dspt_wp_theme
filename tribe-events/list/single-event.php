<?php
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @version 4.6.19
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Setup an array of venue details for use later in the template
$venue_details = tribe_get_venue_details();

// The address string via tribe_get_venue_details will often be populated even when there's
// no address, so let's get the address string on its own for a couple of checks below.
$venue_address = tribe_get_address();

// Venue
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

// Organizer
$organizer = tribe_get_organizer();

?>

<?php
	if(has_post_thumbnail($event_id)) {
		$style = "background-image: url(" .get_the_post_thumbnail_url(). ")";
	}
	else{
    $path = get_stylesheet_directory_uri()."/img/placeholder_noimg.jpeg";
    $style = "background-image: url(" .$path. ")";
		
	}
?>

<div class="event_container">
  <div class="event_bg" style=" <?php echo $style  ?>">  
	<div class="date-ribbon">
		<h2><?php echo tribe_get_start_date( $event_id, true, 'M'); ?></h2>
		<h1><?php echo tribe_get_start_date( $event_id, true, 'd'); ?></h1>
	</div>
	
	
	
  </div>
  <div class="event_info">
  <div class="div-local">
		<span class='tag-local'><?php echo tribe_get_city(); ?></span>
	</div>
    <div class="event_title">
      <h4>
		<a class="tribe-event-url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
			<?php the_title() ?>
		</a>
	  </h4>
	</div>

	
	
    <div class="event_desc">
	  <p><?php echo tribe_events_get_the_excerpt( null, wp_kses_allowed_html( 'post' ) ); ?></p>
	  
	  
    </div>
    <div class="event_footer">
      <div class="event_date">
        <p><?php echo tribe_events_event_schedule_details() ?></p>
      </div>
      <div class="event_more">
        <a href="<?php echo esc_url( tribe_get_event_link() ); ?>" class="btn_more">
          Learn More >>
        </a>
      </div>
    </div>
  </div>
</div>

