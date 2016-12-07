<?php
namespace Talk\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Helper\ProgressBar;

class HelloWorld extends Command
{
    protected $year;
    protected $personName;
    protected $logger;
    protected $progress;

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
        $this->progress = new ProgressBar($output, 100);
        $this->progress->start();

        $this->year       = $input->getOption('year');
        $this->personName = $input->getArgument('name');
    }

    protected function interact()
    {
        $this->logger->debug(__METHOD__);
    }

    protected function execute(InputInterface $input)
    {
        for ($i=0; $i < 100; $i++) {
            usleep(rand(10000,100000));
            $this->progress->advance();
        }

        $this->progress->finish();

        echo sprintf(
            "\nHello %s, welcome to PHP Conference %d! \n",
            $this->personName,
            $this->year
        );

    }
}
