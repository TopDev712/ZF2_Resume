<?php

namespace Application\Api\Controller;

use Application\Util\CryptUtil;
use Zend\Json\Json;

class ForgotPasswordApiController extends AbstractBaseApiController
{
    public function create($params)
    {    
    	if(isset($params['email']) && $params['email']){
    		$user = $this->getEntityManager()->getRepository('Application\Entity\User')->findOneBy(
    				array('email' => $params['email'])
    				);
    		if($user)
    		{
    			//reset token
    			$resetToken = CryptUtil:: generateToken(10,true);
    			 
    			//weburl
    			$data['resetLink'] = sprintf('%s://%s/%s/%s', $this->getRequest()->getUri()->getScheme(), $this->getRequest()->getUri()->getHost(),'reset-password/index',$resetToken);
    			$data['name'] = $user->getFirstName().' '.$user->getLastName();
    			$data['email'] = $user->getEmail();
    			$data['resetToken'] = $resetToken;
    			 
    			$userAuthendication = $this->getEntityManager()->getRepository('Application\Entity\UserAuthentication')->findOneBy(
    					array('userName' => $params['email'])
    					);
    			 
    			$this->getResetPasswordService()->updateToken($userAuthendication,$data);
    			
    			$content = $this->getEmailService()->getForgotEmailContent($data);
    			$this->getEmailService()->registrationEmail($data['email'],'Reset Password',$content);
    			return $this->writeJsonResponse(array(
    					"statusCode" => 1, "status" => "Successful", "result" => "Email sent"
    			));
    		}else{
    			return $this->writeJsonResponse(array(
    					"statusCode" => 0, "status" => "Failed", "result" => 'User not found'
    			));
    		}
    		
    	}else{
    		
    		return $this->writeJsonResponse(array(
    				"statusCode" => 1, "status" => "Failed", "result" => 'Invalid params'
    		));
    	}
    	
    }
    
    public function getList()
    { 
    	if($this->params('email')){
    		$params['email']=$this->params('email');
    		 
    		$user = $this->getEntityManager()->getRepository('Application\Entity\User')->findOneBy(
    				array('email' => $params['email'])
    				);
    		//reset token
    		$resetToken = CryptUtil:: generateToken(10,true);
    		 
    		//weburl
    		$data['resetLink'] = sprintf('%s://%s/%s/%s', $this->getRequest()->getUri()->getScheme(), $this->getRequest()->getUri()->getHost(),'reset-password/index',$resetToken);
    		$data['name'] = $user->getFirstName().' '.$user->getLastName();
    		$data['email'] = $user->getEmail();
    		$data['resetToken'] = $resetToken;
    		 
    		$userAuthendication = $this->getEntityManager()->getRepository('Application\Entity\UserAuthentication')->findOneBy(
    				array('userName' => $params['email'])
    				);
    		 
    		$this->getResetPasswordService()->updateToken($userAuthendication,$data);
    		
    		$content = $this->getEmailService()->getForgotEmailContent($data);
    		$this->getEmailService()->registrationEmail($data['email'],'Reset Password',$content);
    		return $this->writeJsonResponse(array(
    				"statusCode" => 1, "status" => "Successful", "result" => $content
    		));
    	}
    	
    	return $this->writeJsonResponse(array("status" => "405", "message" => 'method not allowed'));
    }
    
    /**
     * @return EmailService
     */
    private function getEmailService()
    {
    	return $this->getServiceLocator()->get("EmailService");
    }
    /**
     * @return EmailService
     */
    private function getResetPasswordService()
    {
    	return $this->getServiceLocator ()->get ( "ResetPasswordService" );
    }
}