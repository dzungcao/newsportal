<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GuestTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Home page should show news highlight
     *
     * @return void
     */
    public function testVisitHomePage()
    {
        $this->visit('/')
             ->see('HIGHLIGHT');
    }

    public function testVisitLogin()
    {
        $this->visit('/login')
             ->see('Login');
    }
    public function testVisitRegister()
    {
        $this->visit('/register')
             ->see('Register');
    }
    public function testRegisterNewAccountSuccessfully(){
        $this->visit('/register')
         ->type('Taylor', 'name')
         ->type('abc@example.com', 'email')
         ->press('Signup')
         ->seePageIs('/news');
    }
    public function testRegisterInvalidEmail(){
        $this->visit('/register')
         ->type('Taylor', 'name')
         ->type('abc@example', 'email')
         ->press('Signup')
         ->see('The email must be a valid email address.');
    }
    public function testRegisterWithDuplicatedAccount(){
        $this->visit('/register')
         ->type('Taylor 1', 'name')
         ->type('abc@example.com', 'email')
         ->press('Signup')
         ->seePageIs('/news')->visit('/logout');
        $this->visit('/register')
         ->type('Taylor 2', 'name')
         ->type('abc@example.com', 'email')
         ->press('Signup')
         ->see('The email has already been taken.');
    }
    public function testRegisterWithoutName(){
        $this->visit('/register')
         ->type('', 'name')
         ->type('abc@example.com', 'email')
         ->press('Signup')
         ->see('The name must not be empty.');

        $this->visit('/register')
         ->type('abc@example.com', 'email')
         ->press('Signup')
         ->see('The name must not be empty.');
    }
}
