<?php

namespace App\Manager;

use App\Entity\Presentation;

class PresentationManager {
    
    public function insertPresentation($value, $manager)
    {
        $collectivityAgreement = ($value[7] == "oui") ? 1 : ($value[7] == "non") ? 0 : -1;

        $presentation = new Presentation();
        $presentation->setCodeCIS(intval($value[0]));
        $presentation->setCodeCIP(intval($value[1]));
        $presentation->setName($value[2]);
        $presentation->setAdministrationStatus($value[3]);
        $presentation->setMarketingStatus($value[4]);
        $presentation->setMarketingDate(new \DateTime(str_replace("/", '-', $value[5])));
        $presentation->setCodeCIP13(intval($value[6]));
        $presentation->setCollectivityAgreement($collectivityAgreement);
        $presentation->setRepaymentPercentageRate(floatval(str_replace(",", ".", $value[8])));
        $presentation->setMedicationPrice([
            floatval(str_replace(",", ".", $value[9])),
            floatval(str_replace(",", ".", $value[10])),
            floatval(str_replace(",", ".", $value[11]))
        ]);
        $presentation->setIndicationRepaymentRight($value[12]);
        $manager->persist($presentation);
        $manager->flush();

        return 1;
    }

    public function updatePresentation($presentation, $value, $manager)
    {
        $collectivityAgreement = ($value[7] == "oui") ? 1 : ($value[7] == "non") ? 0 : -1;

        $presentation->setCodeCIS(intval($value[0]));
        $presentation->setCodeCIP(intval($value[1]));
        $presentation->setName($value[2]);
        $presentation->setAdministrationStatus($value[3]);
        $presentation->setMarketingStatus($value[4]);
        $presentation->setMarketingDate(new \DateTime(str_replace("/", '-', $value[5])));
        $presentation->setCodeCIP13(intval($value[6]));
        $presentation->setCollectivityAgreement($collectivityAgreement);
        $presentation->setRepaymentPercentageRate(floatval(str_replace(",", ".", $value[8])));
        $presentation->setMedicationPrice([
            floatval(str_replace(",", ".", $value[9])),
            floatval(str_replace(",", ".", $value[10])),
            floatval(str_replace(",", ".", $value[11]))
        ]);
        $presentation->setIndicationRepaymentRight($value[12]);
        $manager->persist($presentation);
        $manager->flush();
        return 1;
    }

    public function insertPresentationToDatabase($presentations, $manager)
    {
        $savedData = $updatedData = 0;
        
        foreach($presentations as $presentation) {
            $pres = $manager->getRepository(Presentation::class)->getPresentationByCIS($presentation[0]);
            if(is_null($pres)) {
                $savedData += self::insertPresentation($presentation, $manager);
            } else {
                $updatedData += self::updatePresentation($pres, $presentation, $manager);
            }
            sleep(1);
        }

        return [
            "saved" => $savedData,
            "updated" => $updatedData
        ];
    }
}