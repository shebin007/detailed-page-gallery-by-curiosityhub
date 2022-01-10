<?php
if ( ! function_exists('detailed_page_gallery_by_curiosityhub') ) {

    // Register Custom Post Type
    function detailed_page_gallery_by_curiosityhub() {
    
        $labels = array(
            'name'                  => _x( 'sk_galleries', 'Post Type General Name', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'singular_name'         => _x( 'sk_gallery', 'Post Type Singular Name', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'menu_name'             => __( 'Curiosity Gallery', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'name_admin_bar'        => __( 'Curiosity Gallery', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'archives'              => __( 'Item Archives', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'attributes'            => __( 'Item Attributes', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'parent_item_colon'     => __( 'Parent Item:', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'all_items'             => __( 'All Items', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'add_new_item'          => __( 'Add New Item', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'add_new'               => __( 'Add New', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'new_item'              => __( 'New Item', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'edit_item'             => __( 'Edit Item', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'update_item'           => __( 'Update Item', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'view_item'             => __( 'View Item', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'view_items'            => __( 'View Items', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'search_items'          => __( 'Search Item', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'not_found'             => __( 'Not found', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'featured_image'        => __( 'Featured Image', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'set_featured_image'    => __( 'Set featured image', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'remove_featured_image' => __( 'Remove featured image', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'use_featured_image'    => __( 'Use as featured image', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'insert_into_item'      => __( 'Insert into item', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'items_list'            => __( 'Items list', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'items_list_navigation' => __( 'Items list navigation', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'filter_items_list'     => __( 'Filter items list', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
        );
        $args = array(
            'label'                 => __( 'sk_gallery', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'description'           => __( 'detailed page gallery posts', 'detailed_page_gallery_by_curiosityhubtext_domain' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail' , 'excerpt' ),
            'taxonomies'            => array(  ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'           => 'dashicons-format-gallery',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
        );
        register_post_type( 'sk_gallerry', $args );
    
    }
    add_action( 'init', 'detailed_page_gallery_by_curiosityhub', 0 );
    
    }



    class Images {
        private $config = '{"title":"Images","prefix":"images_","domain":"images","class_name":"Images","post-type":["post"],"context":"normal","priority":"default","cpt":"sk_gallerry","fields":[{"type":"media","label":"Upload images","return":"url","id":"images_upload-images"}]}';
    
        public function __construct() {
            $this->config = json_decode( $this->config, true );
            $this->process_cpts();
            add_action( 'add_meta_boxes', [ $this, 'add_meta_boxes' ] );
            add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_scripts' ] );
            add_action( 'admin_head', [ $this, 'admin_head' ] );
            add_action( 'save_post', [ $this, 'save_post' ] );
        }
    
        public function process_cpts() {
            if ( !empty( $this->config['cpt'] ) ) {
                if ( empty( $this->config['post-type'] ) ) {
                    $this->config['post-type'] = [];
                }
                $parts = explode( ',', $this->config['cpt'] );
                $parts = array_map( 'trim', $parts );
                $this->config['post-type'] = array_merge( $this->config['post-type'], $parts );
            }
        }
    
        public function add_meta_boxes() {
            foreach ( $this->config['post-type'] as $screen ) {
                add_meta_box(
                    sanitize_title( $this->config['title'] ),
                    $this->config['title'],
                    [ $this, 'add_meta_box_callback' ],
                    $screen,
                    $this->config['context'],
                    $this->config['priority']
                );
            }
        }
    
        public function admin_enqueue_scripts() {
            global $typenow;
            if ( in_array( $typenow, $this->config['post-type'] ) ) {
                wp_enqueue_media();
            }
        }
    
        public function admin_head() {
            global $typenow;
            if ( in_array( $typenow, $this->config['post-type'] ) ) {
                ?><script>
                    jQuery.noConflict();
                    (function($) {
                        $(function() {
                            $('body').on('click', '.rwp-media-toggle', function(e) {
                                e.preventDefault();
                                let button = $(this);
                                let rwpMediaUploader = null;
                                rwpMediaUploader = wp.media({
                                    title: button.data('modal-title'),
                                    button: {
                                        text: button.data('modal-button')
                                    },
                                    multiple: true
                                }).on('select', function() {
                                    let attachment = rwpMediaUploader.state().get('selection').first().toJSON();
                                    button.prev().val(attachment[button.data('return')]);
                                }).open();
                            });
                        });
                    })(jQuery);
                </script><?php
            }
        }
    
        public function save_post( $post_id ) {
            foreach ( $this->config['fields'] as $field ) {
                switch ( $field['type'] ) {
                    default:
                        if ( isset( $_POST[ $field['id'] ] ) ) {
                            $sanitized = sanitize_text_field( $_POST[ $field['id'] ] );
                            update_post_meta( $post_id, $field['id'], $sanitized );
                        }
                }
            }
        }
    
        public function add_meta_box_callback() {
            $this->fields_table();
        }
    
        private function fields_table() {
            ?><table class="form-table" role="presentation">
                <tbody><?php
                    foreach ( $this->config['fields'] as $field ) {
                        ?><tr>
                            <th scope="row"><?php $this->label( $field ); ?></th>
                            <td><?php $this->field( $field ); ?></td>
                        </tr><?php
                    }
                ?></tbody>
            </table><?php
        }
    
        private function label( $field ) {
            switch ( $field['type'] ) {
                case 'media':
                    printf(
                        '<label class="" for="%s_button">%s</label>',
                        $field['id'], $field['label']
                    );
                    break;
                default:
                    printf(
                        '<label class="" for="%s">%s</label>',
                        $field['id'], $field['label']
                    );
            }
        }
    
        private function field( $field ) {
            switch ( $field['type'] ) {
                case 'media':
                    $this->input( $field );
                    $this->media_button( $field );
                    break;
                default:
                    $this->input( $field );
            }
        }
    
        private function input( $field ) {
            if ( $field['type'] === 'media' ) {
                $field['type'] = 'text';
            }
            printf(
                '<input class="regular-text %s" id="%s" name="%s" %s type="%s" value="%s">',
                isset( $field['class'] ) ? $field['class'] : '',
                $field['id'], $field['id'],
                isset( $field['pattern'] ) ? "pattern='{$field['pattern']}'" : '',
                $field['type'],
                $this->value( $field )
            );
        }
    
        private function media_button( $field ) {
            printf(
                ' <button class="button rwp-media-toggle" data-modal-button="%s" data-modal-title="%s" data-return="%s" id="%s_button" name="%s_button" type="button">%s</button>',
                isset( $field['modal-button'] ) ? $field['modal-button'] : __( 'Select this file', 'images' ),
                isset( $field['modal-title'] ) ? $field['modal-title'] : __( 'Choose a file', 'images' ),
                $field['return'],
                $field['id'], $field['id'],
                isset( $field['button-text'] ) ? $field['button-text'] : __( 'Upload', 'images' )
            );
        }
    
        private function value( $field ) {
            global $post;
            if ( metadata_exists( 'post', $post->ID, $field['id'] ) ) {
                $value = get_post_meta( $post->ID, $field['id'], true );
            } else if ( isset( $field['default'] ) ) {
                $value = $field['default'];
            } else {
                return '';
            }
            return str_replace( '\u0027', "'", $value );
        }
    
    }
    new Images;