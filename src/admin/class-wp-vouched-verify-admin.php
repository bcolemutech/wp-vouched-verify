<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/bcolemutech
 * @since      1.0.0
 *
 * @package    Wp_Vouched_Verify
 * @subpackage Wp_Vouched_Verify/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Vouched_Verify
 * @subpackage Wp_Vouched_Verify/admin
 * @author     Brian Cole <https://github.com/bcolemutech>
 */
class Wp_Vouched_Verify_Admin
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
     * @param string $plugin_name The name of this plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct(string $plugin_name, string $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
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

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wp-vouched-verify-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
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

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/wp-vouched-verify-admin.js', array('jquery'), $this->version, false);

    }

    public function vouched_option_page()
    {
        add_options_page('Vouched Verify',
            'Vouched Verify Options',
            'manage_options',
            'vouched',
            array($this, 'vouched_options_page_html'));
    }

    function vouched_options_page_html()
    {
        if (!current_user_can('manage_options')) {
            return;
        }
        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <form action="options.php" method="post">
                <?php
                settings_fields('vouched_options');
                do_settings_sections('vouched');
                ?>
                <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e('Save'); ?>"/>
            </form>
        </div>
        <?php
    }

    public function vouched_settings()
    {
        register_setting('vouched_options', 'vouched_options', 'vouched_options_validate');
        add_settings_section('api_settings', 'API Settings', array($this, 'vouched_api_section_text'), 'vouched');

        add_settings_field('vouched_setting_api_key', 'API Key', array($this, 'vouched_setting_api_key'), 'vouched', 'api_settings');
        add_settings_field('vouched_setting_url', 'Vouched URL', array($this, 'vouched_setting_url'), 'vouched', 'api_settings');
    }

    public function vouched_options_validate($input): array
    {
        $newInput['api_key'] = trim($input['api_key']);
        if (!preg_match('/^[a-z0-9]{32}$/i', $newInput['api_key'])) {
            $newInput['api_key'] = '';
        }

        return $newInput;
    }

    public function vouched_api_section_text()
    {
        echo '<p>Here you can set all the options for using the Vouched API</p>';
    }

    function vouched_setting_api_key()
    {
        $options = get_option('vouched_options');
        echo "<input id='vouched_setting_api_key' name='vouched_options[api_key]' type='text' value='" . esc_attr($options['api_key']) . "' />";
    }

    function vouched_setting_url()
    {
        $options = get_option('vouched_options');
        echo "<input id='vouched_setting_url' name='vouched_options[url]' type='text' value='" . esc_attr($options['url']) . "' />";
    }
}
