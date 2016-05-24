<?php

namespace Application\Api\Controller;
use Application\Service\UserJobClickService;

class UserJobClickApiController extends AbstractBaseApiController
{
    public function create($params)
    {

    	if($this->getCurrentUser()){
    		$user = $this->getEntityManager()->find('Application\Entity\User', $this->getCurrentUser()->getId());

    	 $userSearchHistory = $this->getEntityManager()->createQueryBuilder()->select('sub')
    	->from("Application\Entity\UserSearchHistory", 'sub')
    	->where('sub.user=:isSubscribe')
    	->setParameter('isSubscribe', $user->getId())
    	->setMaxResults(1)
    	->orderBy('sub.id','DESC')
    	->getQuery()
    	->getOneOrNullResult();

    	$userJobClickService = $this->getUserJobClickService();
		$userJobClickService->save($params["job"], $userSearchHistory);
    	}
    	return $this->writeJsonResponse(array(
    			"statusCode" => 1, "status" => "Successful", "result" => null
    	));
    }

    /**
     * @return UserJobClickService
     */
    private function getUserJobClickService()
    {
    	return $this->serviceLocator->get('userJobClickService');
    }
}