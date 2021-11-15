<?php

class user_service implements user_service_interface
{
    /**
     * @var wp_wrapper_interface
     */
    private $wp_wrapper;

    /**
     * @param wp_wrapper_interface $wrapper
     */
    public function __construct(wp_wrapper_interface $wrapper)
    {
        $this->wp_wrapper = $wrapper;
    }

    /**
     * @param int $user_id
     * @param string $inviteID
     */
    public function set_invite_id(int $user_id, string $inviteID)
    {
        $this->wp_wrapper->add_user_meta($user_id, 'inviteID', $inviteID, true);
    }

    /**
     * @param int $user_id
     * @return string
     */
    public function get_invite_id(int $user_id): string
    {
        return $this->wp_wrapper->get_user_meta($user_id, "inviteID");
    }

    /**
     * @param int $user_id
     * @return string
     */
    public function get_country(int $user_id): string
    {
        return $this->wp_wrapper->get_user_meta($user_id, "vouched_country");
    }

    /**
     * @param int $user_id
     * @return string
     */
    public function get_state(int $user_id): string
    {
        return $this->wp_wrapper->get_user_meta($user_id, "vouched_state");
    }

    /**
     * @param int $user_id
     * @return string
     */
    public function get_id_number(int $user_id): string
    {
        return $this->wp_wrapper->get_user_meta($user_id, "vouched_id");
    }

    /**
     * @param int $user_id
     * @param string $country
     */
    public function set_country(int $user_id, string $country)
    {
        $this->wp_wrapper->add_user_meta($user_id, 'vouched_country', $country, false);
    }

    /**
     * @param int $user_id
     * @param string $state
     */
    public function set_state(int $user_id, string $state)
    {
        $this->wp_wrapper->add_user_meta($user_id, 'vouched_state', $state, false);
    }

    /**
     * @param int $user_id
     * @param string $id
     */
    public function set_id_number(int $user_id, string $id)
    {
        $this->wp_wrapper->add_user_meta($user_id, 'vouched_id', $id, false);
    }

    /**
     * @param WP_User $user
     * @param bool $verified
     */
    public function set_role_verified(WP_User $user, bool $verified)
    {
        if ($verified) {
            $user->set_role('verified');
        } else {
            $user->set_role('customer');
        }
    }

    /**
     * @param int $user_id
     * @param string $message
     */
    public function set_vouched_message(int $user_id, string $message)
    {
        $this->wp_wrapper->add_user_meta($user_id, 'vouched-message', $message, false);
    }

    public function unique_check(string $country, string $state, string $id): bool
    {


        $args = array(
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key'     => 'vouched_country',
                    'value'   => $country,
                    'compare' => '='
                ),
                array(
                    'key'     => 'vouched_state',
                    'value'   => $state,
                    'compare' => '='
                ),
                array(
                    'key'     => 'vouched_id',
                    'value'   => $id,
                    'compare' => '='
                )
            )
        );

        $results = $this->wp_wrapper->query_users_with_meta_query($args);

        $count = count($results);

        return $count == 0;
    }
}