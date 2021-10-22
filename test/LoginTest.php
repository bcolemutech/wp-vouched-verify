<?php

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__) . '/../vendor/autoload.php';
require_once dirname(__FILE__) . '/../wordpress/wp-includes/class-wp-user.php';
require_once dirname(__FILE__) . '/../src/public/class-wp-vouched-verify-public.php';
require_once dirname(__FILE__) . '/../src/services/wp_wrapper_interface.php';
require_once dirname(__FILE__) . '/../src/services/vouched_service_interface.php';

class LoginTest extends TestCase
{
	/**
	 * @throws Requests_Exception_HTTP
	 */
	public function testUserLoginShouldGetStatusOfInviteFromApi_HappyPath()
	{
		$stub = $this->getWpStub('completed', 'completed');
		$stub->expects($this->once())->method('get_user_meta');

		$vouched = $this->getVouchedStub();
		$vouched->expects($this->once())->method('get_invite')->with(123);
		$vouched->expects($this->once())->method('get_job')->with(5);

		$pluginPublic = new Wp_Vouched_Verify_Public('Wp_Vouched_Verify', '1.0.0', $stub, $vouched);

		$user = $this->createStub(WP_User::class);

		$user->user_email = 'john@test.com';
		$user->ID = 1;

		$pluginPublic->handle_wp_login('John', $user);
	}

	/**
	 * @throws Requests_Exception_HTTP
	 */
	public function testGivenInviteIsNotCompletedStoreMessage()
	{
		$stub = $this->getWpStub('accepted','completed');
		$stub->expects($this->once())->method('get_user_meta');
		$stub->expects($this->any())
		     ->method('wp_remote_get')
		     ->with('test.com/api/invites/?id=123');
		$stub->expects($this->once())
		     ->method('add_user_meta')
		     ->with(1,'vouched-message', 'Vouched verification is not complete', false);

		$vouched = $this->getVouchedStub();

		$pluginPublic = new Wp_Vouched_Verify_Public('Wp_Vouched_Verify', '1.0.0', $stub, $vouched);

		$user = $this->createStub(WP_User::class);

		$user->user_email = 'john@test.com';
		$user->ID = 1;

		$pluginPublic->handle_wp_login('John', $user);
	}

	/**
	 * @return mixed|MockObject|wp_wrapper_interface
	 */
	public function getWpStub(string $inviteStatus, string $jobStatus) {
		$stub = $this->getMockBuilder( wp_wrapper_interface::class )->getMock();
		$stub->method( 'get_option' )->willReturn( array( 'url' => 'test.com', 'api_key' => 'abcd1234' ) );

		$stub->method( 'get_user_meta' )->willReturn( '123' );
		$stub->method( 'wp_remote_get' )->with('test.com/api/invites/?id=123')
		     ->willReturn( array('body' => "{\"invite\":[{\"id\":\"123\",\"jobId\":\"5\",\"status\":\"" . $inviteStatus . "\"}]}" ));

		$stub->method('wp_remote_get')->with('test.com/api/jobs/?id=5')
			->willReturn(array('body'=>"{\"items\":[{\"id\":\"5\",\"status\":\"".$jobStatus."\"}]}"));
		return $stub;
	}

	private function getVouchedStub() {
		$stub = $this->getMockBuilder(vouched_service_interface::class)->getMock();
		$stub->method('get_invite')->with('123')
			->willReturn('');
		return $stub;
	}
}