<?php

interface user_service_interface
{
    /**
     * @param int $user_id
     * @param string $inviteID
     */
    public function set_invite_id(int $user_id, string $inviteID);

    /**
     * @param int $user_id
     * @return string
     */
    public function get_invite_id(int $user_id) : string;

    /**
     * @param int $user_id
     * @return string
     */
    public function get_country(int $user_id) : string;

    /**
     * @param int $user_id
     * @return string
     */
    public function get_state(int $user_id) : string;

    /**
     * @param int $user_id
     * @return string
     */
    public function get_id_number(int $user_id) : string;

    /**
     * @param int $user_id
     * @param string $country
     */
    public function set_country(int $user_id, string $country);

    /**
     * @param int $user_id
     * @param string $state
     */
    public function set_state(int $user_id, string $state);

    /**
     * @param int $user_id
     * @param string $id
     */
    public function set_id_number(int $user_id, string $id);
}