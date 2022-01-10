<?php

    function curiosityhub_masonary_layout_fun(){
        $gallery_items = get_posts( array(
            'post_type' => 'sk_gallerry'
        ) );
        $masonary_item = '<div class="curiosityhub-masonary-layout-gallery">';

        foreach($gallery_items  as $item){
           $masonary_item .= '<div class="curiosityhub masonary-item" > 
                                <div class="curiosityhub-item-image">
                                    <img class="curiosityhub-featured-image" src="'.get_the_post_thumbnail_url( $item->ID, 'medium' ).'" />
                                </div>
                                <div class="curiosityhub-item-excerpt">
                                    <a href="'.get_site_url().'/gallery/?curiosityhub_gallery_id='.$item->ID.'">
                                        <h3 class="curiosityhub-item-heading">'.$item->post_title.'</h3>
                                    </a>
                                    <p class="curiosityhub-expert-para">'.$item->post_excerpt.'</p>
                                </div>
                            </div>';
        }
        $masonary_item .= '</div>';

        // echo '<pre>';
        //     print_r($gallery_items);
        // echo '</pre>';
        return $masonary_item;
    }

    add_shortcode( 'curiosityhub_masonary_layout', 'curiosityhub_masonary_layout_fun' );



    function curiosityhub_gallery_detail_page(){
        if(isset($_GET['curiosityhub_gallery_id'])){
            $args = array(
                'post_type' => 'sk_gallerry',
                // 'post_status' => 'publish',
                'p' => $_GET['curiosityhub_gallery_id'],   // id of the post you want to query
            );
            $gallery_post = new WP_Query($args);  
        
            // $item_id = $_GET['curiosityhub_gallery_id'];
            // $gallery_item = get_post( $_GET['curiosityhub_gallery_id'] );

            if($gallery_post->have_posts()):
                while($gallery_post->have_posts()) : $gallery_post->the_post();
                $content = apply_filters( 'the_content', get_the_content() );
                $post_reply = '<div class="curiosityhub_custom_post">
                                <div class="curiosityhub-featured-image-section">
                                    <img src="'.get_the_post_thumbnail_url(  ).'" class="curiosityhub-featured-img">
                                </div>
                                <div class="curiosity-content-section">
                                    <h3 class="gallery-item-title">'.get_the_title(  ).'</h3>'
                                   .$content.
                                '</div>
                            </div>';
                endwhile;
                
            endif;
            
        }
        else{
            $post_reply = '<h3 style="text-align:center;color:red">Gallery item not found</h3>';
        }
        return $post_reply;
    }

    add_shortcode( 'curiosityhub_detailed_page', 'curiosityhub_gallery_detail_page' );