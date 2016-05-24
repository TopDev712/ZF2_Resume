<?php

namespace Application\Api\Controller;

use Application\Util\CryptUtil;
use Application\Service\LoginAuditService;
use Application\Entity\UserLoginAudit;

class AuthApiController extends AbstractBaseApiController {
	
	public function create($params) {
		
		if (isset ( $params ["provider"] ) && isset ( $params ["email"] ) && isset ( $params ["password"] )) {
			
			$this->getAuthService ()->getAdapter ()->setAuthProvider ( $params ["provider"] )->setIdentity ( $params ["email"] )->setCredential ( CryptUtil::onewayEncrypt ( $params ["password"] ) );
			
			$result = $this->getAuthService ()->authenticate ();
		
			if ($result->isValid ()) {
				
				//$authenticationStatus = UserLoginAudit::LOGIN_SUCESS;
				$userAuthentication = $this->getUserAuthentication();
				$loginAuditService = $this->getLoginAuditService ();
				$loginAuditService->logSuccess ( new \DateTime (), $userAuthentication);
				
				return $this->writeJsonResponse ( array (
						"status" => "Successful" 
				) );
				
			} else {
				/* $authenticationStatus = UserLoginAudit::LOGIN_FAIL;
				$userAuthentication = $this->getUserAuthentication();
				if($userAuthentication!=null){	
					$loginAuditService = $this->getLoginAuditService ();
					$loginAuditService->logSuccess ( new \DateTime (), $userAuthentication);
				} */				
				return $this->writeJsonResponse ( array (
						"status" => "Failed",
						"message" => "Invalid credentials" 
				) );
			}
		} else {
			return $this->writeJsonResponse ( array (
					"status" => "Failed",
					"message" => "Invalid credentials" 
			) );
		}
	}
	
	/**
	 *
	 * @return LoginAuditService
	 */
	private function getLoginAuditService() {
		return $this->serviceLocator->get ( 'loginAuditService' );
	}
	
	/**
	 *
	 * @return getUserAuthentication
	 */
	private function getUserAuthentication(){
		$user = $this->getEntityManager ()->find ( 'Application\Entity\User', $this->getCurrentUser ()->getId ());
		return $this->getEntityManager ()->createQuery ( "select ua
            from \Application\Entity\UserAuthentication ua
            where ua.user = :userId " )->setParameter ( "userId", $user )->getSingleResult ();
	
	}
	
	
}