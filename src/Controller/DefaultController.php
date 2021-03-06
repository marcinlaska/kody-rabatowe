<?php
namespace App\Controller;

use App\Entity\DiscountCodeGenerationOptions;
use App\Service\DiscountCodeGenerator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    public function home(DiscountCodeGenerator $generator, Request $request)
    {
        $options = new DiscountCodeGenerationOptions;
        $options->setCodeCount(3);
        $options->setCodeLength(4);
        $options->setCodeContent('numeric');
        
        $form = $this->createFormBuilder($options)
            ->add('codeCount',   NumberType::class, ['label' => 'Ile kodów?', 'html5' => true, 'attr' => ['min'=> 1]])
            ->add('codeLength',  NumberType::class, ['label' => 'Jaka długość?', 'html5' => true, 'attr' => ['min'=> 3]])
            ->add('codeContent', ChoiceType::class, ['label' => 'Z literami czy bez?', 'choices' => ['Tylko cyfry' => 'numeric', 'Cyfry i litery' => 'alphanumeric']])
            ->add('generate',    SubmitType::class, ['label' => 'Generuj!'])
            ->getForm();
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted())
        {
            $options = $form->getData();
        }
        
        return $this->render('home.html.twig', [
            'form'  => $form->createView(),
            'codes' => $generator->setup($options)->run()
        ]);
    }
}
