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
        $codes = array();
        
        for ($i = 0; $i < $this->options->getCodeCount(); $i++)
        {
            $codes[] = $this->generate()->code;
        }
        
        $this->clearCode();
        
        return $codes;
    }
    
    protected function generate()
    {
        $this->clearCode();
        
        for ($i = 0; $i < $this->options->getCodeLength(); $i++)
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
    
    protected function clearCode()
    {
        $this->code = NULL;
        return $this;
    }
}
