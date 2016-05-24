<?php

namespace Application\Api\Controller;

class ProfileApiController extends AbstractBaseApiController
{
	public function getList()
	{
		return $this->writeJsonResponse(array("status" => "405", "message" => 'method not allowed'));
	}

    public function create($params)
    {
    	$user_type = isset($params['user_type'])?$params['user_type']:'JOB_SEEKER';
    	if($user_type=='JOB_SEEKER'){
    		$jobseeker = $this->getEntityManager()->getRepository('Application\Entity\JobSeeker')->findOneBy(
    				array('id' => $this->getCurrentUser()->getJobSeeker()->getId())
    				);
    		
    		// update only profile name
    		if(isset($params['pk']) && $params['pk']==1)
    		{
    			$user = $this->getEntityManager()->getRepository('Application\Entity\User')->find($this->getCurrentUser()->getId());
    			
    			if(isset($params['value'])){
    				//firstname,lastname extraction logic
    				$nameArray = explode(' ',trim($params['value']));
    				if(count($nameArray)>1){
    					$data['lastName'] = end($nameArray);
    					array_pop($nameArray);
    					$data['firstName'] =  implode(' ',$nameArray);
    				}else{//if last name not found
    					$data['firstName'] = end($nameArray);
    					$data['lastName']='';
    				}
    			}
    			
    			if($this->getProfileService()->updateProfile($user,$data)){    		
    				$this->getCurrentUser()->setFirstName($data['firstName']);
    				$this->getCurrentUser()->setLastName($data['lastName']);
    				$response = array('status'=>'Successful','message'=>'Name updated successfully');
    			}else{
    				$response = array('status'=>'Failed','message'=>'Name update failed');
    			}
    		}else{//update job seeker profile
    			if($this->getProfileService()->updateJobseeker($jobseeker,$params)){
    				$response = array('status'=>'Successful','message'=>'Profile updated successfully');
    			}else{
    				$response = array('status'=>'Failed','message'=>'Profile update failed');
    			}
    		}
    		
    	}    	
    	return $this->writeJsonResponse($response);
    }
    
    /**
     * @return ProfileService
     */
    private function getProfileService()
    {
    	return $this->getServiceLocator()->get("ProfileService");
    }
}