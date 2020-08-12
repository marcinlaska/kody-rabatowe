<?php
namespace App\Command;

use App\Entity\DiscountCodeGenerationOptions;
use App\Service\DiscountCodeGenerator;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
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
            ->setHelp('Generuje kody rabatowe do pliku na serwerze.')
            
            ->addArgument('count',   InputArgument::REQUIRED, 'Ilość kodów do wygenerowania.')
            ->addArgument('length',  InputArgument::REQUIRED, 'Ilość znaków w każdym kodzie.')
            ->addArgument('content', InputArgument::REQUIRED, 'Czy kody mogą zawierać litery (wartość "alphanumeric") czy tylko cyfry ("numeric").');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $options = new DiscountCodeGenerationOptions;
        $options->setCodeCount($input->getArgument('count'));
        $options->setCodeLength($input->getArgument('length'));
        $options->setCodeContent($input->getArgument('content'));
        
        $output->writeln($this->generator->setup($options)->run());
    }
}
