<?php

class vouched_service implements vouched_service_interface {

	/**
	 * @var string
	 */
	private $api_key;
	/**
	 * @var string
	 */
	private $url;
	/**
	 * @var wp_wrapper_interface
	 */
	private $wp_wrapper;

	public function __construct( wp_wrapper_interface $wrapper) {
		$this->wp_wrapper = $wrapper;
		$this->LoadSettings();
	}

	private function LoadSettings() {
		$options       = $this->wp_wrapper->get_option( 'vouched_options' );
		$this->url     = $options['url'] . '/api';
		$this->api_key = $options['api_key'];

		if ( $this->url == null || trim( $this->url ) == "" ) {
			throw new InvalidArgumentException( "Vouched URL is not set" );
		}

		if ( $this->api_key == null || trim( $this->api_key ) == "" ) {
			throw new InvalidArgumentException( "Vouched private key not set" );
		}
	}

	/**
	 * Get Vouched invite based on ID from API
	 *
	 * @param string $inviteId
	 *
	 * @return mixed
	 * @throws Requests_Exception_HTTP
	 * @throws Exception
	 */
	public function get_invite( string $inviteId ) {
		$args = array(
			'timeout'     => '5',
			'redirection' => '5',
			'httpversion' => '1.0',
			'blocking'    => true,
			'headers'     => array(
				'X-API-Key'    => $this->api_key,
				'content-type' => 'application/json'
			),
			'cookies'     => array(),
		);

		$url = $this->url . '/invites/?id=' . $inviteId;

		$response = $this->wp_wrapper->wp_remote_get( $url, $args );

		$http_code    = $this->wp_wrapper->wp_remote_retrieve_response_code( $response );
		$responseBody = $response['body'];

		if ( $http_code >= 400 ) {
			error_log( "GET failed with code " . $http_code . " content: " . $responseBody, 4 );
			throw new Requests_Exception_HTTP( "Received " . $http_code . " from " . $url );
		}

		error_log( "Invite response: " . $responseBody, 4 );

		$responseJson = json_decode( $responseBody );

		$invite = $responseJson->{'invite'}[0];

		if ( $invite == null ) {
			throw new Exception( "No Invite found for ID " . $inviteId );
		}

		return $invite;
	}

	/**
	 * Send Invite request to Vouched using given email
	 *
	 * @return string
	 * @throws Requests_Exception_HTTP
	 * @throws Exception
	 */
	public function send_invite(): string {
		$body = array(
			'email'   => $_POST['email'],
			'contact' => "email"
		);

		$jsonBody = json_encode( $body );

		$args = array(
			'body'        => $jsonBody,
			'timeout'     => '5',
			'redirection' => '5',
			'httpversion' => '1.0',
			'blocking'    => true,
			'headers'     => array(
				'X-API-Key'    => $this->api_key,
				'content-type' => 'application/json'
			),
			'cookies'     => array(),
		);

		$url = $this->url . '/invites';

		error_log( "Sending POST to " . $url, 4 );

		$response     = $this->wp_wrapper->wp_remote_post( $url, $args );
		$http_code    = $this->wp_wrapper->wp_remote_retrieve_response_code( $response );
		$responseBody = wp_remote_retrieve_body( $response );

		if ( $http_code >= 400 ) {
			error_log( "POST failed with code " . $http_code . " content: " . $responseBody, 4 );
			throw new Requests_Exception_HTTP( "Received " . $http_code . " from " . $url );
		}

		error_log( "Invite response: " . $responseBody, 4 );

		$responseJson = json_decode( $responseBody );

		$inviteID = $responseJson->{'invite'}->{'id'};

		if ( $inviteID == null ) {
			throw new Exception( "Did not receive an Invite ID" );
		}

		return $inviteID;
	}

    /**
     * @throws Requests_Exception_HTTP
     * @throws Exception
     */
    public function get_job(string $jobId ) {
		$args = array(
			'timeout'     => '5',
			'redirection' => '5',
			'httpversion' => '1.0',
			'blocking'    => true,
			'headers'     => array(
				'X-API-Key'    => $this->api_key,
				'content-type' => 'application/json'
			),
			'cookies'     => array(),
		);

		$url = $this->url . '/jobs/?id=' . $jobId;

        $response = $this->wp_wrapper->wp_remote_get( $url, $args );

        $http_code    = $this->wp_wrapper->wp_remote_retrieve_response_code( $response );
        $responseBody = $response['body'];

        if ( $http_code >= 400 ) {
            error_log( "GET failed with code " . $http_code . " content: " . $responseBody, 4 );
            throw new Requests_Exception_HTTP( "Received " . $http_code . " from " . $url );
        }

        error_log( "Job response: " . $responseBody, 4 );

        $responseJson = json_decode( $responseBody );

        $job = $responseJson->{'items'}[0];

        if ( $job == null ) {
            throw new Exception( "No Job found for ID " . $jobId );
        }

        return $job;
	}
}