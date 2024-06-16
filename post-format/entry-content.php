<?php 
if ( is_single() ) {
    the_content( 
        sprintf( 
            __( 'Continue reading%s', 'kitolms' ), 
            '<span class="screen-reader-text">'.get_the_title().'</span>' 
        ) 
    );
} else {
    if ( get_theme_mod( 'blog_intro_en', true ) ) { 
        if ( get_theme_mod( 'blog_post_text_limit', 110 ) ) {
            echo wp_kses_post(kitolms_excerpt_max_charlength(get_theme_mod( 'blog_post_text_limit', 110 )));
        } else {
            the_content( 
                sprintf( 
                    __( 'Continue reading%s', 'kitolms' ), 
                    '<span>'.get_the_title().'</span>' 
                ) 
            );
        }
    }
}
