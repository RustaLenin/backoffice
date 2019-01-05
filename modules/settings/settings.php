<?php

Class THEME_SETTINGS {

	public static $settings = array(
		'logo_url'           => 'url',
		'header_background'  => 'url',
		'header_title'       => 'string',
		'use_site_title'     => 'bool'
	);

	public static $types = array(
		'bool'    => FILTER_VALIDATE_BOOLEAN,
		'string'  => FILTER_SANITIZE_STRING,
		'int'     => FILTER_VALIDATE_INT,
		'url'     => FILTER_SANITIZE_URL,
		'array'   => FILTER_UNSAFE_RAW,
		'img_url' => FILTER_SANITIZE_URL,
		'hex'     => FILTER_SANITIZE_STRING
	);

	public static $settings_name = 'theme_settings';

	public static function return_default_settings() {

		$default_settings = array(

		);

		return $default_settings;

	}

	public static function register() {

		register_setting( self::$settings_name, self::$settings_name, '' );

		$settings_list = self::$settings;

		foreach ( $settings_list as $setting => $type) {
			add_settings_field( $setting, '', '', '', '' );
		};

	}

	public static function default_settings() {

		$answer = null;
		$options = get_option( self::$settings_name );

		if ( !$options || empty( $options ) ) {
			$answer = self::update( self::return_default_settings() );
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

	public static function force_default_settings( $settings_data ) {

		$answer = null;
		if ( !$settings_data ) {
			$answer = array(
				'result'  => 'error',
				'message' => 'No settings_data received',
				'source'  => __METHOD__
			);
		} else {
			$update_result = update_option( self::$settings_name, self::return_default_settings() );
			if ( !$update_result ) {
				$answer = array(
					'result'  => 'error',
					'message' => 'Failed to force defaults',
					'source'  => __METHOD__
				);
			} else {
				$answer = array(
					'result'   => 'success',
					'message'  => 'Settings set to defaults',
					'source'   => __METHOD__,
					'settings' => self::return_default_settings()
				);
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

	public static function sanitize( $raw_data ) {

		$sanitize_data = array();

		$settings_list = self::$settings;
		$types = self::$types;

		foreach ( $settings_list as $setting => $type ) {
			if( isset( $raw_data[$setting] ) ) {

				if ( $type == 'array' ) {
					$sanitize_data[$setting] = $raw_data[$setting];
				} else {
					$sanitize_data[$setting] = filter_var( $raw_data[$setting], $types[$type] );
				}

			}
		};

		return $sanitize_data;
	}

	public static function update( $new_data ) {

		$answer = null;

		if ( !$new_data ) {
			$answer = array(
				'result'  => 'error',
				'message' => 'No data received',
				'source'  => __METHOD__
			);
		} else {
			if ( !is_array( $new_data ) ) {
				$answer = array(
					'result'  => 'error',
					'message' => 'Received data is not array',
					'source'  => __METHOD__
				);
			} else {

				$sanitize_data = self::sanitize( $new_data );

				if ( !$sanitize_data ) {
					$answer = array(
						'result'  => 'error',
						'message' => 'Sanitaze failed',
						'source'  => __METHOD__,
						'dump'    => array(
							'new_data' => $new_data,
							'sanitaze_data' => $sanitize_data
						)
					);
				} else {

					$options = get_option( self::$settings_name );
					if ( !$options ) {
						$options = array();
					}

					$updated_data = array_merge( $options, $sanitize_data );
					$update_result = update_option(self::$settings_name, $updated_data );

					if ( !$update_result ) {
						$answer = array(
							'result'  => 'error',
							'message' => 'Update Failed',
							'source'  => __METHOD__,
							'dump'    => array(
								'new_data' => $new_data,
								'sanitaze_data' => $sanitize_data,
								'updated_data' => $updated_data,
								'update_result' => $update_result
							)
						);
					} else {
						$answer = array(
							'result'  => 'success',
							'message' => 'Update successfully complete',
							'source'  => __METHOD__,
							'dump'    => array(
								'new_data' => $new_data,
								'sanitaze_data' => $sanitize_data,
								'updated_data' => $updated_data,
								'update_result' => $update_result
							)
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

add_action( 'admin_init', array ( 'THEME_SETTINGS', 'register' ) );

add_action('wp_ajax_theme_settings', array( 'THEME_SETTINGS', 'ajax_handler' ) );
add_action('wp_ajax_nopriv_theme_settings', array( 'THEME_SETTINGS', 'ajax_handler' ) );