<?php

namespace Tests\Command;

use Talk\Command\HelloWorld;
use Symfony\Component\Console\Tester\CommandTester;

class CreateUserCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testOutputMustContainName()
    {
        $commandTester = new CommandTester(new HelloWorld());
        $commandTester->execute(
            [
                'name' => 'Eduardo'
            ]
        );

        $output = $commandTester->getDisplay();
        $this->assertContains('Hello Eduardo, welcome to PHP Conference 2016!', $output);
    }
}