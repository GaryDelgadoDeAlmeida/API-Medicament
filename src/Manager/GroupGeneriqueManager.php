<?php

namespace Manager;

use App\Entity\GroupGenerique;

class GroupGeneriqueManager {

    public function insertGroupToDatabase($groupGenerique, $manager)
    {
        $saved = $updated = 0;

        foreach($groupGenerique as $generique) {
            $gene = $manager->getRepository(GroupGenerique::class)->getOneGroupGenerique($generique[0], $generique[2]);

            if(is_null($gene)) {
                $saved += self::fillGroupGeneriqueData(new GroupGenerique(), $generique, $manager);
            } else {
                $updated += self::fillGroupGeneriqueData($gene, $generique, $manager);
            }
            sleep(1);
        }

        return [
            "saved" => $saved,
            "updated" => $updated
        ];
    }

    private function fillGroupGeneriqueData($gene, $generique, $manager)
    {
        $gene->setIdGroupGenerique(intval($generique[0]));
        $gene->setNameGroupeGenerique($generique[1]);
        $gene->setCodeCIS(intval($generique[2]));
        $gene->setTypeGenerique(intval($generique[3]));
        $gene->setNumTri(intval($generique[4]));
        $gene->setOtherData($generique[5]);
        
        $manager->persist($gene);
        $manager->flush();
        return 1;
    }
}