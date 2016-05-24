<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Application\Util\CryptUtil;

class ResetPasswordController extends AbstractBaseController {
	public function indexAction() {
		//check post
		if ($this->getRequest ()->isPost ()) {
			
			//check whether valid token passed
			if ($data = $this->getResetPasswordService ()->getUserByToken ( $this->params ()->fromPost ( 'resetToken' ) )) {
				
				//verfication of user data
				if ($data->getUser ()->getId () == $this->params ()->fromPost ( 'id' ) && $data->getUserName () == $this->params ()->fromPost ( 'username' )) {
					
					//set password
					$postData = $this->params ()->fromPost ();
					$postData['password']= CryptUtil::onewayEncrypt($postData['password']);
					if ($this->getResetPasswordService ()->update ( $data, $postData )) {
						$status = 'PasswordChanged';
					} else {
						$status = 'PasswordChangeFailed';
					}
				}else{
					$status = 'PasswordChangeFailed';
				}
			} else {
				$status = 'PasswordChangeFailed';
			}
			
		} else {
			//reset token validation
			if ($data = $this->getResetPasswordService ()->getUserByToken ( $this->params ( 'id' ) )) {
				$status = 'GetResetToken';
			} else {
				$data = null;
				$status = 'InvalidToken';
			}
		}
		return new ViewModel ( array (
				'data' => $data,
				'status' => $status 
		) );
	}
	
	/**
	 *
	 * @return ResetPasswordService
	 */
	private function getResetPasswordService() {
		return $this->getServiceLocator ()->get ( "ResetPasswordService" );
	}
}