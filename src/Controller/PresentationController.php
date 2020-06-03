<?php

namespace App\Controller;

use App\Entity\Presentation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PresentationController extends AbstractController
{
    /**
     * @Route("/presentation", name="presentation", methods={"GET"})
     */
    public function presentation(Request $request)
    {
        $limit = !empty($request->get('limit')) && preg_match('/^[0-9]*$/', $request->get('limit')) ? $request->get('limit') : 10;
        $offset = !empty($request->get('offset')) && preg_match('/^[0-9]*$/', $request->get('offset')) ? $request->get('offset') : 1;
        $codeCIS = $request->get('codeCIS') ? intval($request->get('codeCIS')) : null;
        $codeCIP = $request->get('codeCIP') ? intval($request->get('codeCIP')) : null;
        $codeCIP13 = $request->get('codeCIP13') ? intval($request->get('codeCIP13')) : null;
        $name = $request->get('name') ? $request->get('name') : null;
        $administrationStatus = $request->get('administrationStatus') ? $request->get('administrationStatus') : null;
        $date = $request->get('date') ? new \DateTime(str_replace("/", '-', $request->get('date'))) : null;
        $presentations = [];

        if(!is_null($codeCIS)) {
            $presentations = $this->getDoctrine()->getRepository(Presentation::class)->getPresentationsByCIS($offset, $limit, $codeCIS);
        } elseif(!is_null($codeCIP)) {
            $presentations = $this->getDoctrine()->getRepository(Presentation::class)->getPresentationsByCIP($offset, $limit, $codeCIP);
        } elseif(!is_null($codeCIP13)) {
            $presentations = $this->getDoctrine()->getRepository(Presentation::class)->getPresentationsByCIP13($offset, $limit, $codeCIP13);
        } elseif(!is_null($name)) {
            $presentations = $this->getDoctrine()->getRepository(Presentation::class)->getPresentationsByName($offset, $limit, $name);
        } elseif(!is_null($administrationStatus)) {
            $presentations = $this->getDoctrine()->getRepository(Presentation::class)->getPresentationsByAdministrationStatus($offset, $limit, $administrationStatus);
        } elseif(!is_null($date)) {
            $presentations = $this->getDoctrine()->getRepository(Presentation::class)->getPresentationsByDate($offset, $limit, $date);
        } else {
            $presentations = $this->getDoctrine()->getRepository(Presentation::class)->getPresentations($offset, $limit);
        }

        if(empty($presentations)) {
            $presentations = [
                "error" => true,
                "message" => "No results found"
            ];
        }

        return $this->returnJsonResponse($presentations);
    }

    /**
     * @Route("/presentation/{id}", requirements={"id" = "^\d+(?:\d+)?$"}, name="presentationByID", methods={"GET"})
     */
    public function presentation_by_id(Presentation $presentation) {
        
        if(empty($presentations)) {
            $presentations = [
                "error" => true,
                "message" => "No prestation found with this id."
            ];
        }

        return $this->returnJsonResponse($presentation);
    }

    /**
     * @Route("/presentation/{id}", requirements={"id" = "^\d+(?:\d+)?$"}, name="presentationByID", methods={"DELETE"})
     */
    public function delete_presentation_by_id(Presentation $presentation, EntityManagerInterface $manager) {
        
        if(empty($presentations)) {
            return $this->returnJsonResponse([
                "error" => true,
                "message" => "This id doesn't exist."
            ]);
        }

        $manager->remove($presentation);
        $manager->flush();

        return $this->returnJsonResponse([
            "message" => "We successfully deleted the presentation."
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
