<?php


use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__) . '/../vendor/autoload.php';
require_once dirname(__FILE__) . '/../src/public/class-wp-vouched-verify-public.php';
require_once dirname(__FILE__) . '/../src/services/wp_wrapper_interface.php';

class LoginTest extends TestCase
{
    public function testUserLoginShouldCheckForInviteId()
    {
        $stub = $this->getMockBuilder(wp_wrapper_interface::class)->getMock();
        $stub->method('get_option')->willReturn(array('url' => 'test.com', 'api_key' => 'abcd1234'));

        $stub->expects($this->once())->method('get_user_meta')->will($this->returnValue('123'));

        $pluginPublic = new Wp_Vouched_Verify_Public('Wp_Vouched_Verify', '1.0.0', $stub);

        $user = new WP_User(1,'John');

        $user->user_email = 'john@test.com';

        $pluginPublic->handle_wp_login('John', $user);

    }
}