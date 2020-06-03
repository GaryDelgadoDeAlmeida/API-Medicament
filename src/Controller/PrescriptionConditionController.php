<?php

namespace App\Controller;

use App\Entity\PrescriptionCondition;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PrescriptionConditionController extends AbstractController
{
    /**
     * @Route("/prescription/condition", name="prescription_condition")
     */
    public function prescription_condition(Request $request)
    {
        $limit = !empty($request->get('limit')) && preg_match('/^[0-9]*$/', $request->get('limit')) ? $request->get('limit') : 10;
        $offset = !empty($request->get('offset')) && preg_match('/^[0-9]*$/', $request->get('offset')) ? $request->get('offset') : 1;
        
        $prescCondi = $this->getDoctrine()->getRepository(PrescriptionCondition::class)->getPrescriptionCondition($offset, $limit);
        
        return $this->returnJsonResponse($prescCondi);
    }

    /**
     * @Route("/prescription/condition/{id}", name="prescription_condition")
     */
    public function prescription_condition_by_id(PrescriptionCondition $prescCondi)
    {
        if(\is_null($prescCondi)) {
            $prescCondi = [
                "error" => true,
                "message" => "No result found"
            ];
        }
        
        return $this->returnJsonResponse($prescCondi);
    }

    private function returnJsonResponse($data)
    {
        $jsonData = $this->get('serializer')->serialize($data, 'json');
        $response = new Response($jsonData);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
