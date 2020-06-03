<?php

namespace App\Controller;

use App\Entity\InfoImportant;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InfoImportantController extends AbstractController
{
    /**
     * @Route("/info/important", name="info_important")
     */
    public function info_important(Request $request)
    {
        $limit = !empty($request->get('limit')) && preg_match('/^[0-9]*$/', $request->get('limit')) ? $request->get('limit') : 10;
        $offset = !empty($request->get('offset')) && preg_match('/^[0-9]*$/', $request->get('offset')) ? $request->get('offset') : 1;
        $code_cis = !empty($request->get('code_cis')) && preg_match('/^[0-9]*$/', $request->get('code_cis')) ? $request->get('code_cis') : null;
        $date_start = !empty($request->get('date_start')) && preg_match('/^[0-9]*$/', $request->get('date_start')) ? $request->get('date_start') : null;
        $date_end = !empty($request->get('date_end')) && preg_match('/^[0-9]*$/', $request->get('date_end')) ? $request->get('date_end') : null;
        $info = null;

        if(!is_null($date_start) && !is_null($date_end)) {
            $info = $this->getDoctrine()->getRepository(InfoImportant::class)->getInfoImportantByDateStartAndDateEnd($offset, $limit, $date_start, $date_end);
        } elseif(!is_null($date_start)) {
            $info = $this->getDoctrine()->getRepository(InfoImportant::class)->getInfoImportantByDateStart($offset, $limit, $date_start);
        } elseif(!is_null($date_end)) {
            $info = $this->getDoctrine()->getRepository(InfoImportant::class)->getInfoImportantByDateEnd($offset, $limit, $date_end);
        } elseif(!is_null($code_cis)) {
            $info = $this->getDoctrine()->getRepository(InfoImportant::class)->getInfoByCodeCIS($offset, $limit, $code_cis);
        } else {
            $info = $this->getDoctrine()->getRepository(InfoImportant::class)->getInfoImportant($offset, $limit);
        }

        if(empty($info)) {
            $info = [
                "error" => true,
                "message" => "No results found"
            ];
        }

        return $this->returnJsonResponse($info);
    }

    /**
     * @Route("/info/important/{id}", name="info_important_by_id")
     */
    public function info_important_by_id(InfoImportant $info)
    {
        if(empty($info)) {
            $info = [
                "error" => true,
                "message" => "No results found"
            ];
        }

        return $this->returnJsonResponse($info);
    }

    /**
     * Convert to json the sended response
     */
    private function returnJsonResponse($data)
    {
        $jsonData = $this->get('serializer')->serialize($data, 'json');
        $response = new Response($jsonData);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
