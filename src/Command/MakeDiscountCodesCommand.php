<?php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeDiscountCodesCommand extends Command
{
    protected static $defaultName = 'make:discount-codes';
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Witaj, świecie!');
    }
}
