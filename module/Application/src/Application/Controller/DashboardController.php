<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Application\Service\JobSearchService;
use Zend\Json\Json;

class DashboardController extends AbstractBaseController
{

    public function indexAction()
    {
    	//populate jobs based on the logic
    	/*If the User has existing Job Alert, pull up the latest Job Alert
    	Else If User has search history tied to the User. Execute the most recent job search
    	ELSE If >> Leave dashboard blank, provide message saying, Please conduct a search <<*/
    	
    	$user = $this->getCurrentUser();
    	$jobAlerts = $this->getJobAlertService()->getRecentJobAlert($user);
    	$userObj =$this->getEntityManager()->getRepository('Application\Entity\User')->find($user->getId());
    	$page = $this->params('page',1);
    	
    	if(count($jobAlerts)>0 )
    	{
    		$params = (array)Json::decode($jobAlerts['settingJson']);
    		$title = $params['title'];
    		$location = $params['location'];
    		$radius = isset($params['radius_miles'])?$params['radius_miles']:'';    		
    		
    		$jobs = $this->getJobSearchService()->search($title,$location ,$page,$userObj,$radius);    		
    		$message='Search results from job alert';
    	}else{
    		$searchHistory = $this->getJobSearchService()->getRecentJobSearchHistory($user);
    		if(count($searchHistory)){
    			$params = explode('&', urldecode($searchHistory['keyword']));
    			$title = end(explode('=',$params[0]));
    			$location = end(explode('=',$params[1]));
    			$radius = end(explode('=',$params[2]));;
    			
    			$jobs = $this->getJobSearchService()->search($title,$location ,$page,$userObj,$radius);    			
    			$message='Search results from search history';
    		}else{
    			$message='Please conduct your first job search.';
    		}
    		
    	}
    	return new ViewModel(array('jobs'=>$jobs,'message'=>$message ));
    }

    /**
     * @return JobSearchService
     */
    private function getJobSearchService()
    {
        return $this->serviceLocator->get("jobSearchService");
    }

    /**
     * @return JobSearchService
     */
    private function getJobAlertService()
    {
    	return $this->serviceLocator->get("jobAlertService");
    }
}