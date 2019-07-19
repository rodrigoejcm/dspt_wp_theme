<?php
/**
 * Content for job submission (`[submit_job_form]`) shortcode.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/job-submit.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager
 * @category    Template
 * @version     1.31.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $job_manager;
?>
<form action="<?php echo esc_url( $action ); ?>" method="post" id="submit-job-form" class="job-manager-form" enctype="multipart/form-data">

	<?php
	if ( isset( $resume_edit ) && $resume_edit ) {
		printf( '<p><strong>' . esc_html__( "You are editing an existing job. %s", 'wp-job-manager' ) . '</strong></p>', '<a href="?new=1&key=' . esc_attr( $resume_edit ) . '">' . esc_html__( 'Create A New Job', 'wp-job-manager' ) . '</a>' );
	}
	?>

	<?php do_action( 'submit_job_form_start' ); ?>

	<?php if ( apply_filters( 'submit_job_form_show_signin', true ) ) : ?>

		<?php get_job_manager_template( 'account-signin.php' ); ?>

	<?php endif; ?>

	<?php if ( job_manager_user_can_post_job() || job_manager_user_can_edit_job( $job_id ) ) : ?>

		<!-- Job Information Fields -->
		<?php do_action( 'submit_job_form_job_fields_start' ); ?>

		<?php foreach ( $job_fields as $key => $field ) : ?>
			<fieldset class="fieldset-<?php echo esc_attr( $key ); ?>">
				<label for="<?php echo esc_attr( $key ); ?>"><?php echo wp_kses_post( $field['label'] ) . wp_kses_post( apply_filters( 'submit_job_form_required_label', $field['required'] ? '' : ' <small>' . __( '(optional)', 'wp-job-manager' ) . '</small>', $field ) ); ?></label>
				<div class="field <?php echo $field['required'] ? 'required-field' : ''; ?>">
					<?php get_job_manager_template( 'form-fields/' . $field['type'] . '-field.php', array( 'key' => $key, 'field' => $field ) ); ?>
				</div>
			</fieldset>
		<?php endforeach; ?>

		<?php do_action( 'submit_job_form_job_fields_end' ); ?>

		<!-- Company Information Fields -->
		<?php if ( $company_fields ) : ?>
			<h2><?php esc_html_e( 'Company Details', 'wp-job-manager' ); ?></h2>

			<?php do_action( 'submit_job_form_company_fields_start' ); ?>

			<?php foreach ( $company_fields as $key => $field ) : ?>
				<fieldset class="fieldset-<?php echo esc_attr( $key ); ?>">
					<label for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field['label'] ) . wp_kses_post( apply_filters( 'submit_job_form_required_label', $field['required'] ? '' : ' <small>' . __( '(optional)', 'wp-job-manager' ) . '</small>', $field ) ); ?></label>
					<div class="field <?php echo $field['required'] ? 'required-field' : ''; ?>">
						<?php get_job_manager_template( 'form-fields/' . $field['type'] . '-field.php', array( 'key' => $key, 'field' => $field ) ); ?>
					</div>
				</fieldset>
			<?php endforeach; ?>

			<?php do_action( 'submit_job_form_company_fields_end' ); ?>
		<?php endif; ?>

		<?php do_action( 'submit_job_form_end' ); ?>

		<hr/>
		<div class="job_description disclaimer" style="font-size: 11px;    line-height: 15px;">
			<b>Disclaimer</b>
			<p>Data Science Portugal retains the right to refuse to post jobs from any employer or any organization that do not 				support the interests and values of Data Science Portugal and its community. </p>
			<p>Postings are based on the information provided by the employer and is of their entire responsibility.</p>
			<p>Data Science Portugal makes no guarantee about positions listed and is not responsible for safety,wages, working 				conditions, or other aspects of employment. It is the responsibility of each individual job seeker to research the 				integrity of the organization(s) to which he/she is applying and to verify the specific information pertaining to the 				job posting. Job seekers should exercise due diligence and use common sense and caution when applying for or accepting 				any position.</p>
			<p>We will not post jobs that appear to discriminate against applicants on the basis of race, color, religion, creed, 				age, national origin, sexual orientation, disability, or gender.</p>

		</div>
		<br/>

		<p>
			<input type="hidden" name="job_manager_form" value="<?php echo esc_attr( $form ); ?>" />
			<input type="hidden" name="job_id" value="<?php echo esc_attr( $job_id ); ?>" />
			<input type="hidden" name="step" value="<?php echo esc_attr( $step ); ?>" />
			<input type="submit" name="submit_job" class="button" value="<?php echo esc_attr( $submit_button_text ); ?>" />
			<span class="spinner" style="background-image: url(<?php echo esc_url( includes_url( 'images/spinner.gif' ) ); ?>);"></span>
		</p>

	<?php else : ?>

		<?php do_action( 'submit_job_form_disabled' ); ?>

	<?php endif; ?>
</form>
