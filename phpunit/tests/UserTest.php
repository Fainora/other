<?php
use App\Models\User;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{

    private $user;

    protected function setUp() : void
    {
        $this->user = new User();
        $this->user->setAge(33);
    }

    protected function tearDown(): void
    {

    }

    public function testAge1() {
        /// 33 === $this->user->getAge()
        $this->assertSame(33, $this->user->getAge());
        return 33;
    }

    /**
     * @depends testAge1
     */
    public function testAge2($age) {
        $this->assertEquals($age, $this->user->getAge());
    }

    public function userProvider() {
        return [
            'one' => [1, 2],
            'two' =>[2, 2],
            'correct' =>[33, 35],
        ];
    }
}