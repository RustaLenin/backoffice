<?php

Class UserRequest extends NiceCustomPost {

    static $post_name = 'Заявка';
    static $post_type = 'request';

    static $model = [
        'post_title' => [
            'name'          => 'post_title',
            'data_type'     => 'text',
            'required'      => false,
            'in_form'       => true,
            'field_type'    => 'regular',
            'validation'    => 'isNotEmpty',
            'placeholder'   => 'Заявка на DayOff',
            'label'         => 'Заголовок',
            'is_basic'      => true
        ],
        'post_content' => [
            'name'          => 'post_content',
            'data_type'     => 'text',
            'required'      => false,
            'in_form'       => true,
            'field_type'    => 'regular',
            'validation'    => 'isNotEmpty',
            'placeholder'   => 'Нужно съездить по семейным делам, буду на связи в Slack',
            'label'         => 'Описание',
            'is_basic'      => true
        ],
        'date_from' => [
            'name'          => 'date_from',
            'data_type'     => 'date',
            'required'      => false,
            'in_form'       => true,
            'field_type'    => 'regular',
            'validation'    => 'isDate',
            'placeholder'   => '01.01.2019',
            'label'         => 'C',
            'error_message' => 'Укажите корректную дату',
            'is_basic'      => false
        ],
        'date_to' => [
            'name'          => 'date_to',
            'data_type'     => 'date',
            'required'      => false,
            'in_form'       => true,
            'field_type'    => 'regular',
            'validation'    => 'isDate',
            'placeholder'   => '01.01.2020',
            'label'         => 'До',
            'error_message' => 'Укажите корректную дату',
            'is_basic'      => false
        ],
        'employer' => [
            'name'          => 'employer',
            'data_type'     => 'int',
            'required'      => false,
            'in_form'       => false,
        ],
        'boss' => [
            'name'          => 'boss',
            'data_type'     => 'int',
            'required'      => false,
            'in_form'       => false,
        ],
        'approve' => [
            'name'          => 'approve',
            'data_type'     => 'int',
            'required'      => false,
            'in_form'       => false,
        ],
        'request_type' => [
            'name'          => 'request_type',
            'data_type'     => 'string',
            'required'      => true,
            'in_form'       => true,
            'field_type'    => 'single_check',
            'validation'    => false,
            'placeholder'   => '',
            'label'         => 'Выберите тип заявки',
            'is_basic'      => false,
            'selections'    => [
                [
                    'name'       => 'dayoff',
                    'text'      => 'Заявка на DayOff',
                    'default'    => false,
                    'permission' => 'all',
                    'icon'       => false,
                    'color'      => false
                ],
                [
                    'name'       => 'sick',
                    'text'      => 'Заявка на больничный',
                    'default'    => false,
                    'permission' => 'all',
                    'icon'       => false,
                    'color'      => false
                ],
                [
                    'name'       => 'vacation',
                    'text'      => 'Заявка на отпуск',
                    'default'    => false,
                    'permission' => 'all',
                    'icon'       => false,
                    'color'      => false
                ]
            ]
        ],
        'request_status' => [
            'name'          => 'request_status',
            'data_type'     => 'string',
            'required'      => true,
            'in_form'       => true,
            'field_type'    => 'single_check',
            'validation'    => false,
            'placeholder'   => '',
            'label'         => 'Выберите статус заявки',
            'is_basic'      => false,
            'selections'    => [
                [
                    'name'       => 'wait_approve',
                    'text'      => 'Ожидает подтверждения',
                    'default'    => false,
                    'permission' => 'all',
                    'icon'       => false,
                    'color'      => false
                ],
                [
                    'name'       => 'in_progress',
                    'text'      => 'В работе',
                    'default'    => false,
                    'permission' => 'all',
                    'icon'       => false
                ],
                [
                    'name'       => 'declined',
                    'text'      => 'Отклонена',
                    'default'    => false,
                    'permission' => 'all',
                    'icon'       => false
                ],
                [
                    'name'       => 'completed',
                    'text'      => 'Выполнена',
                    'default'    => false,
                    'permission' => 'all',
                    'icon'       => false
                ]
            ]
        ],
        'documents' => [
            'name'          => 'documents',
            'data_type'     => 'array',
            'required'      => false,
            'in_form'       => false,
        ],
    ];

    public static function add( $post_data ) {

        $answer = self::$default_answer;

        if( !$post_data ) {                                      //Checking we received any data
            $answer['message'] = 'post_data is not received';
        } else {
            if ( $post_data['ID'] ) {                            //Checking is it existing post need to updating
                $answer = self::update( $post_data );            // If so - update existing
            } else {

                foreach ( self::$model as $field => $args ) {    // Check all required field received
                    if ( $args['required'] ) {
                        if ( !$post_data[$field] ) {
                            $answer['message'] = 'Field ' .  $field . ' is required';
                            return $answer;
                        }
                    }
                }

                if ( !$post_data['post_type'] )   { $post_data['post_type']   = self::$post_type; }
                if ( !$post_data['post_status'] ) { $post_data['post_status'] = self::$def_post_status; }

                $ID = wp_insert_post( $post_data, true ); // Insert post in database return id or error

                if ( is_wp_error( $ID ) ) {
                    $answer['message'] = $ID->get_error_message();
                } else {

                    $failed_to_update = [];                            // Creating empty array to collect not updated fields
                    $updated_success = [];
                    foreach ( $post_data as $field => $value ) {
                        if ( self::$model[$field] ) {                       // Checking field is in model
                            if ( !self::$model[$field]['is_basic'] ) {      // Is not basic, update it in db
                                $update_result = update_post_meta( $ID, $field, $value );
                                if ( !$update_result ) {                    // Id update failed store it
                                    $failed_update[$field] = $value;
                                } else {
                                    $updated_success[$field] = $update_result;
                                }
                            }
                        }
                    }

                    $answer = [
                        'result'  => 'success',
                        'message' => self::$post_name . ' was added',
                        'source'  => __METHOD__,
                        'payload' => [
                            'ID'               => $ID,
                            'service_data'     => $post_data,
                            'failed_to_update' => $failed_to_update,
                            'updated_success'  => $updated_success,
                        ]
                    ];
                }
            }
        }

        return $answer;
    }

    public static function update( $post_data ) {

        $answer = self::$default_answer;

        if( !$post_data ) { //Checking we received any data
            $answer['message'] = 'post_data is not received';
        } else {
            if ( !$post_data['ID'] ) {
                $answer['message'] = 'No ID received which to update';
            } else {

                $ID = wp_update_post( $post_data );                         // Return same ID if success or 0 if false
                if ( $ID != $post_data['ID'] ) {                            // That's why it looks so strange
                    $answer['message'] = 'Failed to update';
                } else {

                    $failed_to_update = [];                            // Creating empty array to collect not updated fields'
                    $updated_success = [];
                    foreach ( $post_data as $field => $value ) {
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

                    $answer = [
                        'result'  => 'success',
                        'message' => 'Service was updated',
                        'source'  => __METHOD__,
                        'payload' => [
                            'ID'               => $ID,
                            'post_data'        => $post_data,
                            'failed_to_update' => $failed_to_update,
                            'updated_success'  => $updated_success,
                        ]
                    ];

                }

            }
        }

        return $answer;

    }

    public static function get_data ( $post_data ) {

        $answer = self::$default_answer;

        if( !$post_data ) {
            $answer['message'] = 'post_data is not received';
        } else {
            if ( !$post_data['ID'] ) {
                $answer['message'] = 'No ID received to get a post';
            } else {

                $service = get_post( $post_data['ID'] );
                if ( !$service ) {
                    $answer['message'] = 'Failed to get service with such ID';
                } else {

                    $payload = array();
                    foreach ( self::$model as $key => $data ) {
                        $payload[$key] = $service->$key;
                    }
                    $payload['ID'] = $post_data['ID'];

                    $answer = array(
                        'result'  => 'success',
                        'message' => 'Here you go',
                        'source'  => __METHOD__,
                        'payload' => $payload
                    );

                }

            }
        }

        return $answer;

    }

    public static function get_model( $post_data ) {

        $answer = self::$default_answer;

        if( !$post_data ) {
            $answer['message'] = 'post_data is not received';
        } else {

            $answer = array(
                'result'  => 'success',
                'message' => 'Here you go',
                'source'  => __METHOD__,
                'payload' => self::$model
            );

        }

        return $answer;

    }

    public static function ajax_handler() {

        $answer = self::$default_answer;

        if ( !$_POST ) {
            $answer['message'] = 'No request received';
        } else {
            if ( !$_POST['command'] ) {
                $answer['message'] = 'No command received';
            } else {
                if ( !$_POST['payload'] ) {
                    $answer['message'] = 'No payload received';
                } else {

                    if ( method_exists( __CLASS__, $_POST['command'] ) ) {
                        $command = $_POST['command'];
                        $answer = self::$command( $_POST['payload'] );
                    } else {
                        $answer['message'] = 'Unknown command ¯\_(ツ)_/¯';
                    }

                }
            }
        }

        echo json_encode( $answer );
        wp_die();

    }

}

add_action( 'wp_ajax_user_request', array( 'UserRequest', 'ajax_handler') );