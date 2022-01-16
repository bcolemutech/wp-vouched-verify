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

    /** @var vouched_service */
    private $vouched_service;

    /**
     * @var user_service_interface
     */
    private $user_service;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of the plugin.
     * @param string $version The version of this plugin.
     * @param vouched_service_interface $vouched_service
     * @param user_service_interface $user_service
     * @since    1.0.0
     */
    public function __construct(
        string                    $plugin_name,
        string                    $version,
        vouched_service_interface $vouched_service,
        user_service_interface    $user_service
    )
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

        $this->vouched_service = $vouched_service;
        $this->user_service = $user_service;
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
     *
     * @throws Requests_Exception_HTTP
     * @throws Exception
     */
    public function handle_user_register(int $user_id)
    {
        error_log("User ID: " . $user_id, 4);
        error_log("User Email: " . $_POST['email'], 4);

        $inviteID = $this->vouched_service->send_invite();

        error_log("POST succeeded invite ID: " . $inviteID, 4);

        $this->user_service->set_invite_id($user_id, $inviteID);
    }

    /**
     * Use WP_User to get Invite from Vouched. Then validates user is unique.
     * Sets user access based on Invote status. Will send new Invite if ID not found.
     * Will bypass Invite checks if user has higher privleges.
     *
     * @param string $username
     * @param WP_User $user
     *
     * @throws Requests_Exception_HTTP
     */
    public function handle_wp_login(string $username, WP_User $user)
    {
        error_log("Verifying User \"" . $username . "\"", 4);

        if(in_array('administrator', $user->roles)){
            error_log($username . " is an admin. Skipping verification.",4);

            return;
        }

        $inviteId = $this->user_service->get_invite_id($user->ID);

        error_log("Retrived Invite " . $inviteId . " for user " . $user->ID, 4);

        $invite = $this->vouched_service->get_invite($inviteId);

        error_log("Invite status: " . $invite->{'status'}, 4);

        if ($invite->{'status'} != 'completed') {
            $this->user_service->set_vouched_message($user->ID, 'Vouched verification is not complete: Invite ' . $invite->{'status'});

            $this->user_service->set_role_verified($user, false);

            return;
        }

        $job = $this->vouched_service->get_job($invite->{'jobId'});

        $success = $job->{'reviewSuccess'} ? 'true' : 'false';
        error_log("Job status: " . $job->{'status'} . ' | Review passed: ' . $success, 4);

        if ($job->{'status'} != 'completed') {
            $this->user_service->set_vouched_message($user->ID, 'Vouched verification is not complete: Job ' . $job->{'status'});

            $this->user_service->set_role_verified($user, false);

            return;
        }

        if ($job->{'reviewSuccess'} == false) {
            $this->user_service->set_vouched_message($user->ID, 'Verification review did not pass. See Invite for details ' . $invite->{'url'});

            $this->user_service->set_role_verified($user, false);

            return;
        }

        $country = $this->user_service->get_country($user->ID);
        $state = $this->user_service->get_state($user->ID);
        $id_number = $this->user_service->get_id_number($user->ID);

        if($job->{'result'}->{'country'} == $country && $job->{'result'}->{'state'} == $state && $job->{'result'}->{'id'} == $id_number)
        {
            $this->user_service->set_role_verified($user, true);

            return;
        }

        if($this->user_service->unique_check($job->{'result'}->{'country'}, $job->{'result'}->{'state'},$job->{'result'}->{'id'}))
        {
            $this->user_service->set_country($user->ID, $job->{'result'}->{'country'});
            $this->user_service->set_state($user->ID, $job->{'result'}->{'state'});
            $this->user_service->set_id_number($user->ID, $job->{'result'}->{'id'});

            $this->user_service->set_role_verified($user, true);
        }
        else
        {
            $this->user_service->set_vouched_message($user->ID, "User ".$user->ID."(".$username.") verified ID is not unique");

            $this->user_service->set_role_verified($user, false);
        }
    }
}
