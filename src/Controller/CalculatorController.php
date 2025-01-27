<?php 

namespace App\Controller;

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

    #[Route('/calculator', name: 'calculator')]
    public function index(Request $request): Response
    {
        $result = null;

        if ($request->isMethod('POST')) {
            $a = (float)$request->request->get('a');
            $b = (float)$request->request->get('b');
            $operation = $request->request->get('operation');

            try {
                $result = $this->calculator->calculate($a, $b, $operation);
            } catch (\Exception $e) {
                $this->addFlash('error', $e->getMessage());
            }
        }

        return $this->render('calculator/index.html.twig', [
            'result' => $result,
        ]);
    }
}
