<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;




class LogoutController extends AbstractActionController
{

    public function indexAction()
    {
    	if($this->getAuthService()->hasIdentity()){
    		$this->getAuthService()->clearIdentity();
    		return $this->redirect()->toUrl('login');
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