<?php

namespace Manager;

use App\Entity\PageLinkCT;

class PageLinkManager {

    public function insertPageLinkToDatabase($pageLinkTab, $manager)
    {
        $saved = $updated = 0;

        foreach($pageLinkTab as $pageLink) {
            $pl = $manager->getRepository(PageLinkCT::class)->getPageLinkByCodeCIS($pageLink[0]);

            if(\is_null($pl)) {
                $saved += self::fillPageLinkData(new PageLinkCT(), $pageLink, $manager);
            } else {
                $updated += self::fillPageLinkData($pl, $pageLink, $manager);
            }
            \sleep(1);
        }
        return [
            "saved" => $saved,
            "updated" => $updated
        ];
    }

    private function fillPageLinkData($pl, $pageLink, $manager)
    {
        $pl->setCodeHAS($pageLink[0]);
        $pl->setLinkUrl($pageLink[1]);
        $manager->persist($pl);
        $manager->flush();
        return 1;
    }
}