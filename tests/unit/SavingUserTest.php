<?php


class SavingUserTest extends \Codeception\Test\Unit
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
    public function testSavingUser()
    {
        $user = new \app\models\SignupForm();
        $this->tester->haveRecord('app\models\User', ['username' => 'davert', 'password_hash' => 'lol']);
        
        $this->tester->seeRecord('app\models\User', ['username' => 'davert']);
    }
}