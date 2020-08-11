<?php
namespace App\Controller;

use App\Entity\DiscountCodeGenerationOptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    public function home()
    {
        $options = new DiscountCodeGenerationOptions;
        $form    = $this->createFormBuilder($options)
            ->add('codeCount',   NumberType::class, ['label' => 'Ile kodów?', 'html5' => true])
            ->add('codeLength',  NumberType::class, ['label' => 'Jaka długość?', 'html5' => true])
            ->add('codeContent', ChoiceType::class, ['label' => 'Z literami czy bez?', 'choices' => ['Tylko cyfry' => 'numeric', 'Cyfry i litery' => 'alphanumeric']])
            ->add('generate',    SubmitType::class, ['label' => 'Generuj!'])
            ->getForm();
        
        return $this->render('home.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
