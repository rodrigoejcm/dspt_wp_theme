<?php
/**
 * List View Template
 * The wrapper template for a list of events. This includes the Past Events and Upcoming Events views
 * as well as those same views filtered to a specific category.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

do_action( 'tribe_events_before_template' );
?>


<section class="av_textblock_section " itemscope="itemscope" itemtype="https://schema.org/CreativeWork"><div class="avia_textblock  " style="font-size:12px; " itemprop="text"><h2 style="text-align: center;">Upcoming Events</h2>
<p style="text-align: center;">Want to see your own Events related to Data Science on this list? You can <strong><a href="https://www.datascienceportugal.com/wp-login.php?action=register" target="_blank" rel="noopener">register</a></strong> in our website and start <strong><a href="https://www.datascienceportugal.com/wp-admin/post-new.php?post_type=tribe_events">adding new events</a></strong> right away!</p>
<p style="text-align: center;">Don’t forget to subscribe our Events RSS Feeds <a href="https://www.datascienceportugal.com/eventlist/feed/" target="_blank" rel="noopener" style="position: relative; overflow: hidden;"><img src="https://www.datascienceportugal.com/wp-content/plugins/rss-icon-widget/icons/feed-icon-16x16.png" alt="RSS Events"><span class="image-overlay overlay-type-extern" style="display: none;"><span class="image-overlay-inside"></span></span></a></p>
<p style="text-align: center;">
</p></div></section>

<br/>>

<!-- Title Bar -->
<?php tribe_get_template_part( 'list/title-bar' ); ?>

	<!-- Tribe Bar -->
<?php tribe_get_template_part( 'modules/bar' ); ?>

	<!-- Main Events Content -->
<?php tribe_get_template_part( 'list/content' ); ?>

	<div class="tribe-clear"></div>

<?php
do_action( 'tribe_events_after_template' );
