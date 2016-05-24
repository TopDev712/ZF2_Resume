<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Service\JobSearchService;


class AdminController extends AbstractActionController
{

    public function indexAction()
    {
       return new ViewModel();
    }
    
    public function registerAction()
    {
    	return new ViewModel();
    }

    public function searchAction()
    {
    	return new ViewModel(array('search'=>$this->params()->fromPost()));
    }
    public function dashboardAction()
    {
    	return new ViewModel();
    }

    /**
     * @return JobSearchService
     */
    private function getJobSearchService()
    {
        return $this->getServiceLocator()->get("jobSearchService");
    }

}