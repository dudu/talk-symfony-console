<?php
namespace Talk\Command;

use Symfony\Component\Console\Command\Command;

class HelloWorld extends Command
{
    public function configure()
    {
        $this->setName('hello')
            ->setDescription('Says Hello!')
            ->setHelp("Trust me, I will not execute rm -rf /")
            ->setHidden(false);
    }

    protected function execute()
    {
        echo "Hello PHP Conference!\n";
    }
}
