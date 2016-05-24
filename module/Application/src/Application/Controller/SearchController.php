<?php

namespace Application\Controller;


use Application\Service\JobSearchService;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class SearchController extends AbstractBaseController
{

    public function indexAction()
    {
    	
    	//if user logged in
    	if($this->getCurrentUser()){
    		$user = $this->getEntityManager()->find('Application\Entity\User', $this->getCurrentUser()->getId());
    	}else{
    		$user = null;
    	}
    	
    	if ($this->getRequest()->isPost()) {
    		return new ViewModel(array('search'=>$this->params()->fromPost()));
    	}else {
    		$param = $this->params ()->fromQuery ();
    		if (isset ( $param ['landing_page'] ) && ! empty ( $param ['landing_page']) || isset($param ['type'] ) && ! empty ( $param ['type'])) {
    			
    			$jobSearchService = $this->getJobSearchService ();
    			$page = !empty($param ["page"]) ? $param ["page"] : 1;
    			$itemPerPage= 20;
    			
    			if( !empty ( $param ['landing_page'])){
    			
    			$jobSearchAttributes = $jobSearchService->getSearchAttributes ( $param ['landing_page'] );
    			
    			if (count ( $jobSearchAttributes )) {
    				$title = $this->getTerm ( trim ( $jobSearchAttributes->getGjq () ) );
    				$location = $this->getLocation ( trim ( $jobSearchAttributes->getGjl () ) );
    				$radius = $this->getRadius ( "" );
    				$pageTitle = $jobSearchAttributes->getPageTitle ();
    				$metaKeyword = $jobSearchAttributes->getPageMetaKeywords ();
    				$metaDescription = $jobSearchAttributes->getPageMetaDescription();
    				$primaryKeyWorkPhrase = $jobSearchAttributes->getPrimaryKeywordPhrase();
    			}
    			}
    			else {
    				$title = $this->getTerm ( $param ["term"] );
    				$location = $this->getTerm ( $param ["location"] );
    				$radius = $this->getRadius ("");
    			}
    			
    		
    			$jobs = $jobSearchService->search ( $title, $location, $page, $user, $radius );
    			
    			$arrayAdapter = new ArrayAdapter($jobs->jobs);
    			$arrayAdapter->setCount($jobs->total_jobs);
    			$paginator = new Paginator($arrayAdapter);
    			 
    			$paginator->setPageRange(5);
    			$paginator->setCurrentPageNumber($param ["page"]);
    			$paginator->setItemCountPerPage($itemPerPage); 
    		
    			$view = new ViewModel ( array (
    					"statusCode" => 1,
    					"status" => "Successful",
    					"result" => $jobs,
    					"term" => $title,
    					"location" => $location,
    					"pageTitle" => $pageTitle,
    					"metaKeyword" => $metaKeyword ,
    					"metaDescription" => "Jobs " .$page . " to " . $itemPerPage . " of " .  $jobs->total_jobs .  " " . $primaryKeyWorkPhrase . " jobs in " . $location . ". " . $metaDescription,
    					"primaryKeyWorkPhrase" => $primaryKeyWorkPhrase,
    					"currentPage" =>$page ,
    					"paginator" => $paginator,
    					"startPosition" => (($page-1)*$itemPerPage)+1,
    					"endPosition"=>  ($jobs->total_jobs < $page*$itemPerPage ? $jobs->total_jobs : $page*$itemPerPage)
    					
    			) );
    		
    			$view->setTemplate ( "application/ssearch/index.phtml");
    			return $view;
    		}else{
    			return new ViewModel(array('search'=>$this->params()->fromQuery()));
    		}
    	}
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