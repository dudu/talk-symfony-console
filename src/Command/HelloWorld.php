<?php
namespace Talk\Command;

use Symfony\Component\Console\Command\Command;

class HelloWorld extends Command
{
    protected $year;

    protected function configure()
    {
        $this->setName('hello')
            ->setDescription('Says Hello!')
            ->setHelp("Trust me, I will not execute rm -rf /")
            ->setHidden(false);
    }

    protected function initialize()
    {
        $this->year = 2016;
    }

    protected function interact()
    {
        echo "interact() called \n";
    }

    protected function execute()
    {
        echo sprintf("Hello PHP Conference %d! \n", $this->year);
    }
}
