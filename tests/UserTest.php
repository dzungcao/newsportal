<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
class UserTest extends TestCase
{
	protected $user = null;
    /**
     * Test login successfully
     *
     * @return void
     */
    public function testLoginSuccessfully(){
    	$name = 'Dzung Cao';
    	$email = time().'@example.com';
    	$password = str_random(12);
    	$this->user = User::create(['name'=>$name,'email'=>$email,'password'=>bcrypt($password)]);
        $this->visit('/login')
         ->type($email, 'email')
         ->type($password, 'password')
         ->press('Login')
         ->seePageIs('/news');
    }

    /**
     * Test login failed with incorrect password
     *
     * @return void
     */
    public function testLoginWithIncorrectPassword(){
    	$name = 'Dzung Cao';
    	$email = time().'abc@example.com';
    	$password = str_random(12);
    	User::create(['name'=>$name,'email'=>$email,'password'=>bcrypt($password)]);
        $this->visit('/login')
         ->type($email, 'email')
         ->type($password.'123456', 'password')
         ->press('Login')
         ->see('These credentials do not match our records.');
    }

    /**
     * Create an article successfully
     *
     * @return void
     */
    public function testCreateAnArticleSuccessfully(){
        $user = factory(App\User::class)->create();

        //Create an article with full information
        $this->actingAs($user)
            ->visit('/news/create')
            ->type('A breaking news', 'title')
            ->type('News content', 'content')
            ->attach(public_path().'/images/home.png', 'picture')
            ->press('Save')
            ->seePageIs('/news');
    }
    /**
     * Create an article with missing data
     *
     * @return void
     */
    public function testCreateAnArticleWithMissingFields(){
        $user = factory(App\User::class)->create();

        //Missing title
        $this->actingAs($user)
            ->visit('/news/create')
            ->type('News content', 'content')
            ->press('Save')
            ->see('The title must not be empty');

        //Missing content
        $this->actingAs($user)
            ->visit('/news/create')
            ->type('News title', 'title')
            ->press('Save')
            ->see('The content must not be empty');

        //Invalid picture
        $this->actingAs($user)
            ->visit('/news/create')
            ->type('News title', 'title')
            ->type('News content', 'content')
            ->attach(public_path().'/images/test.txt', 'picture')
            ->press('Save')
            ->see('The picture must be a file of type: jpeg, jpg, png.');
    }
}
