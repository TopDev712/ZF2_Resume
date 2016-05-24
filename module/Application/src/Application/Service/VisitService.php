<?php

namespace Application\Service;

use Application\Entity\Visit;

class VisitService extends AbstractService
{


    public function logVist($ip, $ua, $refUrl, $promoCode)
    {
        $visit = new Visit();
        $visit->setIp($ip);
        $visit->setReferenceUrl($refUrl);
        $visit->setUserAgent($ua);
        $visit->setRefPromoCode($promoCode);
        $visit->setDateTimeCreated(new \DateTime());
        $repo = $this->getEntityManager()->getRepository("\Application\Entity\Visit");
        $repo->save($visit);
    }

}