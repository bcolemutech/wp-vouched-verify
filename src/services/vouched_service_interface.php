<?php

interface vouched_service_interface {
	/**
	 * Get Vouched invite based on ID from API
	 *
	 * @param string $inviteId
	 *
	 * @return mixed
	 * @throws Requests_Exception_HTTP
	 * @throws Exception
	 */
	public function get_invite( string $inviteId );

	/**
	 * Send Invite request to Vouched using given email
	 *
	 * @return mixed
	 * @throws Requests_Exception_HTTP
	 * @throws Exception
	 */
	public function send_invite();
}