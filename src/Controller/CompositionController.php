<?php

namespace App\Controller;

use App\Entity\Composition;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CompositionController extends AbstractController
{
    /**
     * @Route("/composition", name="composition", methods={"GET"})
     */
    public function composition(Request $request)
    {
        $limit = !empty($request->get('limit')) && preg_match('/^[0-9]*$/', $request->get('limit')) ? $request->get('limit') : 10;
        $offset = !empty($request->get('offset')) && preg_match('/^[0-9]*$/', $request->get('offset')) ? $request->get('offset') : 1;
        $designation = !empty($request->get("designation_pharmaceutical_element")) ? $request->get("designation_pharmaceutical_element") : null;
        $substanceCode = !empty($request->get("substance_code")) ? $request->get("substance_code") : null;
        $composent_nature = !empty($request->get("composent_nature")) ? $request->get("composent_nature") : null;
        $num_link = !empty($request->get("num_link")) ? $request->get("num_link") : null;
        $composition = null;

        if(!is_null($designation)) {
            $composition = $this->getDoctrine()->getRepository(Composition::class)->getCompositionsByDesignation($offset, $limit, $designation);
        } elseif(!is_null($substanceCode)) {
            $composition = $this->getDoctrine()->getRepository(Composition::class)->getCompositionsBySustanceCode($offset, $limit, $substanceCode);
        } elseif(!is_null($composent_nature)) {
            $composition = $this->getDoctrine()->getRepository(Composition::class)->getCompositionsByComponentNature($offset, $limit, $composent_nature);
        } elseif(!is_null($num_link)) {
            $composition = $this->getDoctrine()->getRepository(Composition::class)->getCompositionsByNumLink($offset, $limit, $num_link);
        } else {
            $composition = $this->getDoctrine()->getRepository(Composition::class)->getCompositions($offset, $limit);
        }

        if(empty($composition)) {
            $composition = [
                "error" => true,
                "message" => "No results found"
            ];
        }

        return $this->returnJsonResponse($presentations);
    }

    /**
     * @Route("/composition/{code_cis}", name="compositionID", methods={"GET"})
     */
    public function composition_by_id($code_cis)
    {
        $composition = $this->getDoctrine()->getRepository(Composition::class)->getCompositionsByCodeCIS($offset, $limit, $codeCIS);

        if(empty($composition)) {
            $composition = [
                "error" => true,
                "message" => "No results found"
            ];
        }

        return $this->returnJsonResponse($composition);
    }

    private function returnJsonResponse($data)
    {
        $jsonData = $this->get('serializer')->serialize($data, 'json');
        $response = new Response($jsonData);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
