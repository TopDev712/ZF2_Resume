<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;

class RegisterController extends AbstractBaseController
{

    public function indexAction()
    { 
    	if($this->getAuthService()->hasIdentity()){
    		return $this->redirect()->toUrl('dashboard');
    	}
    	return new ViewModel();
    }    

}