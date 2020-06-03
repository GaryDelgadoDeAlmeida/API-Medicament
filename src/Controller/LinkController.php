<?php

namespace App\Controller;

use App\Entity\PageLinkCT;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LinkController extends AbstractController
{
    /**
     * @Route("/link", name="link")
     */
    public function link(Request $request)
    {
        $limit = !empty($request->get('limit')) && preg_match('/^[0-9]*$/', $request->get('limit')) ? $request->get('limit') : 10;
        $offset = !empty($request->get('offset')) && preg_match('/^[0-9]*$/', $request->get('offset')) ? $request->get('offset') : 1;
        $code_has = !empty($request->get('code_has')) && preg_match('/^[0-9]*$/', $request->get('code_has')) ? $request->get('code_has') : null;

        if(!is_null($code_has)) {
            $link = $this->getDoctrine()->getRepository(PageLinkCT::class)->getPageLinkByCodeHAS($code_has);
        } else {
            $link = $this->getDoctrine()->getRepository(PageLinkCT::class)->getPageLink($offset, $link);
        }

        if(empty($link)) {
            $link = [
                "error" => true,
                "message" => "No results found"
            ];
        }

        return $this->returnJsonResponse($link);
    }

    /**
     * @Route("/link/{id}", name="link_by_id")
     */
    public function link_by_id(PageLinkCT $link)
    {
        if(empty($link)) {
            $link = [
                "error" => true,
                "message" => "No results found"
            ];
        }

        return $this->returnJsonResponse($link);
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
