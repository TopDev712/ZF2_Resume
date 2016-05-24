<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;

class ProfileController extends AbstractBaseController
{

    public function indexAction()
    {
    	//Temporary data population for dropdown values. needs to be changes as dynamic
    	$industryList= array(0 =>"--Select--",1 =>"Accounting/Finance",2 =>"Admin/Secretarial",3 =>"Advertising",4 =>"Architect/Design",5 =>"Art/Media/Writers",6 =>"Automotive",7 =>"Banking",8 =>"Biotech/Pharmaceutical",9 =>"Computer/Software",10 =>"Construction/Skilled Trade",11 =>"Customer Service",12 =>"Domestic Help/Care",13 =>"Education",14 =>"Engineering",15 =>"Environmental Science",16 =>"Events",17 =>"Everything Else",18 =>"Facilities/Maintenance",19 =>"General Labor/Warehouse",20 =>"Gov/Military",21 =>"HR & Recruiting",22 =>"Healthcare",23 =>"Hospitality/Restaurant",24 =>"Information Technology",25 =>"Insurance",26 =>"Internet",27 =>"Law Enforcement/Security",28 =>"Legal",29 =>"Management & Exec",30 =>"Manufacturing/Operations",31 =>"Marketing/PR",32 =>"Nonprofit & Fund",33 =>"Oil/Energy/Power",34 =>"Quality Assurance",35 =>"Real Estate",36 =>"Research & Dev",37 =>"Retail",38 =>"Sales & Biz Dev",39 =>"Salon/Beauty/Fitness",40 =>"Social Services",41 =>"Supply Chain/Logistics",42 =>"Telecommunications",43 =>"Travel",44 =>"Trucking/Transport",45 =>"TV/Film/Musicians",46 =>"Vet & Animal Care",47 =>"Work from Home");
    	$experienceList = array(0 =>"--Select--",1 =>"Intern",2 =>"Entry Level (0-2 years)",3 =>"Mid Level (3-6 years)",4 =>"Senior Level (7+ years)",5 =>"Director",6 =>"Executive");
    	$educationList = array(0 =>"--Select--",1 =>"High School Diploma/GED",2 =>"Associates Degree",3 =>"Bachelors Degree",4 =>"Masters or Ph.D");
    	$salaryList = array(0 =>"--Select--",1 =>"Negotiable",2 =>"$25,000 / year",3 =>"$30,000 / year",4 =>"$35,000 / year",5 =>"$40,000 / year",6 =>"$45,000 / year",7 =>"$50,000 / year",8 =>"$55,000 / year",9 =>"$60,000 / year",10 =>"$65,000 / year",11 =>"$70,000 / year",12 =>"$75,000 / year",13 =>"$80,000 / year",14 =>"$85,000 / year",15 =>"$90,000 / year",16 =>"$100,000 / year",17 =>"$125,000 / year",18 =>"$150,000 / year",19 =>"$175,000 / year",20 =>"$200,000+ / year");
    	$countryList = array(0 =>"--Select--",1 =>"American Samoa",2 =>"Canada",3 =>"United Kingdom",4 =>"Guam",5 =>"Puerto Rico",6 =>"Northern Mariana Islands",7 =>"United States",8 =>"Virgin Islands");
    	
    	$profileData = $this->getEntityManager()->getRepository('Application\Entity\JobSeeker')->findOneBy(
    			array('id' => $this->getCurrentUser()->getJobSeeker()->getId())
    			);    	
    	return new ViewModel(array(
    			'industryList' => $industryList,
    			'experienceList' => $experienceList,
    			'educationList' => $educationList,
    			'salaryList' => $salaryList,
    			'countryList' => $countryList,
    			'profileData'=>$profileData
    	));
    }
}