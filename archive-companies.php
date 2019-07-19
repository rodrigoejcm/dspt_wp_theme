<?php
get_header();

?>

<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>

<div class='container template-blog '>

    <main class='content <?php avia_layout_class( 'content' ); ?> units' <?php avia_markup_helper(array('context' => 'content','post_type'=>'post'));?>>

    <?php   $count_posts = wp_count_posts('companies');
                    $published_posts = $count_posts->publish;
            ?>

    <h2>Data Science in Portugal - Companies  (<?php echo $published_posts; ?>) </h2>
    <br/>
    <br/>
    
    <div id="search-results">
    <div class="flex_column av_one_third  flex_column_div av-zero-column-padding first">
            <div class="panel panel-warning">
            <div class="panel-body">
                <div class="search-filter">
                <ul class="list-group">
                    <li class="list-group-item">
                      <h5>Company Name</h5>
                      <input class="search form-control" placeholder="Search" />
                    </li>
                    <li class="list-group-item">
                    <div class="locationContainer">
                        <h5 class="list-group-item-heading">Location</h5>
                    </div>
                    </li>
                    <li class="list-group-item">
                    <div class="projectContainer">
                        <h5 class="list-group-item-heading">Projects</h5>
                    </div>
                    </li>
                    
                </ul>
                </div>
            </div>
            </div>
        </div>
    <div class="flex_column av_two_third  flex_column_div av-zero-column-padding">
            <div class="panel panel-primary">
            <div class="panel-body">
              <ul class="list" id="timeline">
                
                <?php
                    if(have_posts()) : while(have_posts()) : the_post();
                ?>  
                
                
                  <a href="<?php echo get_post_meta( $post->ID,'website-company', True); ?>">
                    <li class="listing clearfix">
                      <div class="image_wrapper">
                      <?php 
                        if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                      ?>
                          <img src="<?php echo the_post_thumbnail_url(); ?>" />
                      <?php 
                          } 
                      ?>
                      </div>
                      <div class="info">
                        <span class="job_title name"><?php the_title(); ?></span>
                        <div class="job_info">
                          <?php $terms = strip_tags(get_the_term_list( $post->ID, 'company_location', False, ' &bull; ', ' ')); ?>
                          <span><?php echo $terms ; ?></span>
                          <br/>
                          
                          <?php $terms = get_the_term_list( $post->ID, 'company_location', '', '|'); ?>
                          <?php $terms = strip_tags( $terms ); ?>
                          <div class="location hidden"><?php echo $terms ; ?></div>
                          
                        </div>
                        <div class="projects">
                          <strong>Projects: </strong>
                          <?php $terms = strip_tags(get_the_term_list( $post->ID, 'projects', '', ', ', ' ')); ?>
                          <span class="color-orange"><?php echo $terms ; ?></span>
                          <?php $terms = get_the_term_list( $post->ID, 'projects', '', '|'); ?>
                          <?php $terms = strip_tags( $terms ); ?>
                          
                          <br/>
                          <div class="project hidden"><?php echo $terms ; ?></div>
                        </div>
                      </div>
                    </li>
                  </a>


                <?php endwhile; endif; ?>
                </ul>                
                </div>
              <ul class="pagination"></ul>
            </div>
        </div>
        
        
    </div>


    <br/>
    <hr/>

    
    <!--end content-->
    </main>

    <?php

    //get the sidebar
    $avia_config['currently_viewing'] = 'blog';
    get_sidebar();

    ?>

</div><!--end container-->

</div><!-- close default .container_wrap element -->


<?php

get_footer();
?>

