<?php

use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__) . '/../src/public/class-wp-vouched-verify-public.php';
require_once dirname(__FILE__) . '/../src/services/wp_wrapper_interface.php';
require_once dirname(__FILE__) . '/../src/services/vouched_service_interface.php';
require_once dirname(__FILE__) . '/../src/services/user_service_interface.php';

class RegisterTest extends TestCase
{
    /**
     * @throws Requests_Exception_HTTP
     */
    public function testUserRegisterShouldSaveInviteId()
    {
        $stub = $this->getWpStub();

        $vouched = $this->getMockBuilder(vouched_service_interface::class)->getMock();

        $vouched->expects($this->once())->method('send_invite')->will($this->returnValue('123'));

        $userService = $this->getMockBuilder(user_service_interface::class)->getMock();

        $userService->expects($this->once())->method('set_invite_id')->with($this->equalTo(1), $this->equalTo('123'));

        $pluginPublic = new Wp_Vouched_Verify_Public('Wp_Vouched_Verify', '1.0.0', $stub, $vouched, $userService);
        $_POST['email'] = "test";
        $pluginPublic->handle_user_register(1);
    }


    private function getWpStub()
    {
        $stub = $this->getMockBuilder(wp_wrapper_interface::class)->getMock();

        $stub->method('get_option')->willReturn(array('url' => 'test.com', 'api_key' => 'abc1234'));
        return $stub;
    }
}
