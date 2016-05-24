<?php

namespace Application\Service;

use Application\Entity\UserJobClick;
use Zend\Json\Json;

class UserJobClickService extends AbstractService
{
    public function save($job, $userSearchHistory = null)
    {
        //Log User Click Audit
        $userJobClick = new UserJobClick();
        $userJobClick->setJobJson(Json::encode($job));
        $userJobClick->setUserSearchHistory($userSearchHistory);
        $userJobClick->setDateTimeCreated(new \DateTime());
        $this->getEntityManager()->persist($userJobClick);
        $this->getEntityManager()->flush();
        return null;
    }
    
    

}