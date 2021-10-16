<?php

use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__) . '/../src/public/class-wp-vouched-verify-public.php';
require_once dirname(__FILE__) . '/../src/services/wp_wrapper_interface.php';

class RegisterTest extends TestCase
{
    public function testUserRegisterShouldSaveInviteId()
    {
        $this->assertTrue(interface_exists('wp_wrapper_interface'));
        $stub = $this->getMockBuilder(wp_wrapper_interface::class)->getMock();

        $stub->method('get_option')->willReturn(array('url' => 'test.com', 'api_key' => 'abcd1234'));
        $stub->method('wp_remote_retrieve_response_code')->willReturn(200);

        $stub->method('wp_remote_retrieve_body')->willReturn("{\"invite\":{\"id\":\"123\"}}");

        $stub
            ->expects($this->once())
            ->method('add_user_meta')
            ->with(
                $this->equalTo(1),
                $this->equalTo('inviteID'),
                $this->equalTo('123'),
                $this->equalTo(true)
            );

        $pluginPublic = new Wp_Vouched_Verify_Public('Wp_Vouched_Verify', '1.0.0', $stub);
        $_POST['email'] = "test";

        $pluginPublic->handle_user_register(1);
    }
}
