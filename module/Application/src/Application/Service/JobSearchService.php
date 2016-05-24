<?php

namespace Application\Service;

use Application\Entity\UserSearchHistory;
use Application\Util\HttpClient;
use Application\Util\ZipRecruiter;
use Zend\Json\Json;

class JobSearchService extends AbstractService
{
    public function search($term, $location=US, $page=1, $user = null, $radius_miles=25)
    {
        // We only log a search if the page passed in is the first page, meaning a new search was conducted
		// when existing searches are done and multiple pages are navigated too, we want to ignore that
		// as that is not a new search.  However the interaction of flipping through pages can be tracked viea MP
		if($page==1)
		{
			//Log Search Audit
			$searchHistory = new UserSearchHistory();
			// by default we are enforcing a 25 mile radius of location
			$searchHistory->setKeyword("term=" . urlencode($term) . "&location=" . urlencode($location) . "&radius_miles=" . urlencode($radius_miles));
			$searchHistory->setUser($user);
			$searchHistory->setDateTimeCreated(new \DateTime());
			$this->getEntityManager()->persist($searchHistory);
			$this->getEntityManager()->flush();
		}
		
		// by default we are enforcing a 25 mile radius of location
        //$url = ZipRecruiter::$SEARCH_URL . "?api_key=" . ZipRecruiter::$API_KEY . "&search=" . urlencode($term) . "&location=" . urlencode($location)."&page=".$page . "&radius_miles=25";
        $url = ZipRecruiter::$SEARCH_URL . "?api_key=" . ZipRecruiter::$API_KEY . "&search=" . urlencode($term) . "&location=" . urlencode($location)."&page=".$page . "&radius_miles=" . urlencode($radius_miles);
        $httpClient = new HttpClient();
        $response = $httpClient->get($url);
        if ($response["statusCode"] == "200") {
            $responseObj = Json::decode($response["data"]);
			if ($responseObj->success) {
                return $responseObj;
            }
        }
        return null;
    }
    
    public function getRecentJobSearchHistory($user)
    {
    	$userObj =$this->getEntityManager()->getRepository('Application\Entity\User')->find($user->getId());
    
    	$searchHistory = $this->getEntityManager()->getRepository('Application\Entity\UserSearchHistory')->findOneBy(array('user'=>$userObj),array('id' => 'DESC'));
    	if($searchHistory){
    		return $searchHistory->toArray();
    	}else{
    		return null;
    	}
    	    
    }
    public function getSearchAttributes($landingPage)
    {
    
    	$searchHistory = $this->getEntityManager()->createQueryBuilder()->select('usrTemp')
    	->from("Application\Entity\URLTemplate", 'usrTemp')
    	->where('usrTemp.landingPage=:lpage')
    	->setParameter('lpage', $landingPage)
    	->setMaxResults(1)
    	->getQuery()
    	->getOneOrNullResult();
    
    	if($searchHistory){
    		//return $searchHistory->toArray();
    		return $searchHistory;
    	}else{
    		return null;
    	}
    
    }
    
    
}