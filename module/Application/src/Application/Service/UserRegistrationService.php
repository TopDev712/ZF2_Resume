<?php

namespace Application\Service;

use Application\Entity\User;
use Application\Entity\UserAuthentication;
use Application\Util\HttpClient;
use Zend\Json\Json;
use Zend\Form\Annotation\Object;
use Application\Entity\JobSeeker;

class UserRegistrationService extends AbstractService
{
    public function register($data)
    { 
    	//initializations    	
    	$status = null;
    	$status_code=null;
    	$response_data=null;
    	$message = null;
    	
    	//if email param available
    	if(isset($data['email']))
    	{
    		$user = $this->getEntityManager()->getRepository('Application\Entity\User')->findOneBy(
    				array('email' => $data['email'])
    				);
    		//email existance check
    		if(empty($user)){
    			
    			
    			//firstname,lastname extraction logic
    			$nameArray = explode(' ',trim($data['name']));
    			if(count($nameArray)>1){
	    			$lastName = end($nameArray);
	    			array_pop($nameArray);    			
	    			$firstName =  implode(' ',$nameArray);
    			}else{//if last name not found
    				$firstName = end($nameArray);
    				$lastName='';
    			}
    			
    			//capture user data [Users]
    			$userObj = new User();
    			$userObj->setFirstName($firstName); 
    			$userObj->setLastName($lastName);
    			$userObj->setEmail($data['email']);
    			$userObj->setUserType(User::USER_TYPE_JOB_SEEKER);
    			$userObj->setDateTimeCreated(new \DateTime());    			
    			
    			$this->getEntityManager()->persist($userObj);
    			$this->getEntityManager()->flush();  
    			$response_data['user'] = $userObj->getValues();
    			
    			//authendications entry
    			$userAuthObj = new UserAuthentication();
    			$userAuthObj->setUserName($data['email']);
    			$userAuthObj->setAuthenticationProvider($data['provider']);
    			if(isset($data['password'])){
    				$userAuthObj->setPassword($data['password']);
    			}    			
    			$userAuthObj->setResetToken($data['resetToken']);
    			$userAuthObj->setDateTimeCreated(new \DateTime()); 
    			$userAuthObj->setUser($userObj);    			
    			$this->getEntityManager()->persist($userAuthObj);
    			$this->getEntityManager()->flush();
    			
    			$response_data['auth'] = $userAuthObj->getValues();
    			$status='Successful';
    			$message='User registration successfull';
    			$status_code=1;
    			
    			//add jobseeker
    			$response_data['obj']['jobseeker'] = $this->addJobSeeker($userObj);    			
    			
    		}else{
    			//email already exists
    			$status='Failed';
    			$message='Invalid email,Email already exists';
    			$response_data = $data;
    			$status_code=0;
    		}
    	}else{
    		
    		//missing required field email
    		$status='Failed';
    		$message='missing required field email';
    		$response_data = $data;
    		$status_code=0;
    		
    	}
    	
    	$response = array('status'=>$status,'statusCode'=>$status_code,'data'=>$response_data,'message'=>$message);    	
    	
    	return $response;
    }
    
    public function addJobSeeker($userObj){

    	//initializations
    	$status = null;
    	$status_code=null;
    	$responseData=null;
    	$message = null;
    	
    	//add user as a job seeker
    	$jobSeekerObj = new JobSeeker();
    	
    	$jobSeekerObj->setUser($userObj);
    	$this->getEntityManager()->persist($jobSeekerObj);
    	$this->getEntityManager()->flush();
    	 
    	return $jobSeekerObj;
    	 
    }

}