<?php

namespace App\Controller;

use App\Entity\AvisSMR;
use App\Entity\AvisASMR;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AvisController extends AbstractController
{
    /**
     * @Route("/avis/asmr", name="avis_asmr")
     */
    public function avis_asmr(Request $request)
    {
        $limit = !empty($request->get('limit')) && preg_match('/^[0-9]*$/', $request->get('limit')) ? $request->get('limit') : 10;
        $offset = !empty($request->get('offset')) && preg_match('/^[0-9]*$/', $request->get('offset')) ? $request->get('offset') : 1;
        $code_cis = !empty($request->get('code_cis')) ? intval($request->get('code_cis')) : null;
        $code_has = !empty($request->get('code_has')) ? intval($request->get('code_has')) : null;
        $evalutation = !empty($request->get('evaluation_motive')) ? intval($request->get('evaluation_motive')) : null;
        $date = !empty($request->get('date')) ? intval($request->get('date')) : null;
        $value = !empty($request->get('value')) ? intval($request->get('value')) : null;
        $avis = null;
        
        if(!is_null($code_cis) && !is_null($code_has)) {
            $avis = $this->getDoctrine()->getRepository(AvisASMR::class)->getAvisASMRByCodeCISAndCodeHAS($code_cis, $code_has);
        } elseif(!is_null($code_cis)) {
            $avis = $this->getDoctrine()->getRepository(AvisASMR::class)->getAvisASMRByCodeCIS($offset, $limit, $code_cis);
        } elseif(!is_null($code_has)) {
            $avis = $this->getDoctrine()->getRepository(AvisASMR::class)->getAvisASMRByCodeHAS($offset, $limit, $code_has);
        } elseif(!is_null($evalutation)) {
            $avis = $this->getDoctrine()->getRepository(AvisASMR::class)->getAvisASMRByEvaluation($offset, $limit, $evalutation);
        } elseif(!is_null($date)) {
            $avis = $this->getDoctrine()->getRepository(AvisASMR::class)->getAvisASMRByDate($offset, $limit, $date);
        } elseif(!is_null($value)) {
            $avis = $this->getDoctrine()->getRepository(AvisASMR::class)->getAvisASMRByValue($offset, $limit, $value);
        } else {
            $avis = $this->getDoctrine()->getRepository(AvisASMR::class)->getAvisASMR($offset, $limit);
        }

        if(empty($avis)) {
            $avis = [
                "error" => true,
                "message" => "No results found"
            ];
        }

        return $this->returnJsonResponse($avis);
    }

    /**
     * @Route("/avis/asmr/{id}", name="avis_asmr_by_code_cis")
     */
    public function avis_asmr_by_code_cis(AvisASMR $avis)
    {
        if(empty($avis)) {
            $avis = [
                "error" => true,
                "message" => "No results found"
            ];
        }

        return $this->returnJsonResponse($avis);
    }

    /**
     * @Route("/avis/smr", name="avis_smr")
     */
    public function avis_smr(Request $request)
    {
        $limit = !empty($request->get('limit')) && preg_match('/^[0-9]*$/', $request->get('limit')) ? $request->get('limit') : 10;
        $offset = !empty($request->get('offset')) && preg_match('/^[0-9]*$/', $request->get('offset')) ? $request->get('offset') : 1;
        $code_cis = !empty($request->get('code_cis')) ? intval($request->get('code_cis')) : null;
        $code_has = !empty($request->get('code_has')) ? intval($request->get('code_has')) : null;
        $evalutation = !empty($request->get('evaluation_motive')) ? intval($request->get('evaluation_motive')) : null;
        $date = !empty($request->get('date')) ? intval($request->get('date')) : null;
        $value = !empty($request->get('value')) ? intval($request->get('value')) : null;
        $avis = null;
        
        if(!is_null($code_cis) && !is_null($code_has)) {
            $avis = $this->getDoctrine()->getRepository(AvisSMR::class)->getAvisSMRByCodeCISAndCodeHAS($code_cis, $code_has);
        } elseif(!is_null($code_cis)) {
            $avis = $this->getDoctrine()->getRepository(AvisSMR::class)->getAvisSMRByCodeCIS($offset, $limit, $code_cis);
        } elseif(!is_null($code_has)) {
            $avis = $this->getDoctrine()->getRepository(AvisSMR::class)->getAvisSMRByCodeHAS($offset, $limit, $code_has);
        } elseif(!is_null($evalutation)) {
            $avis = $this->getDoctrine()->getRepository(AvisSMR::class)->getAvisSMRByEvaluation($offset, $limit, $evalutation);
        } elseif(!is_null($date)) {
            $avis = $this->getDoctrine()->getRepository(AvisSMR::class)->getAvisSMRByDate($offset, $limit, $date);
        } elseif(!is_null($value)) {
            $avis = $this->getDoctrine()->getRepository(AvisSMR::class)->getAvisSMRByValue($offset, $limit, $value);
        } else {
            $avis = $this->getDoctrine()->getRepository(AvisSMR::class)->getAvisSMR($offset, $limit);
        }

        if(empty($avis)) {
            $avis = [
                "error" => true,
                "message" => "No results found"
            ];
        }

        return $this->returnJsonResponse($avis);
    }

    /**
     * @Route("/avis/smr/{id}", name="avis_smr_by_code_cis")
     */
    public function avis_smr_by_code_cis(AvisSMR $avis)
    {
        if(empty($avis)) {
            $avis = [
                "error" => true,
                "message" => "No results found"
            ];
        }
        
        return $this->returnJsonResponse($avis);
    }

    private function returnJsonResponse($data)
    {
        $jsonData = $this->get('serializer')->serialize($data, 'json');
        $response = new Response($jsonData);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
