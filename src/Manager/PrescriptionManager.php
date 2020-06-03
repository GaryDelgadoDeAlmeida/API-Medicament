<?php

namespace Manager;

use App\Entity\PrescriptionCondition;

class PrescriptionManager {
    
    public function insertPrescriptionToDatabase($prescriptions, $manager)
    {
        $saved = $updated = 0;

        foreach($prescriptions as $prescription) {
            $pres = $manager->getRepository(PrescriptionCondition::class)->getPrescriptionByCodeCIS($prescription[0]);

            if(is_null($pres)) {
                $pres = new PrescriptionCondition();
                $pres->setCodeCIS($prescription[0]);
                $saved += self::fillPrescriptionData($pres, $prescription, $manager);
            } else {
                $updated += self::fillPrescriptionData($pres, $prescription, $manager);
            }

            sleep(1);
        }

        return [
            "saved" => $saved,
            "updated" => $updated
        ];
    }

    private function fillPrescriptionData($pres, $prescription, $manager)
    {
        $pres->setConditions($prescription[1]);
        
        $manager->persist($pres);
        $manager->flush();

        return 1;
    }
}