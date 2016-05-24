<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;

class ForgotPasswordController extends AbstractBaseController {
	public function indexAction() {
    	return new ViewModel();
	}
	
	/**
	 *
	 * @return ResetPasswordService
	 */
	private function getResetPasswordService() {
		return $this->getServiceLocator ()->get ( "ResetPasswordService" );
	}
}