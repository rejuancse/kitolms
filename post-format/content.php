<?php if( !is_single() ){ ?>
    <?php if ( has_post_thumbnail() ){ ?>
        <div class="blg_grid_thumb">
            <a class="skip-link" href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('kitolms-medium', array('class' => 'img-fluid')); ?>
            </a>
        </div>
    <?php } ?>
    <div class="blg_grid_caption">
        <?php if(get_theme_mod( 'blog_category', true )) : ?>
            <div class="blg_tag">
                <span>
                    <?php printf(esc_html__('%s', 'kitolms'), get_the_category_list(' ')); ?>
                </span>
            </div>
        <?php endif; ?>
        
        <div class="blg_title"><?php the_title( sprintf( '<h4 class="title"><a href="%s" class="skip-link">', esc_url( get_permalink() ) ), '</a></h4>' ); ?></div>

        <?php if(get_theme_mod( 'blog_intro_text_en', true )) : ?>
            <div class="blg_desc"><p>
                <?php get_template_part( 'post-format/entry-content' ); ?>
            </p></div>
        <?php endif; ?>
    </div>

    <div class="crs_grid_foot">
        <div class="crs_flex">
            <div class="crs_fl_first">
                <div class="crs_tutor">
                    <?php if(get_theme_mod( 'blog_author', true )) : ?>
                        <div class="crs_tutor_thumb">
                            <a href="<?php echo ' '.esc_url(get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>">
                                <img class="img-fluid circle" src="<?php echo esc_url( get_avatar_url( get_the_ID() ) ); ?>" />
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="crs_fl_last">
                <div class="foot_list_info">
                    <ul>
                        <?php if(get_theme_mod( 'blog_hit', true )) : ?>
                            <li>
                                <div class="elsio_ic"><i class="fa fa-eye text-success"></i></div>
                                <div class="elsio_tx">
                                    <?php echo getPostViews(get_the_ID()); ?>
                                </div>
                            </li>
                        <?php endif; ?>
                        <?php if(get_theme_mod( 'blog_date', true )) : ?>
                            <li>
                                <div class="elsio_ic">
                                    <i class="fa fa-clock text-warning"></i>
                                </div>
                                <div class="elsio_tx">
                                    <time datetime="<?php echo esc_html(get_the_date('d M, Y')); ?>"><?php echo esc_html(get_the_date('d M, Y')); ?></time>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>

    <?php setPostViews(get_the_ID()); ?>

    <div class="article_detail_wrapss single_article_wrap format-standard">
        <div class="article_body_wrap">
            <div class="article_featured_image">
                <?php if ( has_post_thumbnail() ){ ?>
                    <?php the_post_thumbnail('kitolms-large', array('class' => 'img-fluid')); ?>
                <?php } ?>
            </div>
            
            <div class="article_top_info">
                <ul class="article_middle_info">
                    <?php 
                    $enable_author = get_theme_mod('enable_author', true);
                    $enable_tags = get_theme_mod('enable_tags', true);
                    $enable_comments = get_theme_mod('enable_comments', true);
                    ?>
                    <?php if($enable_author) { ?>
                        <li>
                            <a href="#"><span class="icons"><i class="ti-user"></i></span>by <?php echo esc_html(get_the_author_meta('display_name')); ?></a>
                        </li>
                    <?php } ?>
                    <?php if($enable_tags) { ?>
                        <li>
                            <?php the_tags( '<div class="tags-in"><span class="icons"><i class="ti-tag"></i></span>', ', ', '</div>' ); ?>
                        </li>
                    <?php } ?>
                    <?php if($enable_comments) { ?>
                        <li>
                            <a href="#"><span class="icons"><i class="ti-comment-alt"></i></span><?php echo get_comments_number(get_the_ID()); ?> Comments</a>
                        </li>
                    <?php } ?>
                    
                </ul>
            </div>
            <?php the_title( sprintf( '<h2 class="post-title">', esc_url( get_permalink() ) ), '</h2>' ); ?>
            <?php get_template_part( 'post-format/entry-content' ); ?>
        </div>
    </div>

    <!-- Author Detail -->
    <?php 
    $author_details = get_theme_mod('enable_author_details', false);
    if($author_details == true) { ?>
        <div class="article_detail_wrapss single_article_wrap format-standard AA">
            <div class="article_posts_thumb">
                <span class="img"><img class="img-fluid" src="<?php echo esc_url( get_avatar_url( get_the_author_meta( 'ID' ) ) ); ?>" /></span>
                <h3 class="pa-name"><?php echo esc_html(get_the_author_meta('display_name')); ?></h3>
                <ul class="social-links">
                    <?php
                        $description = get_the_author_meta('description');
                        $facebook = get_the_author_meta('facebook');
                        $twitter = get_the_author_meta('twitter');
                        $linkedin = get_the_author_meta('linkedin');
                        $youtube = get_the_author_meta('youtube');
                        $dribbble = get_the_author_meta('dribbble');
                    ?>

                    <?php if(!empty($facebook)) : ?>
                        <li><a href="<?php echo esc_url($facebook); ?>"><i class="ti-facebook"></i></a></li>
                    <?php endif; ?>
                        
                    <?php if(!empty($twitter)) : ?>
                        <li><a href="<?php echo esc_url($twitter); ?>"><i class="ti-twitter"></i></a></li>
                    <?php endif; ?>
                            
                    <?php if(!empty($dribbble)) : ?>
                        <li><a href="<?php echo esc_url($dribbble); ?>"><i class="ti-dribbble"></i></a></li>
                    <?php endif; ?>

                    <?php if(!empty($youtube)) : ?>
                        <li><a href="<?php echo esc_url($youtube); ?>"><i class="ti-youtube"></i></a></li>
                    <?php endif; ?>

                    <?php if(!empty($linkedin)) : ?>
                        <li><a href="<?php echo esc_url($linkedin); ?>"><i class="ti-linkedin"></i></a></li>
                    <?php endif; ?>
                </ul>
                <?php if(!empty($description)) : ?>
                    <p class="pa-text">
                        <?php echo nl2br($description); ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    <?php } ?>

    <!-- Blog Comment -->
    <?php get_template_part( 'post-format/entry-content-blog' ); ?>
    
    
<?php } ?>
