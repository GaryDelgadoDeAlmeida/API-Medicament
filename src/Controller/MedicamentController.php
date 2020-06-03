<?php

namespace App\Controller;

use App\Entity\Medicament;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MedicamentController extends AbstractController
{
    /**
     * @Route("/medicament", name="medicament", methods={"GET"})
     */
    public function medicament(Request $request)
    {
        $limit = !empty($request->get('limit')) && preg_match('/^[0-9]*$/', $request->get('limit')) ? $request->get('limit') : 10;
        $offset = !empty($request->get('offset')) && preg_match('/^[0-9]*$/', $request->get('offset')) ? $request->get('offset') : 1;
        $pharmaceuticalForm = $request->get('pharmaceuticalForm') ? $request->get('pharmaceuticalForm') : null;
        $authorizationStatus = $request->get('authorizationStatus') ? $request->get('authorizationStatus') : null;
        $date = $request->get('date') ? new \DateTime(str_replace("/", '-', $request->get('date'))) : null;
        $holder = $request->get('holder') ? $request->get('holder') : null;
        $medicament = [];
        
        if(!is_null($pharmaceuticalForm)) {
            $medicament = $this->getDoctrine()->getRepository(Medicament::class)->getMedicamentsByPharmaceuticalForm($offset, $limit, $pharmaceuticalForm);
        } elseif(!is_null($authorizationStatus)) {
            $medicament = $this->getDoctrine()->getRepository(Medicament::class)->getMedicamentsByAuthorizationStatus($offset, $limit, $authorizationStatus);
        } elseif(!is_null($date)) {
            $medicament = $this->getDoctrine()->getRepository(Medicament::class)->getMedicamentsByDate($offset, $limit, $date);
        } elseif(!is_null($holder)) {
            $medicament = $this->getDoctrine()->getRepository(Medicament::class)->getMedicamentsByHolder($offset, $limit, $holder);
        } else {
            $medicament = $this->getDoctrine()->getRepository(Medicament::class)->getMedicaments($offset, $limit);
        }

        if(empty($medicament)) {
            $medicament = [
                "error" => true,
                "message" => "No result found"
            ];
        }

        return $this->returnJsonResponse($medicament);
    }

    /**
     * @Route("/medicament/{id}", requirements={"id" = "^\d+(?:\d+)?$"}, name="medicamentID", methods={"GET"})
     */
    public function medicament_by_id(Medicament $medicament)
    {
        if(is_null($medicament)) {
            $medicament = [
                "error" => true,
                "message" => "This id doesn't exist."
            ];
        }
        
        return $this->returnJsonResponse($medicament);
    }

    /**
     * @Route("/medicament/{id}/delete", requirements={"id" = "^\d+(?:\d+)?$"}, name="deleteMedicamentID", methods={"DELETE"})
     */
    public function delete_medicament_by_id(Medicament $medicament, EntityManagerInterface $manager)
    {
        if(is_null($medicament)) {
            return $this->returnJsonResponse([
                "error" => true,
                "message" => "This id doesn't exist."
            ]);
        }

        $manager->remvoe($medicament);
        $manager->flush();

        return $this->returnJsonResponse([
            "error" => false,
            "message" => "We successfully deleted the medicament."
        ]);
    }

    private function returnJsonResponse($data)
    {
        $jsonData = $this->get('serializer')->serialize($data, 'json');
        $response = new Response($jsonData);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
