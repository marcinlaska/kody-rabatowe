<?php
namespace App\Entity;

class DiscountCodeGenerationOptions
{
    protected $codeCount;
    protected $codeLength;
    protected $codeContent;
    
    public function getCodeCount()
    {
        return $this->codeCount;
    }
    
    public function setCodeCount($codeCount)
    {
        $this->codeCount = $codeCount;
    }
    
    public function getCodeLength()
    {
        return $this->codeLength;
    }
    
    public function setCodeLength($codeLength)
    {
        $this->codeLength = $codeLength;
    }
    
    public function getCodeContent()
    {
        return $this->codeContent;
    }
    
    public function setCodeContent($codeContent)
    {
        $this->codeContent = $codeContent;
    }
}
