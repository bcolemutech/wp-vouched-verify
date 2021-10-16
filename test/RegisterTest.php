<?php

use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__) . '/../src/public/class-wp-vouched-verify-public.php';

class RegisterTest extends TestCase
{
    public function testUserRegisterShouldRun()
    {
        $this->markTestSkipped('Need to wrap and mock static WP methods');
        $pluginPublic = new Wp_Vouched_Verify_Public('Wp_Vouched_Verify', '1.0.0');
        $_POST['email'] = "test";

        $pluginPublic->handle_user_register(1);

        $this->assertTrue(true);
    }
}
