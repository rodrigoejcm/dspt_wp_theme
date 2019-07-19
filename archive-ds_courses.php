<?php
get_header();

?>

<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>

    <div class='container template-blog '>

        <main class='content <?php avia_layout_class( ' content' ); ?> units' <?php avia_markup_helper(array('context' => 'content','post_type'=>'post'));?>>
            
            <?php   $count_posts = wp_count_posts('ds_courses');
                    $published_posts = $count_posts->publish;
            ?>

            <h2>Data Science in Portugal - Courses (<?php echo $published_posts; ?>) </h2>
            <br />
            <br />

            <div id="search-results">
                <div class="flex_column av_one_third  flex_column_div av-zero-column-padding first">
                    <div class="panel panel-warning">
                        <div class="panel-body">
                            <div class="search-filter">
                                <ul class="list-group">

                                    <li class="list-group-item">
                                        <div class="titleContainer">
                                            <h5 class="course_title list-group-item-heading">Course Title</h5>
                                            <input class="search form-control" placeholder="Search" />
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="locationContainer">
                                            <h5 class="list-group-item-heading">Location</h5>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="ctypeContainer">
                                            <h5 class="list-group-item-heading">Course Types</h5>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="topicContainer">
                                            <h5 class="list-group-item-heading">Course Topics</h5>
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

                                <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                                <?php $link =  rtrim(ltrim(get_post_meta( $post->ID,'website', True))); ?>
                                

                                <a style="z-index:1000;" class='teste1' href="<?php echo $link ?>"> 
                                <li class="listing clearfix">
                                    
                                        <div class="image_wrapper">
                                            <?php  if ( has_post_thumbnail() ) { ?>
                                                <img src="<?php the_post_thumbnail_url(); ?>" />
                                            <?php } ?>
                                        </div>
                                    
                                        <div class="info">
                                            <div class="course_type">
                                                <?php $terms = get_the_term_list( $post->ID, 'course_type', '', '|'); ?>
                                                <?php $terms = strip_tags( $terms ); ?>
                                                <div class="color-orange ctype"><?php echo $terms ; ?></div>
                                                <div class="hidden">
                                                    <?php echo $terms_string ; ?>
                                                </div>
                                            </div>
                                            <span class="course_title name">
                                                <?php the_title(); ?>
                                            </span>
                                            <div class="course_info">
                                               
                                                <span class="insti-location">
                                                    
                                                    <?php echo strip_tags(get_the_term_list( $post->ID, 'course_location', False, ' &bull; ', False)); ?>
                                                    
                                                </span>
                                                <span class="insti">
                                                    <?php echo get_post_meta( $post->ID,'institution', True); ?>
                                                </span>
                                                

                                                <?php $terms = get_the_term_list( $post->ID, 'course_location', '', '|'); ?>
                                                <?php $terms = trim(strip_tags( $terms )); ?>
                                                <div class="location hidden"><?php echo $terms ; ?></div>

                                            </div>

                                            <div class="projects">
                                                <?php $terms = get_the_term_list( $post->ID, 'course_topics', False, '|', False); ?>
                                                <?php $terms = strip_tags( $terms ); ?>
                                                <div>
                                                    <span class="color-orange"><?php echo $terms ; ?></span>
                                                </div>
                                                <div class="topic hidden"><?php echo $terms ; ?></div>
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
            <br />
            <hr />
            <!--end content-->
        </main>
        <?php

    //get the sidebar
    $avia_config['currently_viewing'] = 'blog';
    get_sidebar();

    ?>

    </div>
    <!--end container-->

</div><!-- close default .container_wrap element -->


<?php

get_footer();
?>