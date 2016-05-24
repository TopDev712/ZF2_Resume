<?php

namespace Application\Api\Controller;

use Application\Util\CryptUtil;

class ChangePasswordApiController extends AbstractBaseApiController
{

    public function create($params)
    {
        if (isset($params["password"]) && $this->getCurrentUser()->getId()) {
        	$userAuthObj = $this->getEntityManager()->getRepository('Application\Entity\UserAuthentication')->findOneBy(
    				array('user' => $this->getCurrentUser()->getId())
    				);
        	$password = CryptUtil::onewayEncrypt($params["password"]);
        	if($this->getResetPasswordService()->update($userAuthObj,array('password'=>$password)))
        	{
        		return $this->writeJsonResponse(array("status" => "Successful" ,"message" => "Password changed successfully"));
        	}else{
        		return $this->writeJsonResponse(array("status" => "Failed", "message" => "Password change failed"));
        	}
        } else {
            return $this->writeJsonResponse(array("status" => "Failed" ,"message" => "Authendication failed"));
        }
    }
    /**
     * @return ResetPasswordService
     */
    private function getResetPasswordService()
    {
    	return $this->serviceLocator->get("ResetPasswordService");
    }
}