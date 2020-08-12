<?php
namespace App\Command;

use App\Entity\DiscountCodeGenerationOptions;
use App\Service\DiscountCodeGenerator;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeDiscountCodesCommand extends Command
{
    protected static $defaultName = 'make:discount-codes';
    protected $generator;
    
    public function __construct(DiscountCodeGenerator $generator)
    {
        $this->generator = $generator;
        
        parent::__construct();
    }
    
    protected function configure()
    {
        $this
            ->setDescription('Generuje kody rabatowe')
            ->setHelp('Generuje kody rabatowe do pliku na serwerze.');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $options = new DiscountCodeGenerationOptions;
        $options->setCodeCount(3);
        $options->setCodeLength(4);
        $options->setCodeContent('numeric');
        
        $output->writeln($this->generator->setup($options)->run());
    }
}
