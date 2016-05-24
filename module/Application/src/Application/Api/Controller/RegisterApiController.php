<?php

namespace Application\Api\Controller;

use Application\Service\UserRegistrationService;
use Application\Util\CryptUtil;

class RegisterApiController extends AbstractBaseApiController
{
	public function getList()
	{
		return $this->writeJsonResponse(array("status" => "405", "message" => 'method not allowed'));
	}

    public function create($params)
    {
    	//get service object
    	$userRegistrationService = $this->getUserRegistrationService();
    
    	//get data
    	$requestData = $params;
    
    	//provider hardcode, need to implement social media registration
    	$requestData['provider'] = isset($requestData['provider'])?$requestData['provider']:'EMAIL';
    	 
    	//reset token
    	$resetToken = CryptUtil:: generateToken(10,true);
    	$requestData['resetToken'] = $resetToken;
    
    	//user registeration
    	$user = $userRegistrationService->register($requestData);
    
    	//user registeration email
    	if($user['status']=='Successful'){
    		//weburl
    		$requestData['resetLink'] = sprintf('%s://%s/%s/%s', $this->getRequest()->getUri()->getScheme(), $this->getRequest()->getUri()->getHost(),'reset-password/index',$resetToken);
    		$content = $this->getEmailService()->getRegisterEmailContent($requestData);
    		$this->getEmailService()->registrationEmail($requestData['email'],'Registration Success',$content);
    	}
    
    	//alert registeration
    	if($requestData['title'] && $user['status']=='Successful'){
    		$radius = isset($requestData['radius'])?$requestData['radius']:25;
    		if($this->getJobAlertService()->create($user['data']['obj']['jobseeker'],$requestData['title'],$requestData['location'],$radius))
    		{
    			$user['data']['alert']=array('statusCode'=>1,'status'=>'Successful','message'=>'Job alert registered successfully');
    		}else{
    			$user['data']['alert']=array('statusCode'=>1,'status'=>'Failed','message'=>'Job alert registration failed');
    		}
    		unset($user['data']['obj']['jobseeker']);
    	}
    
    	return $this->writeJsonResponse(array(
    			"statusCode" => $user['statusCode'], "status" => $user['status'], "result" => $user['data'],"message" => $user['message'],
    	));
    }
    
    /**
     * @return UserRegistrationService
     */
    private function getUserRegistrationService()
    {
    	return $this->getServiceLocator()->get("UserRegistrationService");
    }
    
    /**
     * @return AlertService
     */
    private function getJobAlertService()
    {
    	return $this->getServiceLocator()->get("JobAlertService");
    }
    
    /**
     * @return EmailService
     */
    private function getEmailService()
    {
    	return $this->getServiceLocator()->get("EmailService");
    }
}