<?php
namespace Talk\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Logger\ConsoleLogger;

class HelloWorld extends Command
{
    protected $year;
    protected $personName;
    protected $logger;

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
            )
            ->addOption(
                'year',
                null,
                InputOption::VALUE_REQUIRED,
                'What year is it?',
                2016
            );

    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->logger = new ConsoleLogger($output);

        $this->year       = $input->getOption('year');
        $this->personName = $input->getArgument('name');
    }

    protected function interact()
    {
        $this->logger->debug(__METHOD__);
    }

    protected function execute(InputInterface $input)
    {
        echo sprintf(
            "Hello %s, welcome to PHP Conference %d! \n",
            $this->personName,
            $this->year
        );
    }
}
