<?php
get_header();

?>

<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>

<div class='container template-blog '>

    <main class='content <?php avia_layout_class( 'content' ); ?> units' <?php avia_markup_helper(array('context' => 'content','post_type'=>'post'));?>>

    <h2>Companies doing data science in Portugal</h2>
    <?php 
       single_cat_title();
    ?>
    






    <h4>Locations</h4>
    <div class="projects_list">
    <?php
      
      $terms = get_terms( 'company_location', 'orderby=count&hide_empty=0' );
      if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
        $count = count( $terms );
        $i = 0;
        $term_list = '<ul class="companies_projects_list">';
        foreach ( $terms as $term ) {
            $i++;
            $term_list .= '<li><a href="' . esc_url( get_term_link( $term ) ) . '" alt="' . esc_attr( sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $term->name ) ) . '">' . $term->name . '</a> ('. $term->count.') </li>';
            if ( $count == $i ) {
              $term_list .= '</ul>';
            }
            
            
        }
        echo $term_list;
    }

    ?>
    </div>
    <br/>
    <hr/>
    <h4>Projects</h4>
    <div class="projects_list">
    <?php
      
      $terms = get_terms( 'projects', 'orderby=count&hide_empty=0' );
      if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
        $count = count( $terms );
        $i = 0;
        $term_list = '<ul class="companies_projects_list">';
        foreach ( $terms as $term ) {
            $i++;
            $term_list .= '<li><a href="' . esc_url( get_term_link( $term ) ) . '" alt="' . esc_attr( sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $term->name ) ) . '">' . $term->name . '</a> ('. $term->count.') </li>';
            if ( $count == $i ) {
              $term_list .= '</ul>';
            }
            
            
        }
        echo $term_list;
    }

    ?>
    </div>
    <ul id="timeline">
    
    <?php
        if(have_posts()) : while(have_posts()) : the_post();
    ?>  
    
    
      <a href="<?php the_permalink(); ?>">
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
            <span class="job_title"><?php the_title(); ?></span>
            <div class="job_info">
              <?php echo get_the_term_list( $post->ID, 'company_location', 'Locations > ', ' &bull; ', ' '); ?>
            </div>
            <div class="projects">
              <?php echo get_the_term_list( $post->ID, 'projects', '<strong>Projects: </strong>', ', ', ' '); ?>
            </div>
            
          </div>
        </li>
      </a>


    <?php endwhile; endif; ?>
    </ul>
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

