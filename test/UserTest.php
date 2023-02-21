<?php
    //test/UserTest.php
    require __DIR__.'/../vendor/autoload.php';
    require __DIR__.'/../model/User.php';
    use PHPUnit\Framework\TestCase;

    class UserTest extends TestCase{
        public function testValidate(){
            $user = new User("a@gmail.com", "a", "b", "2000-12-12", "F", 162, "aB1@1111", null); 
            $errors = $user->validate();
            $this->assertEquals(0, count($errors));
           
        }

    public function testValidate2()
    {
        $user = new User("a@gail.com", "a", "b", "2000-12-12", "F", 162, "aB1@1111", null);
        $errors = $user->validate();
        $this->assertEquals(1, count($errors));
        $bool = array_key_exists('email', $errors);
        $this->assertTrue($bool);
    }

    public function testValidateEmail()
    {
        $user = new User("a@gail.com", "a", "b", "2000-12-12", "F", 162, "aB1@1111", null);
        $user->validateEmail($this->expectException(EmailInvalideException::class));
    }
    }
    
