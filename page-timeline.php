
<?php
	if ( !defined('ABSPATH') ){ die(); }
	
	global $avia_config;

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */
	 get_header();


 	 if( get_post_meta(get_the_ID(), 'header', true) != 'no') echo avia_title();
 	 
 	 do_action( 'ava_after_main_title' );
	 ?>

		<div  class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>

			<div class='container' style="min-height:100vh !important" >

				<main class='template-page content  <?php avia_layout_class( 'content' ); ?> units' <?php avia_markup_helper(array('context' => 'content','post_type'=>'page'));?>>

				<section class="av_textblock_section " itemscope="itemscope" itemtype="https://schema.org/CreativeWork">
					<div class="avia_textblock  " itemprop="text">
					<h2 style="text-align: center;">Data Science Portugal Timeline</h2>
						<p style="text-align: center;">The journey so far that made us who we are!</p>	
					</div>
				</section>

				<div id="links" style="text-align: center;">
					
				</div>
				
				
				<div id="links_other" style="text-align: center;">

				</div>


				<div class="hr hr-short hr-center   avia-builder-el-2  el_after_av_textblock  el_before_av_heading "><span class="hr-inner "><span class="hr-inner-style"></span></span></div>

					
					<div class="loader" id="loader"></div>
					<section class="timeline">
						<div class="container" id="timeline"></div>
					</section>
				<!--end content-->
				</main>


			</div><!--end container-->

		</div><!-- close default .container_wrap element -->



<?php get_footer(); ?>









