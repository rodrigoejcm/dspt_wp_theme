<?php
/**
 * Single job listing.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-single-job_listing.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager
 * @category    Template
 * @since       1.0.0
 * @version     1.28.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;
?>
<div class="single_job_listing">
	<?php if ( get_option( 'job_manager_hide_expired_content', 1 ) && 'expired' === $post->post_status ) : ?>
		<div class="job-manager-info"><?php _e( 'This listing has expired.', 'wp-job-manager' ); ?></div>
	<?php else : ?>
		<?php
			/**
			 * single_job_listing_start hook
			 *
			 * @hooked job_listing_meta_display - 20
			 * @hooked job_listing_company_display - 30
			 */
			do_action( 'single_job_listing_start' );
		?>

		<div class="job_description">
			<?php wpjm_the_job_description(); ?>
		</div>

		<hr/>
		<div class="job_description disclaimer" style="font-size: 11px;    line-height: 15px;">
			<b>Disclaimer</b>
			<p>Data Science Portugal retains the right to refuse to post jobs from any employer or any organization that do not 				support the interests and values of Data Science Portugal and its community. </p>
			<p>Postings are based on the information provided by the employer and is of their entire responsibility.</p>
			<p>Data Science Portugal makes no guarantee about positions listed and is not responsible for safety,wages, working 				conditions, or other aspects of employment. It is the responsibility of each individual job seeker to research the 				integrity of the organization(s) to which he/she is applying and to verify the specific information pertaining to the 				job posting. Job seekers should exercise due diligence and use common sense and caution when applying for or accepting 				any position.</p>
			<p>We will not post jobs that appear to discriminate against applicants on the basis of race, color, religion, creed, 				age, national origin, sexual orientation, disability, or gender.</p>

		</div>
		<br/>

		<?php if ( candidates_can_apply() ) : ?>
			<?php get_job_manager_template( 'job-application.php' ); ?>
		<?php endif; ?>

		<?php
			/**
			 * single_job_listing_end hook
			 */
			do_action( 'single_job_listing_end' );
		?>
	<?php endif; ?>
</div>
