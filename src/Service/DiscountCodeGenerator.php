<?php
namespace App\Service;

class DiscountCodeGenerator
{
    private $digits  = '0123456789';
    private $letters = 'QWERYUIOPASDHJKLZXCVBNM';
    private $chars;
    private $code;
    
    public function generate()
    {
        $this->code = NULL;
        
        for ($i = 0; $i < 5; $i++)
        {
            $this->addCharacter($this->getRandomCharacter());
        }
        
        return $this;
    }
    
    public function getRandomCharacter()
    {
        return substr($this->letters, rand(0, strlen($this->letters) - 1), 1);
    }
    
    public function addCharacter($character)
    {
        $this->code .= $character;
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
}
