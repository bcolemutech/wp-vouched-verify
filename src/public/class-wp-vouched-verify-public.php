<?php /** @noinspection PhpIllegalPsrClassPathInspection */
/** @noinspection SpellCheckingInspection */
/** @noinspection PhpMissingFieldTypeInspection */

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/bcolemutech
 * @since      1.0.0
 *
 * @package    Wp_Vouched_Verify
 * @subpackage Wp_Vouched_Verify/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_Vouched_Verify
 * @subpackage Wp_Vouched_Verify/public
 * @author     Brian Cole <https://github.com/bcolemutech>
 */
class Wp_Vouched_Verify_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    private $wp_wrapper;
	private $url;
	private $api_key;

	/**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of the plugin.
     * @param string $version The version of this plugin.
     * @param wp_wrapper_interface $wp_wrapper
     * @since    1.0.0
     */
    public function __construct(string $plugin_name, string $version, wp_wrapper_interface $wp_wrapper)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

        $this->wp_wrapper = $wp_wrapper;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Wp_Vouched_Verify_Loader as all the hooks are defined
         * in that particular class.
         *
         * The Wp_Vouched_Verify_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wp-vouched-verify-public.css', array(), $this->version);

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Wp_Vouched_Verify_Loader as all the hooks are defined
         * in that particular class.
         *
         * The Wp_Vouched_Verify_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/wp-vouched-verify-public.js', array('jquery'), $this->version);

    }

    /**
     * Intercept user registration, send Vouched invite using email address. Save return invite ID to user meta.
     *
     * @param int $user_id User's ID
     * @throws Requests_Exception_HTTP
     * @throws Exception
     */
    public function handle_user_register(int $user_id)
    {
	    $this->LoadSettings();

        error_log("User ID: " . $user_id, 4);
        error_log("User Email: " . $_POST['email'], 4);

	    $inviteID = $this->SendInvite();

        error_log("POST succeeded invite ID: " . $inviteID, 4);

        $this->wp_wrapper->add_user_meta($user_id, 'inviteID', $inviteID, true);
    }

	/**
	 * Use WP_User to get Invite from Vouched. Then validates user is unique.
	 * Sets user access based on Invote status. Will send new Invite if ID not found.
	 * Will bypass Invite checks if user has higher privleges.
	 *
	 * @param string $username
	 * @param WP_User $user
	 */
	public function handle_wp_login(string $username, WP_User $user)
    {
	    $this->LoadSettings();

	    $inviteId = $this->wp_wrapper->get_user_meta($user->ID, "inviteID");

        error_log("Retrived Invite " . $inviteId . " for user " . $user->ID, 4);
    }

	private function LoadSettings() {
		$options       = $this->wp_wrapper->get_option( 'vouched_options' );
		$this->url     = $options['url'] . '/api/invites';
		$this->api_key = $options['api_key'];

		if ( $this->url == null || trim( $this->url ) == "" ) {
			throw new InvalidArgumentException( "Vouched URL is not set" );
		}

		if ( $this->api_key == null || trim( $this->api_key ) == "" ) {
			throw new InvalidArgumentException( "Vouched private key not set" );
		}
	}

	/**
	 * Send Invite request to Vouched using given email
	 *
	 * @return mixed
	 * @throws Requests_Exception_HTTP
	 * @throws Exception
	 */
	public function SendInvite() {
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

		error_log( "Sending POST to " . $this->url, 4 );

		$response     = $this->wp_wrapper->wp_remote_post( $this->url, $args );
		$http_code    = $this->wp_wrapper->wp_remote_retrieve_response_code( $response );
		$responseBody = $this->wp_wrapper->wp_remote_retrieve_body( $response );

		if ( $http_code >= 400 ) {
			error_log( "POST failed with code " . $http_code . " content: " . $responseBody, 4 );
			throw new Requests_Exception_HTTP( "Received " . $http_code . " from " . $this->url );
		}

		error_log( "Invite response: " . $responseBody, 4 );

		$responseJson = json_decode( $responseBody );

		$inviteID = $responseJson->{'invite'}->{'id'};

		if ($inviteID == null) {
			throw new Exception("Did not receive an Invite ID");
		}

		return $inviteID;
	}
}
