<?php
namespace App\Command;

use App\Entity\DiscountCodeGenerationOptions;
use App\Service\DiscountCodeGenerator;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class MakeDiscountCodesCommand extends Command
{
    protected static $defaultName = 'make:discount-codes';
    protected $generator;
    protected $filesystem;
    protected $projectDir;
    
    public function __construct(DiscountCodeGenerator $generator, Filesystem $filesystem, string $projectDir)
    {
        $this->generator  = $generator;
        $this->filesystem = $filesystem;
        $this->projectDir = $projectDir;
        
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
        
        $codes    = $this->generator->setup($options)->run();
        $filename = sprintf('kody_rabatowe_%s.txt', date('m.d.Y_H:i:s'));
        $filePath = $this->projectDir . DIRECTORY_SEPARATOR . 'var' . DIRECTORY_SEPARATOR . $filename;
        
        $this->filesystem->dumpFile($filePath, join(PHP_EOL, $codes));
        
        $output->writeln('Kody zostały pomyślnie wygenerowane! Znajdziesz je w pliku ' . $filePath);
    }
}
