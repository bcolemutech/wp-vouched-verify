<?php

use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__) . '/../vendor/autoload.php';
require_once dirname(__FILE__) . '/../wordpress/wp-includes/class-wp-user.php';
require_once dirname(__FILE__) . '/../src/public/class-wp-vouched-verify-public.php';
require_once dirname(__FILE__) . '/../src/services/wp_wrapper_interface.php';

class LoginTest extends TestCase
{

    public function testUserLoginShouldCheckForInviteId()
    {
	    $stub = $this->getWpStub('completed');
	    $stub->expects($this->once())->method('get_user_meta');

        $pluginPublic = new Wp_Vouched_Verify_Public('Wp_Vouched_Verify', '1.0.0', $stub);

        $user = $this->createStub(WP_User::class);

        $user->user_email = 'john@test.com';
		$user->ID = 1;

        $pluginPublic->handle_wp_login('John', $user);

    }

	public function testUserLoginShouldGetStatusOfInviteFromApi()
	{

		$stub = $this->getWpStub('completed');
		$stub->expects($this->once())->method('get_user_meta');
		$stub->expects($this->once())->method('wp_remote_get')->with('test.com/api/invites/?id=123');

		$pluginPublic = new Wp_Vouched_Verify_Public('Wp_Vouched_Verify', '1.0.0', $stub);

		$user = $this->createStub(WP_User::class);

		$user->user_email = 'john@test.com';
		$user->ID = 1;

		$pluginPublic->handle_wp_login('John', $user);
	}

	public function testGivenInviteIsNotCompletedStoreMessage()
	{
		$stub = $this->getWpStub('accepted');
		$stub->expects($this->once())->method('get_user_meta');
		$stub->expects($this->once())
		     ->method('wp_remote_get')
		     ->with('test.com/api/invites/?id=123');
		$stub->expects($this->once())
		     ->method('add_user_meta')
		     ->with(1,'vouched-message', 'Vouched verification is not complete', false);

		$pluginPublic = new Wp_Vouched_Verify_Public('Wp_Vouched_Verify', '1.0.0', $stub);

		$user = $this->createStub(WP_User::class);

		$user->user_email = 'john@test.com';
		$user->ID = 1;

		$pluginPublic->handle_wp_login('John', $user);
	}

	/**
	 * @return mixed|\PHPUnit\Framework\MockObject\MockObject|wp_wrapper_interface
	 */
	public function getWpStub(string $inviteStatus) {
		$stub = $this->getMockBuilder( wp_wrapper_interface::class )->getMock();
		$stub->method( 'get_option' )->willReturn( array( 'url' => 'test.com', 'api_key' => 'abcd1234' ) );

		$stub->method( 'get_user_meta' )->willReturn( '123' );
		$stub->method( 'wp_remote_retrieve_body' )
		     ->willReturn( "{\"invite\":[{\"id\":\"123\",\"status\":\"" . $inviteStatus . "\"}]}" );

		return $stub;
	}
}