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
}