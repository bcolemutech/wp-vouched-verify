<?php

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

require_once dirname(__FILE__) . '/../vendor/autoload.php';
require_once dirname(__FILE__) . '/../wordpress/wp-includes/class-wp-user.php';
require_once dirname(__FILE__) . '/../src/services/wp_wrapper_interface.php';
require_once dirname(__FILE__) . '/../src/services/user_service_interface.php';
require_once dirname(__FILE__) . '/../src/services/user_service.php';

class UserServiceTest extends TestCase
{
    public function testSetInviteIdShouldSaveIdToUserMeta()
    {
        $stub = $this->getWpStub(false);
        $stub
            ->expects($this->once())
            ->method('add_user_meta')
            ->with(
                $this->equalTo(1),
                $this->equalTo('inviteID'),
                $this->equalTo('123'),
                $this->equalTo(true)
            );

        $sut = new user_service($stub);

        $sut->set_invite_id(1, '123');
    }

    public function testGetInviteIdShouldRetrieveIdFromUserMeta()
    {
        $stub = $this->getWpStub(false);
        $stub->expects($this->once())->method('get_user_meta')->with(1, 'inviteID');

        $sut = new user_service($stub);

        $sut->get_invite_id(1);
    }

    /**
     * @return mixed|MockObject|wp_wrapper_interface
     */
    public function getWpStub(bool $hasMeta)
    {
        $stub = $this->getMockBuilder(wp_wrapper_interface::class)->getMock();
        $stub->method('get_option')->willReturn(array('url' => 'test.com', 'api_key' => 'abcd1234'));

        $stub->method('get_user_meta')->with(1, 'inviteID')->willReturn('123');
        if ($hasMeta) {
            $stub->method('get_user_meta')->with(1, 'vouched_country')->willReturn('US');
            $stub->method('get_user_meta')->with(1, 'vouched_state')->willReturn('IA');
            $stub->method('get_user_meta')->with(1, 'vouched_id')->willReturn('1234567890');
        }

        return $stub;
    }
}