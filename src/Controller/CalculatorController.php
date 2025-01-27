<?php

namespace App\Controller;

use App\Form\CalculatorType;
use App\Service\CalculatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends AbstractController
{
    private CalculatorService $calculator;

    public function __construct(CalculatorService $calculator)
    {
        $this->calculator = $calculator;
    }

    #[Route('/', name: 'calculator')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(CalculatorType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $a = $data['a'];
            $b = $data['b'];
            $operation = $data['operation'];

            try {
                $result = $this->calculator->calculate($a, $b, $operation);
            
                // Redirect with result encoded as a string
                return $this->redirectToRoute('calculator', [
                    'result' => (string) $result,
                ]);
            } catch (\Exception $e) {
                $this->addFlash('error', $e->getMessage());
                return $this->redirectToRoute('calculator');
            }            
        }

        return $this->render('calculator/index.html.twig', [
            'form' => $form->createView(),
            'result' => $request->query->get('result'),
        ]);
    }

}
