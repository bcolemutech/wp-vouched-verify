<?php

class user_service implements user_service_interface
{
    /**
     * @var wp_wrapper_interface
     */
    private wp_wrapper_interface $wp_wrapper;

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
}