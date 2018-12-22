<?php

Class THEME_USER {

    public static function sign_up( $user_data ) {

        $answer = null;

        if ( !$user_data) {
            $answer = array(
                'result'  => 'error',
                'message' => 'No user_data received',
                'source'  => __METHOD__
            );
        } else {
            if ( !$user_data['user_email'] ) {
                $answer = array(
                    'result'  => 'error',
                    'message' => 'No user_email received',
                    'source'  => __METHOD__
                );
            } else {
                if ( !$user_data['user_login'] ) {
                    $answer = array(
                        'result'  => 'error',
                        'message' => 'No user_login received',
                        'source'  => __METHOD__
                    );
                } else {

                    $user_id = wp_insert_user( $user_data );

                    if( is_wp_error( $user_id ) ) {
                        $answer = array(
                            'result'    => 'error',
                            'message'   => $user_id->get_error_message(),
                            'source'    => __METHOD__,
                            'dump'      => $user_id,
                            'user_data' => $user_data
                        );
                    } else {

                        if ( $user_data['user_password'] ) {
                            $user_password = $user_data['user_password'];
                        } else {
                            $user_password = wp_generate_password(18, true, false);
                            $user_data['user_password'] = $user_password;
                        }

                        wp_set_password( $user_password, $user_id );

                        do_action('after_user_register', $user_data );

                        $answer = array(
                            'result'  => 'success',
                            'message' => 'Registration Complete',
                            'source'  => __METHOD__,
                            'user_id' => $user_id,
                            'dump' => array(
                                'user_data' => $user_data,
                            )
                        );

                    }
                }
            }
        }

        if ( !$answer) {
            $answer = array(
                'result'  => 'error',
                'message' => 'Nothing happens ¯\_(ツ)_/¯',
                'source'  => __METHOD__
            );
        }
        return $answer;
    }

    public static function sign_in( $user_data ) {

        $answer = null;

        if ( !$user_data) {
            $answer = array(
                'result'  => 'error',
                'message' => 'No user_data received',
                'source'  => __METHOD__
            );
        } else {
            if ( !$user_data['user_login'] ) {
                $answer = array(
                    'result'  => 'error',
                    'message' => 'No user_login received',
                    'source'  => __METHOD__
                );
            } else {
                if ( !$user_data['user_password'] ) {
                    $answer = array(
                        'result'  => 'error',
                        'message' => 'No user_password received',
                        'source'  => __METHOD__
                    );
                } else {

                    $user_obj = wp_signon( $user_data );
                    if ( is_wp_error( $user_obj ) ) {
                        $answer = array(
                            'result'        => 'error',
                            'message'       => 'Incorrect login or password',
                            'source'        => __METHOD__,
                            'error_message' => $user_obj->get_error_message(),
                            'dump'          => array(
                                'user_obj'  => $user_obj,
                                'user_data' => $user_data
                            )
                        );
                    } else {
                        $answer = array(
                            'result'  => 'success',
                            'message' => 'Logged in, redirecting',
                            'source'  => __METHOD__,
                            'dump'    => $user_obj
                        );
                    }
                }
            }
        }

        if ( !$answer) {
            $answer = array(
                'result'  => 'error',
                'message' => 'Nothing happens ¯\_(ツ)_/¯',
                'source'  => __METHOD__
            );
        }
        return $answer;
    }

    public static function log_out() {
        wp_logout();

        return array(
            'result'  => 'success',
            'message' => 'you was logout'
        );
    }

    public static function delete( $user_data ) {

        $answer = null;

        if ( !$user_data ) {
            $answer = array(
                'result'  => 'error',
                'message' => 'No user_data received',
                'source'  => __METHOD__
            );
        } else {
            if ( !$user_data['ID'] ) {
                $answer = array(
                    'result'  => 'error',
                    'message' => 'No user ID received',
                    'source'  => __METHOD__
                );
            } else {
                $delete_result = wp_delete_user( $user_data['ID'], 1 );

                if ( !$delete_result ) {
                    $answer = array(
                        'result'  => 'error',
                        'message' => 'Failed to delete this user',
                        'source'  => __METHOD__,
                        'dump'    => array(
                            'user_data' => $user_data
                        )
                    );
                } else {

                    $answer = array(
                        'result'  => 'success',
                        'message' => 'User successfully deleted',
                        'source'  => __METHOD__,
                        'dump'    => array(
                            'user_data' => $user_data
                        )
                    );

                }
            }
        }

        if ( !$answer) {
            $answer = array(
                'result'  => 'error',
                'message' => 'Nothing happens ¯\_(ツ)_/¯',
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

add_action( 'wp_ajax_nopriv_theme_user', array( 'THEME_USER', 'ajax_handler') );
add_action( 'wp_ajax_theme_user', array( 'THEME_USER', 'ajax_handler') );