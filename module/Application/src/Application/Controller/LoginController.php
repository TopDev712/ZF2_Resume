<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Service\JobSearchService;


class LoginController extends AbstractActionController
{

    public function indexAction()
    {
    	if($this->getAuthService()->hasIdentity()){
    		return $this->redirect()->toUrl('dashboard');
    	}
       return new ViewModel();
    }
    /**
     * @return AuthService
     */
    private function getAuthService()
    {
    	return $this->getServiceLocator()->get("AuthService");
    }

}