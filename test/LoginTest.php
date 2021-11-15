<?php

use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__) . '/../vendor/autoload.php';
require_once dirname(__FILE__) . '/../wordpress/wp-includes/class-wp-user.php';
require_once dirname(__FILE__) . '/../src/public/class-wp-vouched-verify-public.php';
require_once dirname(__FILE__) . '/../src/services/wp_wrapper_interface.php';
require_once dirname(__FILE__) . '/../src/services/vouched_service_interface.php';
require_once dirname(__FILE__) . '/../src/services/user_service_interface.php';

class LoginTest extends TestCase
{
    /**
     * @throws Requests_Exception_HTTP
     */
    public function testGivenUserHasCompletedAndPassedVerificationAndIsUniqueWhenIdMatchesMetaThenSetHigherRole()
    {
        $vouched = $this
            ->getVouchedStub('completed', 'completed', true, '01/01/9999');
        $vouched->expects($this->once())->method('get_invite')->with(123);
        $vouched->expects($this->once())->method('get_job')->with(5);

        $user = $this->createStub(WP_User::class);

        $user->user_email = 'john@test.com';
        $user->ID = 1;

        $userService = $this->getUserService(true);
        $userService->expects($this->once())->method('get_invite_id')->with(1);

        $userService
            ->expects($this->never())
            ->method('unique_check')
            ->with('US', 'IA', '1234567890')
            ->willReturn(true);

        $userService->expects($this->never())->method('set_country');
        $userService->expects($this->never())->method('set_state');
        $userService->expects($this->never())->method('set_id_number');

        $userService->expects($this->once())->method('set_role_verified')->with($user, true);

        $pluginPublic = new Wp_Vouched_Verify_Public('Wp_Vouched_Verify', '1.0.0', $vouched, $userService);

        $pluginPublic->handle_wp_login('John', $user);
    }

    /**
     * @throws Requests_Exception_HTTP
     */
    public function testGivenUserHasCompletedAndPassedVerificationWhenIdDoesNotMatchAndIsUniqueMetaThenStoreIdAndSetRole()
    {
        $vouched = $this
            ->getVouchedStub('completed', 'completed', true, '01/01/9999');
        $vouched->expects($this->once())->method('get_invite')->with(123);
        $vouched->expects($this->once())->method('get_job')->with(5);

        $user = $this->createStub(WP_User::class);

        $user->user_email = 'john@test.com';
        $user->ID = 1;

        $userService = $this->getUserService(false);
        $userService->expects($this->once())->method('get_invite_id')->with(1);
        $userService->expects($this->once())->method('get_country')->with(1);
        $userService->expects($this->once())->method('get_state')->with(1);
        $userService->expects($this->once())->method('get_id_number')->with(1);

        $userService
            ->expects($this->once())
            ->method('unique_check')
            ->with('US', 'IA', '1234567890')
            ->willReturn(true);

        $userService->expects($this->once())->method('set_country')->with(1, 'US');
        $userService->expects($this->once())->method('set_state')->with(1, 'IA');
        $userService->expects($this->once())->method('set_id_number')->with(1, '1234567890');

        $userService->expects($this->once())->method('set_role_verified')->with($user, true);

        $pluginPublic = new Wp_Vouched_Verify_Public('Wp_Vouched_Verify', '1.0.0', $vouched, $userService);

        $pluginPublic->handle_wp_login('John', $user);
    }

    /**
     * @throws Requests_Exception_HTTP
     */
    public function testGivenUserHasCompletedAndPassedVerificationWhenIdDoesNotMatchAndIsNotUniqueMetaThenStoreMessage()
    {
        $vouched = $this
            ->getVouchedStub('completed', 'completed', true, '01/01/9999');
        $vouched->expects($this->once())->method('get_invite')->with(123);
        $vouched->expects($this->once())->method('get_job')->with(5);

        $user = $this->createStub(WP_User::class);

        $user->user_email = 'john@test.com';
        $user->ID = 1;

        $userService = $this->getUserService(false);
        $userService->expects($this->once())->method('get_invite_id')->with(1);
        $userService->expects($this->once())->method('get_country')->with(1);
        $userService->expects($this->once())->method('get_state')->with(1);
        $userService->expects($this->once())->method('get_id_number')->with(1);

        $userService
            ->expects($this->once())
            ->method('unique_check')
            ->with('US', 'IA', '1234567890')
            ->willReturn(false);

        $userService
            ->expects($this->once())
            ->method('set_vouched_message')
            ->with(1, 'User 1(John) verified ID is not unique');

        $userService->expects($this->once())->method('set_role_verified')->with($user, false);

        $pluginPublic = new Wp_Vouched_Verify_Public('Wp_Vouched_Verify', '1.0.0', $vouched, $userService);

        $pluginPublic->handle_wp_login('John', $user);
    }

