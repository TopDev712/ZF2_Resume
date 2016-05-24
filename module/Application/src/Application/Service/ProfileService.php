<?php

namespace Application\Service;

use Application\Entity\JobSeeker;

class ProfileService extends AbstractService
{

    /**
     * @param $jobSeeker JobSeeker
     * @param $data array
     * @return bool
     */
    public function updateJobseeker($jobSeekerObj, $data)
    { 
    	//phone no
    	if(isset($data['phone'])){
    		$jobSeekerObj->setPhoneNo($data['phone']);
    	}  
    	//industry  - only set if the value passed in is not empty as well
    	if(isset($data['industry']) && !empty($data['industry']) ){
    		$jobSeekerObj->setIndustry($data['industry']);
    	}
    	//headline
    	if(isset($data['headline']) && !empty($data['headline']) ){
    		$jobSeekerObj->setHeadline($data['headline']);
    	}
    	//experience - only set if the value passed in is not empty as well
    	if(isset($data['experience']) && !empty($data['experience']) ){
    		$jobSeekerObj->setExperience($data['experience']);
    	}
    	//education - only set if the value passed in is not empty as well
    	if(isset($data['education']) && !empty($data['education']) ){
    		$jobSeekerObj->setEducation($data['education']);
    	}
    	//desired salary - only set if the value passed in is not empty as well
    	if(isset($data['desired_salary']) && !empty($data['desired_salary']) ){
    		$jobSeekerObj->setDesiredSalary($data['desired_salary']);
    	}
    	//country - only set if the value passed in is not empty as well
    	if(isset($data['country']) && !empty($data['country']) ){
    		$jobSeekerObj->setCountry($data['country']);
    	}    	
    	//zip code
    	if(isset($data['zip_code'])){
    		$jobSeekerObj->setZipCode($data['zip_code']);
    	}   
    	//lnkedin url
    	if(isset($data['linkedin'])){
    		$jobSeekerObj->setLinkedin($data['linkedin']);
    	}
    	//twitter url
    	if(isset($data['twitter'])){
    		$jobSeekerObj->setTwitter($data['twitter']);
    	}
    	//facebook url
    	if(isset($data['facebook'])){
    		$jobSeekerObj->setFacebook($data['facebook']);
    	}
    	//company find flag
    	if(isset($data['company_find_flag'])){
    		$jobSeekerObj->setCompanyFindFlag($data['company_find_flag']);
    	}
    	
    	$this->getEntityManager()->persist($jobSeekerObj);
    	$this->getEntityManager()->flush();
    	return true;
    }
    /**
     * @param $jobSeeker JobSeeker
     * @param $data array
     * @return bool
     */
    public function updateProfile($user, $data)
    {  
    	if(isset($data['name'])){
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
	    	$user->setFirstName($firstName);
	    	$user->setLastName($lastName);
    	} 
    	
    	if(isset($data['firstName'])){
    		$user->setFirstName($data['firstName']);
    	}
    	if(isset($data['lastName'])){
    		$user->setLastName($data['lastName']);
    	}
    	
    	$this->getEntityManager()->persist($user);
    	$this->getEntityManager()->flush();
    	return true;
    }

}