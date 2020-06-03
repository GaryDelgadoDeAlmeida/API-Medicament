<?php

namespace App\Manager;

use App\Entity\Medicament;

class MedicamentManager {
    
    private function insertMedicament($data, $manager)
    {
        $medicament = new Medicament();
        $medicament->setId(intval($data[0]));
        $medicament->setDenomination($data[1]);
        $medicament->setPharmaceuticalForm($data[2]);
        $medicament->setAdministrationRoutes($data[3]);
        $medicament->setAuthorizationStatus($data[4]);
        $medicament->setProcedureType($data[5]);
        $medicament->setMarketingStatus($data[6]);
        $medicament->setDate(new \DateTime(str_replace("/", '-', $data[7])));
        $medicament->setBdmStatus($data[8]);
        $medicament->setEuropeanAuthorizationNumber($data[9]);
        $medicament->setHolder(trim($data[10]));
        $medicament->setReinforcedSurveillance($data[11] == "Oui" ? true : false);
        $manager->persist($medicament);
        $manager->flush();

        return 1;
    }

    private function updateMedicament($medicament, $value, $manager)
    {
        $medicament->setDenomination($value[1]);
        $medicament->setPharmaceuticalForm($value[2]);
        $medicament->setAdministrationRoutes($value[3]);
        $medicament->setAuthorizationStatus($value[4]);
        $medicament->setProcedureType($value[5]);
        $medicament->setMarketingStatus($value[6]);
        $medicament->setBdmStatus($value[8]);
        $medicament->setEuropeanAuthorizationNumber($value[9]);
        $medicament->setReinforcedSurveillance($value[11] == "Oui" ? true : false);
        $manager->persist($medicament);
        $manager->flush();

        /** Data who not Change */
        // $medicament->setDate(new \DateTime(str_replace("/", '-', $value[7])));
        // $medicament->setHolder(trim($medicament["stringData"][10]));

        return 1;
    }

    public function insertMedicamentToDatabase($data, $manager)
    {
        $savedData = $updatedData = 0;
        
        foreach($data as $value) {
            $medicament = $manager->getRepository(Medicament::class)->getMedicamentByID($value[0]);

            if(is_null($medicament)) {
                $savedData += self::insertMedicament($value, $manager);
            } else {
                $updatedData += self::updateMedicament($medicament, $value, $manager);
            }
            sleep(1);
        }

        return [
            "saved" => $savedData,
            "updated" => $updatedData
        ];
    }
}