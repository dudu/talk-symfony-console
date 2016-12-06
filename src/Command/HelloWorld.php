<?php
namespace Talk\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;

class HelloWorld extends Command
{
    protected $year;
    protected $personName;

    protected function configure()
    {
        $this->setName('hello')
            ->setDescription('Says Hello!')
            ->setHelp("Trust me, I will not execute rm -rf /")
            ->setHidden(false)
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'The name of the person.'
            );
    }

    protected function initialize(InputInterface $input)
    {
        $this->year = 2016;
        $this->personName = $input->getArgument('name');
    }

    protected function execute()
    {
        echo sprintf(
            "Hello %s, welcome to PHP Conference %d! \n",
            $this->personName,
            $this->year
        );
    }
}