    /**
     * @throws Requests_Exception_HTTP
     */
    public function testGivenInviteIsNotCompletedStoreMessage()
    {
        $vouched = $this
            ->getVouchedStub('accepted', 'active', false, '01/01/9999');

        $user = $this->createStub(WP_User::class);

        $user->user_email = 'john@test.com';
        $user->ID = 1;

        $userService = $this->getUserService(false);

        $userService
            ->expects($this->once())
            ->method('set_vouched_message')
            ->with(1, 'Vouched verification is not complete: Invite accepted');

        $userService->expects($this->once())->method('set_role_verified')->with($user, false);

        $pluginPublic = new Wp_Vouched_Verify_Public('Wp_Vouched_Verify', '1.0.0', $vouched, $userService);

        $pluginPublic->handle_wp_login('John', $user);
    }

    /**
     * @throws Requests_Exception_HTTP
     */
    public function testGivenInviteIsCompletedWhenJobIsNotThenStoreMessage()
    {
        $vouched = $this
            ->getVouchedStub('completed', 'active', false, '01/01/9999');

        $user = $this->createStub(WP_User::class);

        $user->user_email = 'john@test.com';
        $user->ID = 1;

        $userService = $this->getUserService(false);

        $userService
            ->expects($this->once())
            ->method('set_vouched_message')
            ->with(1, 'Vouched verification is not complete: Job active');

        $userService->expects($this->once())->method('set_role_verified')->with($user, false);

        $pluginPublic = new Wp_Vouched_Verify_Public('Wp_Vouched_Verify', '1.0.0', $vouched, $userService);

        $pluginPublic->handle_wp_login('John', $user);
    }

    /**
     * @throws Requests_Exception_HTTP
     */
    public function testGivenInviteIsCompletedAndJobIsCompletedWhenReviewSuccessIsFalseThenStoreMessage()
    {
        $vouched = $this
            ->getVouchedStub('completed', 'completed', false, '01/01/9999');

        $userService = $this->getUserService(true);

        $user = $this->createStub(WP_User::class);
        $user->user_email = 'john@test.com';
        $user->ID = 1;

        $userService
            ->expects($this->once())
            ->method('set_vouched_message')
            ->with(1, 'Verification review did not pass. See Invite for details test.com/invite/123');

        $userService->expects($this->once())->method('set_role_verified')->with($user, false);

        $pluginPublic = new Wp_Vouched_Verify_Public('Wp_Vouched_Verify', '1.0.0', $vouched, $userService);

        $pluginPublic->handle_wp_login('John', $user);
    }

    public function getWpStub()
    {
        $stub = $this->getMockBuilder(wp_wrapper_interface::class)->getMock();
        $stub->method('get_option')->willReturn(array('url' => 'test.com', 'api_key' => 'abcd1234'));

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
                'result' => (object)array(
                    'state' => 'IA',
                    'country' => 'US',
                    'id' => '1234567890',
                    'expireDate' => $expireDate
                )
            ));
        return $stub;
    }

    public function getUserService(bool $hasVerifiedId)
    {
        $userService = $this->getMockBuilder(user_service_interface::class)->getMock();
        $userService->method('get_invite_id')->with(1)->willReturn('123');

        if ($hasVerifiedId) {
            $userService->method('get_country')->with(1)->willReturn('US'); //'vouched_country'
            $userService->method('get_state')->with(1)->willReturn('IA'); //'vouched_state'
            $userService->method('get_id_number')->with(1)->willReturn('1234567890'); //'vouched_id'
        }
        return $userService;
    }
}