<?php
namespace Talk\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Question\Question;

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

        $this->year       = $input->getOption('year');
        $this->personName = $input->getArgument('name');
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        if (!$input->getArgument('name')) {
            $question = new Question('Please supply a name:');
            $question->setValidator(function ($name) {
                if (empty($name)) {
                    throw new \Exception('Name can not be empty');
                }
                return $name;
            });
            $answer = $this->getHelper('question')->ask($input, $output, $question);
            $input->setArgument('name', $answer);
            $this->personName = $input->getArgument('name');
        }
    }

    protected function execute(InputInterface $input)
    {
        $startTime = microtime(true);

        $this->progress->start();
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

        $endTime = microtime(true);
        $this->logger->info(sprintf("Run in: %f seconds", $endTime-$startTime));
    }
}
