<?php

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__) . '/../src/public/class-wp-vouched-verify-public.php';
require_once dirname(__FILE__) . '/../src/services/wp_wrapper_interface.php';

class RegisterTest extends TestCase
{
    public function testUserRegisterShouldSaveInviteId()
    {
        $stub = $this->getWpStub();

        $vouched = $this->getVouchedStub();

        $stub
            ->expects($this->once())
            ->method('add_user_meta')
            ->with(
                $this->equalTo(1),
                $this->equalTo('inviteID'),
                $this->equalTo('123'),
                $this->equalTo(true)
            );

        $pluginPublic = new Wp_Vouched_Verify_Public('Wp_Vouched_Verify', '1.0.0', $stub, $vouched);
        $_POST['email'] = "test";
        $pluginPublic->handle_user_register(1);
    }

    /**
     * @return mixed
     */
    private function getWpStub()
    {
        $stub = $this->getMockBuilder(wp_wrapper_interface::class)->getMock();

        $stub->method('get_option')->willReturn(array('url' => 'test.com', 'api_key' => 'abcd1234'));
        return $stub;
    }

    private function getVouchedStub() {
        $stub = $this->getMockBuilder(vouched_service_interface::class)->getMock();
        $stub->method('send_invite')
            ->willReturn('123');
        return $stub;
    }
}
