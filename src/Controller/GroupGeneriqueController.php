<?php

namespace App\Controller;

use App\Entity\GroupGenerique;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GroupGeneriqueController extends AbstractController
{
    /**
     * @Route("/group/generique", name="group_generique")
     */
    public function group_generique(Request $request)
    {
        $limit = !empty($request->get('limit')) && preg_match('/^[0-9]*$/', $request->get('limit')) ? $request->get('limit') : 10;
        $offset = !empty($request->get('offset')) && preg_match('/^[0-9]*$/', $request->get('offset')) ? $request->get('offset') : 1;
        $id_group_generique = !empty($request->get('id_group_generique')) && preg_match('/^[0-9]*$/', $request->get('id_group_generique')) ? $request->get('id_group_generique') : null;
        $type_generique = !empty($request->get('type_generique')) && preg_match('/^[0-9]*$/', $request->get('type_generique')) ? $request->get('type_generique') : null;
        $num_tri = !empty($request->get('num_tri')) && preg_match('/^[0-9]*$/', $request->get('num_tri')) ? $request->get('num_tri') : null;
        $generique = null;

        if(!is_null($id_group_generique)) {
            $generique = $this->getDoctrine()->getRepository(GroupGenerique::class)->getGroupGeneriqueByIdGroup($offset, $limit, $id_group_generique);
        } elseif(!is_null($type_generique)) {
            $generique = $this->getDoctrine()->getRepository(GroupGenerique::class)->getGroupGeneriqueByType($offset, $limit, $type_generique);
        } elseif(!is_null($num_tri)) {
            $generique = $this->getDoctrine()->getRepository(GroupGenerique::class)->getGroupGeneriqueByNumTri($offset, $limit, $num_tri);
        } else {
            $generique = $this->getDoctrine()->getRepository(GroupGenerique::class)->getGroupGenerique($offset, $limit);
        }

        if(empty($generique)) {
            $generique = [
                "error" => true,
                "message" => "No results found"
            ];
        }

        return $this->returnJsonResponse([]);
    }

    /**
     * @Route("/group/generique/{id}", name="group_generique_by_id")
     */
    public function group_generique_by_id(GroupGenerique $generique)
    {
        if(empty($generique)) {
            $generique = [
                "error" => true,
                "message" => "No results found"
            ];
        }

        return $this->returnJsonResponse($generique);
    }

    private function returnJsonResponse($data)
    {
        $jsonData = $this->get('serializer')->serialize($data, 'json');
        $response = new Response($jsonData);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
