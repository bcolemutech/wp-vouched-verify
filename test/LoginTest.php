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
    public function testGivenUserHasCompletedAndPassedVerificationWhenIdMatchesMetaThenSetHigherRole()
    {
        $stub = $this->getWpStub('completed', 'completed');
        $stub->expects($this->once())->method('get_user_meta');

        $vouched = $this->getVouchedStub('completed', 'completed', true, '01/01/9999');
        $vouched->expects($this->once())->method('get_invite')->with(123);
        $vouched->expects($this->once())->method('get_job')->with(5);

        $stub->expects($this->never())
            ->method('add_user_meta');

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
        $stub = $this->getWpStub('accepted', 'active');
        $stub->expects($this->once())->method('get_user_meta');
        $stub->expects($this->any())
            ->method('wp_remote_get')
            ->with('test.com/api/invites/?id=123');
        $stub->expects($this->once())
            ->method('add_user_meta')
            ->with(1, 'vouched-message', 'Vouched verification is not complete: Invite accepted', false);

        $vouched = $this->getVouchedStub('accepted', 'active', false, '01/01/9999');

        $pluginPublic = new Wp_Vouched_Verify_Public('Wp_Vouched_Verify', '1.0.0', $stub, $vouched);

        $user = $this->createStub(WP_User::class);

        $user->user_email = 'john@test.com';
        $user->ID = 1;

        $pluginPublic->handle_wp_login('John', $user);
    }

    /**
     * @throws Requests_Exception_HTTP
     */
    public function testGivenInviteIsCompletedWhenJobIsNotThenStoreMessage()
    {
        $stub = $this->getWpStub('completed', 'active');
        $stub->expects($this->once())->method('get_user_meta');
        $stub->expects($this->any())
            ->method('wp_remote_get')
            ->with('test.com/api/invites/?id=123');
        $stub->expects($this->once())
            ->method('add_user_meta')
            ->with(1, 'vouched-message', 'Vouched verification is not complete: Job active', false);

        $vouched = $this->getVouchedStub('completed', 'active', false, '01/01/9999');

        $pluginPublic = new Wp_Vouched_Verify_Public('Wp_Vouched_Verify', '1.0.0', $stub, $vouched);

        $user = $this->createStub(WP_User::class);

        $user->user_email = 'john@test.com';
        $user->ID = 1;

        $pluginPublic->handle_wp_login('John', $user);
    }

    /**
     * @throws Requests_Exception_HTTP
     */
    public function testGivenInviteIsCompletedAndJobIsCompletedWhenReviewSuccessIsFalseThenStoreMessage()
    {
        $stub = $this->getWpStub('completed', 'completed');
        $stub->expects($this->any())
            ->method('wp_remote_get')
            ->with('test.com/api/invites/?id=123');
        $stub->expects($this->once())
            ->method('add_user_meta')
            ->with(1, 'vouched-message', 'Verification review did not pass. See Invite for details test.com/invite/123', false);

        $vouched = $this->getVouchedStub('completed', 'completed', false, '01/01/9999');

        $pluginPublic = new Wp_Vouched_Verify_Public('Wp_Vouched_Verify', '1.0.0', $stub, $vouched);

        $user = $this->createStub(WP_User::class);

        $user->user_email = 'john@test.com';
        $user->ID = 1;

        $pluginPublic->handle_wp_login('John', $user);
    }

    /**
     * @return mixed|MockObject|wp_wrapper_interface
     */
    public function getWpStub(bool $hasMeta)
    {
        $stub = $this->getMockBuilder(wp_wrapper_interface::class)->getMock();
        $stub->method('get_option')->willReturn(array('url' => 'test.com', 'api_key' => 'abcd1234'));

        $stub->method('get_user_meta')->with(1,'inviteID')->willReturn('123');
        if ($hasMeta) {
            $stub->method('get_user_meta')->with(1, 'vouched_country')->willReturn('US');
            $stub->method('get_user_meta')->with(1, 'vouched_state')->willReturn('IA');
            $stub->method('get_user_meta')->with(1, 'vouched_id')->willReturn('1234567890');
        }

        return $stub;
    }

    private function getVouchedStub(string $inviteStatus, string $jobStatus, bool $reviewSuccess, string $expireDate)
    {
        $stub = $this->getMockBuilder(vouched_service_interface::class)->getMock();
        $stub->method('get_invite')->with('123')
            ->willReturn((object)array('status' => $inviteStatus, 'jobId' => '5', 'url' => 'test.com/invite/123'));
        $stub->method('get_job')->with('5')
            ->willReturn((object)array(
                'status' => $jobStatus,
                'reviewSuccess' => $reviewSuccess,
                'result' => (object) array(
                    'state' => 'IA',
                    'country' => 'US',
                    'id' => '1234567890',
                    'expireDate' => $expireDate
                )
            ));
        return $stub;
    }
}