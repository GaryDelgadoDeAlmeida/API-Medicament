<?php

namespace Manager;

use App\Entity\InfoImportant;

class InfoImportantManager {
    
    public function insertInfoToDatabase($infoImportant, $manager)
    {
        $saved = $updated = 0;

        foreach($infoImportant as $information) {
            $info = $manager->getRepository(InfoImportant::class)->getInfoByCodeCIS($information[0]);

            if(is_null($info)) {
                $info = new InfoImportant();
                $info->setCodeCIS($information[0]);
                $saved += self::fillInfoData($info, $information, $manager);
            } else {
                $updated += self::fillInfoData($info, $information, $manager);
            }
            sleep(1);
        }
        
        return [
            "saved" => $saved,
            "updated" => $updated
        ];
    }

    private function fillInfoData($info, $information, $manager)
    {
        $info->setDateStartSecurityInfo(new \DateTime(str_replace('/', '-', $information[1])));
        $info->setDateEndSecurityInfo(new \DateTime(str_replace('/', '-', $information[2])));
        $info->setAdditionalInfo($information[3]);

        $manager->persist($info);
        $manager->flush();
        
        return 1;
    }
}