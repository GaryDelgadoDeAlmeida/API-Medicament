<?php

namespace Manager;

use App\Entity\AvisSMR;
use App\Entity\AvisASMR;

class AvisManager {

    public function insertASMRToDatabase($avisASMR, $manager)
    {
        $saved = $updated = 0;

        foreach($avisASMR as $oneAvis) {
            $avis = $manager->getRepository(AvisASMR::class)->getAvisASMRByCodeCISAndCodeHAS($oneAvis[0], $oneAvis[1]);

            if(is_null($avis)) {
                $avis = new AvisASMR();
                $avis->setCodeCIS($oneAvis[0]);
                $avis->setCodeHAS($oneAvis[1]);
                $saved += self::fillAvisData($avis, $oneAvis, $manager);
            } else {
                $updated += self::fillAvisData($avis, $oneAvis, $manager);
            }

            sleep(1);
        }

        return [
            "saved" => $saved,
            "updated" => $updated
        ];
    }

    public function insertSMRToDatabase($avisSMR, $manager)
    {
        $saved = $updated = 0;

        foreach($avisSMR as $oneAvis) {
            $avis = $manager->getRepository(AvisSMR::class)->getAvisSMRByCodeCISAndCodeHAS($oneAvis[0], $oneAvis[1]);

            if(is_null($avis)) {
                $avis = new AvisSMR();
                $avis->setCodeCIS($oneAvis[0]);
                $avis->setCodeHAS($oneAvis[1]);
                $saved += self::fillAvisData($avis, $oneAvis, $manager);
            } else {
                $updated += self::fillAvisData($avis, $oneAvis, $manager);
            }
            sleep(1);
        }

        return [
            "saved" => $saved,
            "updated" => $updated
        ];
    }

    private function fillAvisData($avis, $avisData, $manager)
    {
        $avis->setEvaluationMotive($avisData[2]);
        $avis->setDate(new \DateTime(str_replace('/', '-', $avisData[3])));
        $avis->setValue($avisData[4]);
        $avis->setWording($avisData[5]);

        $manager->persist($avis);
        $manager->flush();

        return 1;
    }
}