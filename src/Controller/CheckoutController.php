<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CheckoutType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckoutController extends AbstractController
{
    /**
     * @Route("/checkout", name="checkout")
     */
    public function indexAction(Request $request, \Swift_Mailer $mailer): Response
    {

        $form = $this->createForm(CheckoutType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            dump($formData["email"]);

            $message = (new \Swift_Message('Hello Email'))
                ->setFrom('hamsterenergie@email.com')
                ->setTo($formData["email"])
                ->setBody(
                    "thank you for ordering, unfortunately this e-mail cannot show you what you have ordered. I hope you have a good memory."
                    // $this->renderView('
                        
                    // ')
                )
            ;

            $mailer->send($message);
        }
        
        return $this->render('checkout/index.html.twig', [
            'controller_name' => 'CheckoutController',
            'form' => $form->createView(),
        ]);
    }
}
