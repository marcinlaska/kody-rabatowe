<?php
namespace App\Service;

use App\Entity\DiscountCodeGenerationOptions;

class DiscountCodeGenerator
{
    private $digits  = '0123456789';
    private $letters = 'QWERYUIOPASDHJKLZXCVBNM';
    private $options;
    private $chars;
    private $code;
    
    public function setup(DiscountCodeGenerationOptions $options)
    {
        $this->options = $options;
        $this->chars   = $this->digits;
        
        if ($options->getCodeContent() == 'alphanumeric')
        {
            $this->chars .= $this->letters;
        }
        
        return $this;
    }
    
    public function run()
    {
        return [
            $this->generate()->code,
            $this->generate()->code,
            $this->generate()->code,
            $this->generate()->code
        ];
    }
    
    protected function generate()
    {
        $this->code = NULL;
        
        for ($i = 0; $i < 5; $i++)
        {
            $this->addCharacter($this->getRandomCharacter());
        }
        
        return $this;
    }
    
    protected function getRandomCharacter()
    {
        return substr($this->chars, rand(0, strlen($this->chars) - 1), 1);
    }
    
    protected function addCharacter($character)
    {
        $this->code .= $character;
    }
}
