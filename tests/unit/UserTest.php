<?php


class UserTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }
    
    
    
    protected function _after()
    {
    }

    // tests
    public function testValidation() {
        $user = \app\models\SignupForm::create();
        
        $user->username = null;
        $this->assertFalse($user->validate(['username']));
        
        $user->username = 'davertin';
        $this->assertTrue($user->validate(['username']));
    }
}