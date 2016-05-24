<?php

namespace Application\Api\Controller;

use Application\Service\JobSearchService;

class SearchApiController extends AbstractBaseApiController
{
    public function create($params)
    {
    	//if user logged in
    	if($this->getCurrentUser()){
    		$user = $this->getEntityManager()->find('Application\Entity\User', $this->getCurrentUser()->getId());
    	}else{
    		$user = null;
    	}
    	
    	$jobSearchService = $this->getJobSearchService();
    	//$jobs = $jobSearchService->search($params["term"], $params["provider"],$params["page"],$user);
		// Incorrect parameter name was used above, changed provider --> location
		// We have to check if the radius parameter is set and if it is if its not empty we pass it in, otherwise we send in null instead
		
    	$title =  $this->getTerm($params["term"]);
    	$location = $this->getLocation($params["location"]);
    	$radius = $this->getRadius($params["radius"]);

    	if(isset($params['landing_page']) && !empty($params['landing_page'])){
    	
    		$jobSearchAttributes = $jobSearchService->getSearchAttributes($params['landing_page']);
    	
    		if(count($jobSearchAttributes)){
    			$title = $this->getTerm(trim($jobSearchAttributes->getGjq()));
    			$location = $this->getLocation(trim($jobSearchAttributes->getGjl()));
    			$radius = $this->getRadius("");
    			$pageTitle = $jobSearchAttributes->getPageTitle();
    			$metaKeyword = $jobSearchAttributes->getPageMetaKeywords();
    			
    		}
    	}

    	$jobs = $jobSearchService->search($title, $location,$params["page"],$user, $radius);
		
    	return $this->writeJsonResponse(array(
    			"statusCode" => 1, "status" => "Successful", "result" => $jobs, "term"=>$title, "location"=>$location
    	,"pageTitle"=>$pageTitle,"metaKeyword"=>$metaKeyword, 'radius' => $radius));
    }
    
    public function getList()
    {  
    	return $this->writeJsonResponse(array("status" => "405", "message" => 'method not allowed'));
    }
    
    /**
     * @return JobSearchService
     */
    private function getJobSearchService()
    {
    	return $this->serviceLocator->get("jobSearchService");
    }
    
	private function getLocation($location) {
		// Handle default location if the Location parameter is empty
		if (isset( $location ) && !empty( $location )  && $location!="NULL" && $location!="null")
			return $location;
		else
			return $location = "US";
	}
	private function getRadius($radius) {
		// Handle default radius if the radius parameter is empty
		if (isset ( $radius ) && ! empty ( $radius ) && $radius!="NULL" && $radius!="null")	
			return $radius;
		else
			return $radius = 25;
	}
	private function getTerm($term) {
		// Handle default term if the term parameter is empty
		// if($term) && !empty($term)
		return $term;
		// else
		// return $term = "";
	}
}