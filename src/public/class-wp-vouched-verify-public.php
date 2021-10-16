<?php

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

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of the plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct(string $plugin_name, string $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

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
     * Log user and user data when new user is registered
     *
     * @param int $user_id User's ID
     * @throws Requests_Exception_HTTP
     * @throws Exception
     */
    public function handle_user_register(int $user_id)
    {
        $options = get_option('vouched_options');
        $url = $options['url'] . '/api/invites';
        $key = $options['api_key'];

        if ($url == null || trim($url) == "") {
            throw new InvalidArgumentException("Vouched URL is not set");
        }

        if ($key == null || trim($key) == "") {
            throw new InvalidArgumentException("Vouched private key not set");
        }

        error_log("User ID: " . $user_id, 4);
        error_log("User Name: " . $_POST['login'], 4);
        error_log("User Email: " . $_POST['email'], 4);

        $body = array(
            'email' => $_POST['email'],
            'contact' => "email"
        );

        $jsonBody = json_encode($body);

        $args = array(
            'body' => $jsonBody,
            'timeout' => '5',
            'redirection' => '5',
            'httpversion' => '1.0',
            'blocking' => true,
            'headers' => array(
                'X-API-Key' => $key,
                'content-type' => 'application/json'
            ),
            'cookies' => array(),
        );

        error_log("Sending POST to " . $url, 4);

        $response = wp_remote_post($url, $args);
        $http_code = wp_remote_retrieve_response_code($response);
        $responseBody = wp_remote_retrieve_body($response);

        if ($http_code >= 400) {
            error_log("POST failed with code " . $http_code . " content: " . $responseBody, 4);
            throw new Requests_Exception_HTTP("Received " . $http_code . " from " . $url);
        }


        error_log("Invite response: " . $responseBody, 4);

        $responseJson = json_decode($responseBody);

        $inviteID = $responseJson->{'invite'}->{'id'};

        if ($inviteID == null) {
            throw new Exception("Did not receive an Invite ID");
        }

        error_log("POST succeeded invite ID: " . $inviteID, 4);

        add_user_meta($user_id, 'inviteID', $inviteID, true);
    }
}
