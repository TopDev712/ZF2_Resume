<?php

namespace Application\Api\Controller;


use Application\Entity\JobAlert;
use Application\Entity\JobSeeker;  // was missing, added to pull JS repository
use Application\Service\JobAlertService;
use Zend\Json\Json;

class JobAlertDeleteApiController extends AbstractBaseApiController
{

    /**
     * @return  \Application\Repository\JobAlertRepository
     */
    private function getJobAlertRepository()
    {
        return $this->getEntityManager()->getRepository('Application\Entity\JobAlert');
    }

    /**
     * @return  \Application\Repository\JobSeekerRepository
     */
    private function getJobSeekerRepository()
    {
        return $this->getEntityManager()->getRepository('Application\Entity\JobSeeker');
    }

    /**
     * @return JobAlertService
     */
    private function getJobAlertService()
    {
        return $this->serviceLocator->get("jobAlertService");
    }

    public function get($id)
    {
        $user = $this->getCurrentUser();
        $jobAlert = $this->getJobAlertRepository()->find($id);
        if ($jobAlert != null && $jobAlert->getJobSeeker()->getId() == $user->getJobSeeker()->getId()) {
            return $this->writeJsonResponse(array("status" => "Successful", "result" => $jobAlert->toArray()));
        } else {
            return $this->writeJsonResponse(array("status" => "Failed", "message" => "Invalid ID"));
        }
    }

    public function getList()
    {
        $user = $this->getCurrentUser();
        $jobAlerts = $this->getJobAlertRepository()->findBy(array("jobSeeker" => $user->getJobSeeker()->getId()));
        $result = array();
        foreach ($jobAlerts as $jobAlert) {
            $settingJson = Json::decode($jobAlert->getSettingJson());
            $result[] = array(
                "id" => $jobAlert->getId(),
                "enabled" => $jobAlert->getEnabledFlag() == "1" ? true : false,
                "title" => $settingJson->title,
                "location" => $settingJson->location,
                "radius" => $settingJson->radius_miles,
            );
        }
        return $this->writeJsonResponse(array("status" => "Successful", "result" => $result));
    }

    public function create($params)
    
    {	
	    	$jobAlert = $params["jobAlert"];
	    	$jobAlertId = $jobAlert["id"];	    	
            $currentUser = $this->getCurrentUser();
            $jobSeeker = $this->getJobSeekerRepository()->find($currentUser->getJobSeeker()->getId());
            $status = $this->getJobAlertService()->delete($jobSeeker,$jobAlertId);
            if ($status) {
                return $this->getList();
            }
            return $this->writeJsonResponse(array("status" => "Failed", "message" => "Unknown Error"));
    }
}