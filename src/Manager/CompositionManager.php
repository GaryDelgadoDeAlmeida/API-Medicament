<?php

namespace App\Manager;

use App\Entity\Composition;

class CompositionManager {
    
    public function insertCompositionToDatabase($compositions, $manager)
    {
        $savedData = $updatedData = 0;

        foreach($compositions as $composition) {
            $compo = $manager->getRepository(Composition::class)->getCompositionByCIS($composition[0]);
            
            if(is_null($compo)) {
                $savedData += self::fillCompositionData(New Composition(), $composition, $manager);
            } else {
                $updatedData += self::fillCompositionData($compo, $composition, $manager);
            }
            sleep(1);
        }

        return [
            "saved" => $savedData,
            "updated" => $updatedData
        ];
    }

    public function fillCompositionData($composition, $compositionData, $manager)
    {
        $composition->setCodeCIS($compositionData[0]);
        $composition->setDesignationPharmaceuticalElement($compositionData[1]);
        $composition->setSubstanceCode($compositionData[2]);
        $composition->setSubstanceDenomination($compositionData[3]);
        $composition->setSubstanceDosage($compositionData[4]);
        $composition->setDosageReference($compositionData[5]);
        $composition->setComponentNature($compositionData[6]);
        $composition->setNumLink($compositionData[7]);
        $composition->setOtherData($compositionData[8]);

        $manager->persist($composition);
        $manager->flush();

        return 1;
    }
}