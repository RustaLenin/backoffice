<?php

Class BO_SERVICES {

    static $post_type = 'service';
    static $def_post_status = 'publish';

    static $model = array(
        'post_title' => array(
            'name'          => 'post_title',
            'data_type'     => 'text',
            'required'      => true,
            'in_form'       => true,
            'field_type'    => 'regular',
            'validation'    => 'isNotEmpty',
            'placeholder'   => 'Gmail',
            'label'         => 'Service title',
            'is_basic'      => true
        ),
        'cost' => array(
            'name'          => 'cost',
            'data_type'     => 'int',
            'required'      => false,
            'in_form'       => true,
            'field_type'    => 'regular',
            'validation'    => 'isInt',
            'placeholder'   => '100500',
            'label'         => 'How much it cost',
            'error_message' => 'Only numerals',
            'is_basic'      => false
        ),
        'deadline' => array(
            'name'          => 'deadline',
            'data_type'     => 'date',
            'required'      => false,
            'in_form'       => true,
            'field_type'    => 'vanilla',
            'field_class'   => 'DatePicker',
            'icon'          => 'calendar',
            'validation'    => 'isDate',
            'placeholder'   => '10.12.1993',
            'label'         => 'Date deadline',
            'error_message' => 'Need valid data',
            'is_basic'      => false
        ),
        'url' => array(
            'name'          => 'url',
            'data_type'     => 'url',
            'required'      => false,
            'in_form'       => true,
            'field_type'    => 'regular',
            'icon'          => 'link',
            'validation'    => 'isUrl',
            'placeholder'   => 'http://example.com/',
            'label'         => 'Service url',
            'error_message' => 'Need valid url',
            'is_basic'      => false
        ),
        'icon' => array(
            'name'          => 'icon',
            'data_type'     => 'url',
            'required'      => false,
            'in_form'       => true,
            'field_type'    => 'media',
            'validation'    => 'isImgUrl',
            'placeholder'   => 'image.jpg',
            'label'         => 'Icon image',
            'error_message' => 'Need a valid icon',
            'is_basic'      => false
        ),
        'currency' => array(
            'name'      => 'currency',
            'data_type'     => 'currency',
            'required'      => false,
            'in_form'       => true,
            'field_type'    => 'regular',
            'validation'    => 'isCurrency',
            'placeholder'   => 'USD',
            'label'         => 'Currency',
            'error_message' => 'Enter a valid currency',
            'is_basic'      => false
        ),
        'active' => array(
            'name'          => 'active',
            'data_type'     => 'bool',
            'required'      => false,
            'in_form'       => false,
            'field_type'    => 'checkbox',
            'validation'    => 'url',
            'placeholder'   => 'http://example.com/',
            'label'         => 'Service url',
            'error_message' => 'Need valid url',
            'is_basic'      => false
        ),
        'projects' => array(
            'name'          => 'projects',
            'data_type'     => 'array',
            'required'      => false,
            'in_form'       => false,
            'is_basic'      => false
        ),
        'users' => array(
            'name'          => 'users',
            'data_type'     => 'array',
            'required'      => false,
            'in_form'       => false,
            'is_basic'      => false
        ),
        'departments' => array(
            'name'          => 'departments',
            'data_type'     => 'array',
            'required'      => false,
            'in_form'       => false,
            'is_basic'      => false
        )
    );

    public static function register() {

        if ( post_type_exists( self::$post_type ) ) {
            // do_nothing
        } else {
            register_post_type( self::$post_type, array(
                'label'               => null,
                'labels'              => array(
                    'name'               => 'Service',
                    'singular_name'      => 'Service',
                    'add_new'            => 'Add Service',
                    'add_new_item'       => 'Adding new Service',
                    'edit_item'          => 'Edit Service',
                    'new_item'           => 'New Service',
                    'view_item'          => 'View Service',
                    'search_items'       => 'Search Services',
                    'not_found'          => 'Service Not Found',
                    'not_found_in_trash' => 'No one Services in trash',
                    'parent_item_colon'  => '',
                    'menu_name'          => 'Service',
                ),
                'description'         => 'Requests for money operation, like deposit or withdraw', // Custom post type description
                'public'              => true, // define may we work with this type publicy
                'publicly_queryable'  => true, // if false, theme query will not work with this type
                'exclude_from_search' => true, // if true, this post type will be exclude from query
                'show_ui'             => false, // if false, this post type will exclude from user interfase
                'show_in_menu'        => false, // if false, this post type will exclude from user menu
                'show_in_admin_bar'   => false, // if false, this post type will exclude from admin bar
                'show_in_nav_menus'   => false, // if false, this post type will exclude from nav menus
                'show_in_rest'        => true, // add to WP REST API. From WP 4.7
                'rest_base'           => self::$post_type, 	// $post_type. From WP 4.7
                'menu_position'       => 33, 3,
                'menu_icon'           => null,
                //'capability_type'   => 'post',
                //'capabilities'      => 'post', // array of user capabilities to interact with post type массив
                //'map_meta_cap'      => null, // If true standart capabilities handler will be used
                'hierarchical'        => false, // Doese this post type will have hierarch (like pages) or haven't (like posts)
                'supports'            => array( 'title', 'excerpt', 'fields', 'comments', 'custom-fields', 'editor' ),
                // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
                'taxonomies'          => array( 'category', 'post_tag' ),
                'has_archive'         => true,
                'rewrite'             => true,
                'query_var'           => true,
            ) );

        }
    }

    public static function add( $service_data ) {

        $answer = null;

        if( !$service_data ) { //Checking we received any data
            $answer = array(
                'result'  => 'error',
                'message' => 'service_data is not received',
                'source'  => __METHOD__
            );
        } else {
            if ( $service_data['ID'] ) {                         //Checking is it existing post need to updating
                $answer = self::update( $service_data );         // If so - update existing
            } else {

                foreach ( self::$model as $field => $args ) {    // Check all required field received
                    if ( $args['required'] ) {
                        if ( !$service_data[$field] ) {
                            return $answer = array(
                                'result'  => 'error',
                                'message' =>  'Field ' .  $field . ' is required',
                                'source'  => __METHOD__
                            );
                        }
                    }
                }

                if ( !$service_data['post_type'] )   { $service_data['post_type']   = self::$post_type; }
                if ( !$service_data['post_status'] ) { $service_data['post_status'] = self::$def_post_status; }

                $ID = wp_insert_post( $service_data, true ); // Insert post in database return id or error

                if ( is_wp_error( $ID ) ) {
                    $answer = array(
                        'result'  => 'error',
                        'message' => $ID->get_error_message(),
                        'source'  => __METHOD__
                    );
                } else {

                    $failed_to_update = array();                            // Creating empty array to collect not updated fields
                    foreach ( $service_data as $field => $value ) {
                        if ( self::$model[$field] ) {                       // Checking field is in model
                            if ( !self::$model[$field]['is_basic'] ) {      // Is not basic, update it in db
                                $update_result = update_post_meta( $ID, $field, $value );
                                if ( !$update_result ) {                    // Id update failed store it
                                    $failed_update[$field] = $value;
                                }
                            }
                        }
                    }

                    $post = get_post( $ID );
                    ob_start();
                    include('templates/service_row.php');
                    $html = ob_get_clean();

                    $answer = array(
                        'result'  => 'success',
                        'message' => 'Service was added',
                        'source'  => __METHOD__,
                        'payload' => array(
                            'ID'               => $ID,
                            'service_data'     => $service_data,
                            'failed_to_update' => $failed_to_update,
                            'html'             => $html
                        )
                    );
                }
            }
        }

        if ( !$answer ) {
            $answer = array(
                'result'  => 'error',
                'message' => 'Nothing Happens ¯\_(ツ)_/¯',
                'source'  => __METHOD__
            );
        }
        return $answer;
    }

    public static function update( $service_data ) {

        $answer = null;

        if( !$service_data ) { //Checking we received any data
            $answer = array(
                'result'  => 'error',
                'message' => 'service_data is not received',
                'source'  => __METHOD__
            );
        } else {
            if ( !$service_data['ID'] ) {
                $answer = array(
                    'result'  => 'error',
                    'message' => 'No ID received which to update',
                    'source'  => __METHOD__
                );
            } else {

                $ID = wp_update_post( $service_data );    // Return same ID if success or 0 if false
                if ( $ID != $service_data['ID'] ) {       // That's why it looks so strange
                    $answer = array(
                        'result'  => 'error',
                        'message' => 'Failed to update',
                        'source'  => __METHOD__
                    );
                } else {

                    $failed_to_update = array();                            // Creating empty array to collect not updated fields'
                    $updated_success = array();
                    foreach ( $service_data as $field => $value ) {
                        if ( self::$model[$field] ) {                       // Checking field is in model
                            if ( !self::$model[$field]['is_basic'] ) {      // Is not basic, update it in db
                                $update_result = update_post_meta( $ID, $field, $value );
                                if ( !$update_result ) {                    // Id update failed store it
                                    $failed_update[$field] = $update_result;
                                } else {
                                    $updated_success[$field] = $update_result;
                                }
                            }
                        }
                    }

                    $post = get_post( $ID );
                    ob_start();
                    include('templates/service_row.php');
                    $html = ob_get_clean();

                    $answer = array(
                        'result'  => 'success',
                        'message' => 'Service was updated',
                        'source'  => __METHOD__,
                        'payload' => array(
                            'ID'               => $ID,
                            'service_data'     => $service_data,
                            'failed_to_update' => $failed_to_update,
                            'updated_success'  => $updated_success,
                            'html'             => $html
                        )
                    );

                }

            }
        }

        return $answer;

    }

    public static function get_data ( $service_data ) {

        $answer = null;
        if( !$service_data ) {
            $answer = array(
                'result'  => 'error',
                'message' => 'service_data is not received',
                'source'  => __METHOD__
            );
        } else {
            if ( !$service_data['ID'] ) {
                $answer = array(
                    'result' => 'error',
                    'message' => 'No ID received to get a post',
                    'source' => __METHOD__
                );
            } else {

                $service = get_post( $service_data['ID'] );
                if ( !$service ) {
                    $answer = array(
                        'result' => 'error',
                        'message' => 'Failed to get service with such ID',
                        'source' => __METHOD__
                    );
                } else {

                    $payload = array();
                    foreach ( self::$model as $key => $data ) {
                        $payload[$key] = $service->$key;
                    }
                    $payload['ID'] = $service_data['ID'];

                    $answer = array(
                        'result'  => 'success',
                        'message' => 'Here you go',
                        'source'  => __METHOD__,
                        'payload' => $payload
                    );

                }

            }
        }

        if ( !$answer ) {
            $answer = array(
                'result'  => 'error',
                'message' => 'Nothing Happens ¯\_(ツ)_/¯',
                'source'  => __METHOD__
            );
        }
        return $answer;

    }

    public static function ajax_handler() {

        $answer = null;

        if ( !$_POST ) {
            $answer = array(
                'result'  => 'error',
                'message' => 'No request received',
                'source'  => __METHOD__
            );
        } else {
            if ( !$_POST['command'] ) {
                $answer = array(
                    'result'  => 'error',
                    'message' => 'No command received',
                    'source'  => __METHOD__
                );
            } else {
                if ( !$_POST['payload'] ) {
                    $answer = array(
                        'result'  => 'error',
                        'message' => 'No payload received',
                        'source'  => __METHOD__
                    );
                } else {

                    if ( method_exists( __CLASS__, $_POST['command'] ) ) {
                        $command = $_POST['command'];
                        $answer = self::$command( $_POST['payload'] );
                    } else {
                        $answer = array(
                            'result'  => 'error',
                            'message' => 'Unknown command ¯\_(ツ)_/¯',
                            'source'  => __METHOD__
                        );
                    }

                }
            }
        }

        if ( !$answer ) {
            $answer = array(
                'result'  => 'error',
                'message' => 'Nothing Happens ¯\_(ツ)_/¯',
                'source'  => __METHOD__
            );
        }
        echo json_encode( $answer );
        wp_die();

    }
}

add_action( 'wp_ajax_nopriv_bo_services', array( 'BO_SERVICES', 'ajax_handler') );
add_action( 'wp_ajax_bo_services', array( 'BO_SERVICES', 'ajax_handler') );